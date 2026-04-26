<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Arsip;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArsipController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengajuan::with(['user', 'pencatatan', 'draftSkpp', 'arsip'])
            ->where('status_draft', 'sudah_diupload');

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

        return view('staff.pengarsipan.index', compact('pengajuanList'));
    }

    public function store(Request $request, $pengajuanId)
    {
        $pengajuan = Pengajuan::with('draftSkpp')->findOrFail($pengajuanId);

        if ($pengajuan->status_arsip === 'diarsipkan') {
            return response()->json(['success' => false, 'message' => 'SKPP ini sudah diarsipkan.']);
        }

        if (!$pengajuan->draftSkpp) {
            return response()->json(['success' => false, 'message' => 'File SKPP belum diupload oleh kepala.']);
        }

        Arsip::updateOrCreate(
            ['pengajuan_id' => $pengajuanId],
            [
                'diarsipkan_oleh'  => Auth::id(),
                'dikirim_ke_mitra' => false,
                'tanggal_selesai'  => now(),
                'tanggal_arsip'    => now(),
            ]
        );

        $pengajuan->update(['status_arsip' => 'diarsipkan']);

        return response()->json(['success' => true, 'message' => 'SKPP berhasil diarsipkan.']);
    }

    public function kirimMitra(Request $request, $pengajuanId)
    {
        $arsip = Arsip::where('pengajuan_id', $pengajuanId)->firstOrFail();
        $arsip->update(['dikirim_ke_mitra' => true]);

        return response()->json(['success' => true, 'message' => 'SKPP berhasil dikirim ke mitra kerja.']);
    }
}