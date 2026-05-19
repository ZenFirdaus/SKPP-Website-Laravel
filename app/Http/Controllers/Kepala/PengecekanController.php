<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Pengecekan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengecekanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengajuan::with(['user', 'pencatatan', 'pengecekan'])
            ->where('status_pencatatan', 'selesai_dicatat');

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('pencatatan', fn($q2) => $q2->where('nama_lengkap', 'like', "%$search%"))
                  ->orWhereRaw("'SKPP ' || substr('000' || id, -3, 3) like ?", ["%$search%"])
                  ->orWhere('id', 'like', "%$search%");
            });
        }

        // Filter urutan
        $sort = $request->get('sort', 'desc');
        $query->orderBy('id', $sort === 'asc' ? 'asc' : 'desc');

        $pengajuanList = $query->get();

        return view('kepala.pengecekan.index', compact('pengajuanList'));
    }

    public function show($pengajuanId)
    {
        $pengajuan  = Pengajuan::with(['user', 'pencatatan', 'pengecekan'])->findOrFail($pengajuanId);
        $pengecekan = Pengecekan::where('pengajuan_id', $pengajuanId)->first();

        return view('kepala.pengecekan.detail', compact('pengajuan', 'pengecekan'));
    }

    public function store(Request $request, $pengajuanId)
    {
        $request->validate([
            'slip_gaji'          => 'required|in:lengkap,tidak',
            'sk'                 => 'required|in:lengkap,tidak',
            'surat_pengantar'    => 'required|in:lengkap,tidak',
            'keputusan'          => 'required|in:setuju,tolak',
            'catatan_pengecekan' => 'nullable|string|max:1000',
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

    /**
     * Hapus pengajuan (soft delete)
     */
    public function destroy($pengajuanId)
    {
        $pengajuan = Pengajuan::findOrFail($pengajuanId);
        $pengajuan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan berhasil dihapus.',
        ]);
    }

    /**
     * Tampilkan daftar pengajuan yang dihapus (trash)
     */
    public function trash(Request $request)
    {
        $query = Pengajuan::onlyTrashed()
            ->with(['user', 'pencatatan']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('pencatatan', fn($q2) => $q2->where('nama_lengkap', 'like', "%$search%"))
                  ->orWhere('id', 'like', "%$search%");
            });
        }

        $sort = $request->get('sort', 'desc');
        $query->orderBy('deleted_at', $sort === 'asc' ? 'asc' : 'desc');

        $trashedList = $query->get();

        return view('kepala.pengecekan.trash', compact('trashedList'));
    }

    /**
     * Pulihkan pengajuan yang dihapus
     */
    public function restore($pengajuanId)
    {
        $pengajuan = Pengajuan::onlyTrashed()->findOrFail($pengajuanId);
        $pengajuan->restore();

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan berhasil dipulihkan.',
        ]);
    }
}