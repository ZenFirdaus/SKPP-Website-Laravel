<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Pengecekan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengecekanController extends Controller
{
    /**
     * List semua pengajuan yang sudah dicatat (siap dicek)
     */
    public function index()
    {
        $pengajuanList = Pengajuan::with(['user', 'pencatatan', 'pengecekan'])
            ->where('status_pencatatan', 'selesai_dicatat')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('kepala.pengecekan.index', compact('pengajuanList'));
    }

    /**
     * Form pengecekan detail
     */
    public function show($pengajuanId)
    {
        $pengajuan   = Pengajuan::with(['user', 'pencatatan', 'pengecekan'])->findOrFail($pengajuanId);
        $pengecekan  = Pengecekan::where('pengajuan_id', $pengajuanId)->first();

        return view('kepala.pengecekan.detail', compact('pengajuan', 'pengecekan'));
    }

    /**
     * Simpan hasil pengecekan
     */
    public function store(Request $request, $pengajuanId)
    {
        $request->validate([
            'slip_gaji'          => 'required|in:lengkap,tidak',
            'sk'                 => 'required|in:lengkap,tidak',
            'surat_pengantar'    => 'required|in:lengkap,tidak',
            'keputusan'          => 'required|in:setuju,tolak',
            'catatan_pengecekan' => 'nullable|string|max:1000',
        ], [
            'slip_gaji.required'       => 'Status slip gaji wajib dipilih.',
            'sk.required'              => 'Status SK wajib dipilih.',
            'surat_pengantar.required' => 'Status surat pengantar wajib dipilih.',
            'keputusan.required'       => 'Keputusan wajib dipilih.',
        ]);

        $pengajuan = Pengajuan::findOrFail($pengajuanId);

        Pengecekan::updateOrCreate(
            ['pengajuan_id' => $pengajuanId],
            [
                'slip_gaji'          => $request->slip_gaji,
                'sk'                 => $request->sk,
                'surat_pengantar'    => $request->surat_pengantar,
                'keputusan'          => $request->keputusan,
                'catatan_pengecekan' => $request->catatan_pengecekan,
                'dicek_oleh'         => Auth::id(),
            ]
        );

        $pengajuan->update([
            'status_pengecekan' => $request->keputusan === 'setuju' ? 'disetujui' : 'ditolak',
        ]);

        return redirect()
            ->route('kepala.pengecekan.index')
            ->with('success', 'Pengecekan berhasil disimpan.');
    }
}