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
    public function index(Request $request)
    {
        $query = Pengajuan::with(['user', 'pencatatan', 'draftSkpp'])
            ->where('status_pengecekan', 'disetujui');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('pencatatan', fn($q2) => $q2->where('nama_lengkap', 'like', "%$search%"))
                  ->orWhere('id', 'like', "%$search%");
            });
        }

        $sort = $request->get('sort', 'desc');
        $query->orderBy('id', $sort === 'asc' ? 'asc' : 'desc');

        $pengajuanList = $query->get();

        return view('kepala.draft.index', compact('pengajuanList'));
    }

    public function create($pengajuanId)
    {
        $pengajuan = Pengajuan::with(['user', 'pencatatan', 'draftSkpp'])->findOrFail($pengajuanId);
        $draftSkpp = DraftSkpp::where('pengajuan_id', $pengajuanId)->first();

        return view('kepala.draft.form', compact('pengajuan', 'draftSkpp'));
    }

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

        $existing = DraftSkpp::where('pengajuan_id', $pengajuanId)->first();
        if ($existing && Storage::disk('public')->exists($existing->file_skpp)) {
            Storage::disk('public')->delete($existing->file_skpp);
        }

        $path = $request->file('file_skpp')->store('draft_skpp', 'public');

        DraftSkpp::updateOrCreate(
            ['pengajuan_id' => $pengajuanId],
            [
                'diupload_oleh'  => Auth::id(),
                'file_skpp'      => $path,
                'tanggal_upload' => now(),
            ]
        );

        $pengajuan->update(['status_draft' => 'sudah_diupload']);

        return redirect()
            ->route('kepala.draft.index')
            ->with('success', 'File SKPP berhasil diupload.');
    }
}