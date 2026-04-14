<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Pencatatan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PencatatanController extends Controller
{
    /**
     * List semua pengajuan yang bisa dicatat oleh staff
     */
    public function index()
    {
        $pengajuanList = Pengajuan::with(['user', 'pencatatan'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('staff.pencatatan.index', compact('pengajuanList'));
    }

    /**
     * Tampilkan form pencatatan untuk pengajuan tertentu
     */
    public function create($pengajuanId)
    {
        $pengajuan = Pengajuan::with(['user', 'pencatatan'])->findOrFail($pengajuanId);

        // Cek apakah sudah pernah dicatat
        $existingCatatan = Pencatatan::where('pengajuan_id', $pengajuanId)->first();

        return view('staff.pencatatan.form', compact('pengajuan', 'existingCatatan'));
    }

    /**
     * Simpan data pencatatan
     */
    public function store(Request $request, $pengajuanId)
    {
        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'nip'            => 'required|string|max:50',
            'status_dokumen' => 'required|in:valid,tidak_valid',
            'catatan'        => 'nullable|string|max:1000',
        ], [
            'nama_lengkap.required'   => 'Nama lengkap wajib diisi.',
            'nip.required'            => 'NIP wajib diisi.',
            'status_dokumen.required' => 'Status dokumen wajib dipilih.',
        ]);

        $pengajuan = Pengajuan::findOrFail($pengajuanId);

        // Buat atau update pencatatan
        Pencatatan::updateOrCreate(
            ['pengajuan_id' => $pengajuanId],
            [
                'nama_lengkap'   => $request->nama_lengkap,
                'nip'            => $request->nip,
                'status_dokumen' => $request->status_dokumen,
                'catatan'        => $request->catatan,
                'dicatat_oleh'   => Auth::id(),
            ]
        );

        // Update status pencatatan di tabel pengajuan
        $pengajuan->update([
            'status_pencatatan' => 'selesai_dicatat',
        ]);

        return redirect()
            ->route('staff.pencatatan.index')
            ->with('success', 'Data pencatatan berhasil disimpan dan dikirim ke pengecekan.');
    }

    /**
     * Lihat detail pencatatan
     */
    public function show($pengajuanId)
    {
        $pengajuan  = Pengajuan::with(['user', 'pencatatan.staff'])->findOrFail($pengajuanId);
        $pencatatan = $pengajuan->pencatatan;

        return view('staff.pencatatan.detail', compact('pengajuan', 'pencatatan'));
    }
}