<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengunduhController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengajuan::with(['pencatatan', 'arsip', 'draftSkpp'])
            ->where('user_id', Auth::id())
            ->where('status_arsip', 'diarsipkan')
            ->whereHas('arsip', fn($q) => $q->where('dikirim_ke_mitra', true));

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

        return view('mitra.pengunduhan.index', compact('pengajuanList'));
    }

    public function unduh($pengajuanId)
    {
        $pengajuan = Pengajuan::with('draftSkpp')
            ->where('user_id', Auth::id())
            ->where('status_arsip', 'diarsipkan')
            ->findOrFail($pengajuanId);

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