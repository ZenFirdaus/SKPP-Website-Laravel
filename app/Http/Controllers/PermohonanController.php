<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permohonan;
use Illuminate\Support\Facades\Auth;

class PermohonanController extends Controller
{
    // Pastikan semua route dilindungi auth
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan daftar permohonan user yang login
    public function index()
    {
        $permohonans = Permohonan::where('user_id', Auth::id())->get();
        return view('mitra.permohonan.index', compact('permohonans'));
    }

    // Form tambah permohonan baru
    public function create()
    {
        return view('mitra.permohonan.create');
    }

    // Simpan permohonan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'npwp' => 'nullable|string|max:50',
            'keperluan' => 'required|string',
        ]);

        Permohonan::create([
            'user_id' => Auth::id(),
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'npwp' => $request->npwp,
            'keperluan' => $request->keperluan,
            'status' => 'menunggu', // default status
        ]);

        return redirect()->route('permohonans.index')->with('success', 'Permohonan berhasil diajukan');
    }

    // Menampilkan detail permohonan
    public function show($id)
    {
        $permohonan = Permohonan::where('user_id', Auth::id())->findOrFail($id);
        return view('mitra.permohonan.show', compact('permohonan'));
    }

    // Form edit permohonan
    public function edit($id)
    {
        $permohonan = Permohonan::where('user_id', Auth::id())->findOrFail($id);
        return view('mitra.permohonan.edit', compact('permohonan'));
    }

    // Update permohonan
    public function update(Request $request, $id)
    {
        $permohonan = Permohonan::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'npwp' => 'nullable|string|max:50',
            'keperluan' => 'required|string',
        ]);

        $permohonan->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'npwp' => $request->npwp,
            'keperluan' => $request->keperluan,
        ]);

        return redirect()->route('permohonans.index')->with('success', 'Permohonan berhasil diperbarui');
    }

    // Hapus permohonan
    public function destroy($id)
    {
        $permohonan = Permohonan::where('user_id', Auth::id())->findOrFail($id);
        $permohonan->delete();

        return redirect()->route('permohonans.index')->with('success', 'Permohonan berhasil dihapus');
    }
}