<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permohonan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PermohonanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $permohonans = Permohonan::where('user_id', Auth::id())->latest()->get();
        return view('mitra.permohonan.index', compact('permohonans'));
    }

    public function create()
    {
        return view('mitra.permohonan.create');
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
                ->store('dokumen/slip_gaji', 'public');
        }
        if ($request->hasFile('file_sk')) {
            $data['file_sk'] = $request->file('file_sk')
                ->store('dokumen/sk', 'public');
        }
        if ($request->hasFile('file_skpp')) {
            $data['file_skpp'] = $request->file('file_skpp')
                ->store('dokumen/skpp', 'public');
        }

        Permohonan::create($data);

        return redirect()->route('permohonan.index')
            ->with('success', 'Permohonan berhasil diajukan!');
    }

    public function show($id)
    {
        $permohonan = Permohonan::where('user_id', Auth::id())->findOrFail($id);
        return view('mitra.permohonan.show', compact('permohonan'));
    }

    public function edit($id)
    {
        $permohonan = Permohonan::where('user_id', Auth::id())->findOrFail($id);
        return view('mitra.permohonan.edit', compact('permohonan'));
    }

    public function update(Request $request, $id)
    {
        $permohonan = Permohonan::where('user_id', Auth::id())->findOrFail($id);

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
            if ($permohonan->file_slip_gaji) {
                Storage::disk('public')->delete($permohonan->file_slip_gaji);
            }
            $data['file_slip_gaji'] = $request->file('file_slip_gaji')
                ->store('dokumen/slip_gaji', 'public');
        }
        if ($request->hasFile('file_sk')) {
            if ($permohonan->file_sk) {
                Storage::disk('public')->delete($permohonan->file_sk);
            }
            $data['file_sk'] = $request->file('file_sk')
                ->store('dokumen/sk', 'public');
        }
        if ($request->hasFile('file_skpp')) {
            if ($permohonan->file_skpp) {
                Storage::disk('public')->delete($permohonan->file_skpp);
            }
            $data['file_skpp'] = $request->file('file_skpp')
                ->store('dokumen/skpp', 'public');
        }

        $permohonan->update($data);

        return redirect()->route('permohonan.index')
            ->with('success', 'Permohonan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $permohonan = Permohonan::where('user_id', Auth::id())->findOrFail($id);

        // Hapus file dari storage
        foreach (['file_slip_gaji', 'file_sk', 'file_skpp'] as $fileField) {
            if ($permohonan->$fileField) {
                Storage::disk('public')->delete($permohonan->$fileField);
            }
        }

        $permohonan->delete();

        return redirect()->route('permohonan.index')
            ->with('success', 'Permohonan berhasil dihapus!');
    }
}