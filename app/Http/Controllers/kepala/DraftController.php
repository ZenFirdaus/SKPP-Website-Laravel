<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\DraftSkpp;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DraftController extends Controller
{
    /**
     * List pengajuan yang sudah disetujui - siap diupload draft SKPP
     */
    public function index()
    {
        $pengajuanList = Pengajuan::with(['user', 'pencatatan', 'draftSkpp'])
            ->where('status_pengecekan', 'disetujui')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('kepala.draft.index', compact('pengajuanList'));
    }

    /**
     * Form upload draft SKPP
     */
    public function create($pengajuanId)
    {
        $pengajuan  = Pengajuan::with(['user', 'pencatatan', 'draftSkpp'])->findOrFail($pengajuanId);
        $draftSkpp  = DraftSkpp::where('pengajuan_id', $pengajuanId)->first();

        return view('kepala.draft.form', compact('pengajuan', 'draftSkpp'));
    }

    /**
     * Simpan upload file SKPP
     */
    public function store(Request $request, $pengajuanId)
    {
        $request->validate([
            'file_skpp' => 'required|file|mimes:pdf|max:5120',
        ], [
            'file_skpp.required' => 'File SKPP wajib diupload.',
            'file_skpp.mimes'    => 'File harus berformat PDF.',
            'file_skpp.max'      => 'Ukuran file maksimal 5MB.',
        ]);

        $pengajuan = Pengajuan::findOrFail($pengajuanId);

        // Hapus file lama jika ada
        $existing = DraftSkpp::where('pengajuan_id', $pengajuanId)->first();
        if ($existing && Storage::disk('public')->exists($existing->file_skpp)) {
            Storage::disk('public')->delete($existing->file_skpp);
        }

        // Simpan file baru
        $path = $request->file('file_skpp')->store('draft_skpp', 'public');

        // Simpan ke database
        DraftSkpp::updateOrCreate(
            ['pengajuan_id' => $pengajuanId],
            [
                'diupload_oleh'  => Auth::id(),
                'file_skpp'      => $path,
                'tanggal_upload' => now(),
            ]
        );

        // Update status draft di pengajuan
        $pengajuan->update(['status_draft' => 'sudah_diupload']);

        return redirect()
            ->route('kepala.draft.index')
            ->with('success', 'File SKPP berhasil diupload.');
    }
}