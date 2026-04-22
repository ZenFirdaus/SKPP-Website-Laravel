<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengunduhController extends Controller
{
    /**
     * List SKPP milik mitra yang sudah diarsipkan & dikirim
     */
    public function index()
    {
        $pengajuanList = Pengajuan::with(['pencatatan', 'arsip', 'draftSkpp'])
            ->where('user_id', Auth::id())
            ->where('status_arsip', 'diarsipkan')
            ->whereHas('arsip', fn($q) => $q->where('dikirim_ke_mitra', true))
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('mitra.pengunduhan.index', compact('pengajuanList'));
    }

    /**
     * Download file SKPP dari draft yang diupload kepala
     */
    public function unduh($pengajuanId)
    {
        $pengajuan = Pengajuan::with('draftSkpp')
            ->where('user_id', Auth::id())
            ->where('status_arsip', 'diarsipkan')
            ->findOrFail($pengajuanId);

        // Ambil file dari draft SKPP yang diupload kepala
        if ($pengajuan->draftSkpp && Storage::disk('public')->exists($pengajuan->draftSkpp->file_skpp)) {
            return Storage::disk('public')->download(
                $pengajuan->draftSkpp->file_skpp,
                'SKPP_' . str_pad($pengajuan->id, 3, '0', STR_PAD_LEFT) . '.pdf'
            );
        }

        return redirect()
            ->route('mitra.pengunduhan.index')
            ->with('error', 'File SKPP belum tersedia. Hubungi staff administrasi.');
    }
}