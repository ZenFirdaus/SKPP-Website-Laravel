<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pengajuans = Pengajuan::where('user_id', Auth::id())->latest()->get();
        return view('mitra.pengajuan.index', compact('pengajuans'));
    }

    public function create()
    {
        return view('mitra.pengajuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat'          => 'required|string|max:500',
            'npwp'            => 'nullable|string|max:50',
            'keperluan'       => 'required|string',
            'file_slip_gaji'  => 'required|file|mimes:pdf|max:2048',
            'file_sk'         => 'required|file|mimes:pdf|max:2048',
            'file_skpp'       => 'required|file|mimes:pdf|max:2048',
        ]);

        $data = [
            'user_id'        => Auth::id(),
            'nama_perusahaan'=> $request->nama_perusahaan,
            'alamat'         => $request->alamat,
            'npwp'           => $request->npwp,
            'keperluan'      => $request->keperluan,
            'status'         => 'menunggu',
        ];

        // Simpan file ke storage/app/public/dokumen
        if ($request->hasFile('file_slip_gaji')) {
            $data['file_slip_gaji'] = $request->file('file_slip_gaji')
                ->store('pengajuan', 'public');
        }
        if ($request->hasFile('file_sk')) {
            $data['file_sk'] = $request->file('file_sk')
                ->store('pengajuan', 'public');
        }
        if ($request->hasFile('file_skpp')) {
            $data['file_skpp'] = $request->file('file_skpp')
                ->store('pengajuan', 'public');
        }

        Pengajuan::create($data);

        return redirect()->route('mitra.pengajuan.index')
            ->with('success', 'Pengajuan berhasil diajukan!');
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::where('user_id', Auth::id())->findOrFail($id);
        return view('mitra.pengajuan.show', compact('pengajuan'));
    }

    public function edit($id)
    {
        $pengajuan = Pengajuan::where('user_id', Auth::id())->findOrFail($id);
        return view('mitra.pengajuan.edit', compact('pengajuan'));
    }

    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat'          => 'required|string|max:500',
            'npwp'            => 'nullable|string|max:50',
            'keperluan'       => 'required|string',
            'file_slip_gaji'  => 'nullable|file|mimes:pdf|max:2048',
            'file_sk'         => 'nullable|file|mimes:pdf|max:2048',
            'file_skpp'       => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = [
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat'          => $request->alamat,
            'npwp'            => $request->npwp,
            'keperluan'       => $request->keperluan,
        ];

        // Ganti file lama jika ada file baru
        if ($request->hasFile('file_slip_gaji')) {
            if ($pengajuan->file_slip_gaji) {
                Storage::disk('public')->delete($pengajuan->file_slip_gaji);
            }
            $data['file_slip_gaji'] = $request->file('file_slip_gaji')
                ->store('pengajuan', 'public');
        }
        if ($request->hasFile('file_sk')) {
            if ($pengajuan->file_sk) {
                Storage::disk('public')->delete($pengajuan->file_sk);
            }
            $data['file_sk'] = $request->file('file_sk')
                ->store('pengajuan', 'public');
        }
        if ($request->hasFile('file_skpp')) {
            if ($pengajuan->file_skpp) {
                Storage::disk('public')->delete($pengajuan->file_skpp);
            }
            $data['file_skpp'] = $request->file('file_skpp')
                ->store('pengajuan', 'public');
        }

        $pengajuan->update($data);

        return redirect()->route('mitra.pengajuan.index')
            ->with('success', 'pengajuan berhasil diperbarui!');
    }

public function status(): \Illuminate\View\View
{
    $pengajuans = Auth::user()->pengajuans;
    return view('mitra.pengajuan.status', compact('pengajuans'));
}

public function riwayat(): \Illuminate\View\View
{
    $pengajuans = Auth::user()->pengajuans;
    return view('mitra.pengajuan.riwayat', compact('pengajuans'));
}

    public function destroy($id)
    {
        $pengajuan = Pengajuan::where('user_id', Auth::id())->findOrFail($id);

        // Hapus file dari storage
        foreach (['file_slip_gaji', 'file_sk', 'file_skpp'] as $fileField) {
            if ($pengajuan->$fileField) {
                Storage::disk('public')->delete($pengajuan->$fileField);
            }
        }

        $pengajuan->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Pengajuan berhasil dihapus!');
    }
}