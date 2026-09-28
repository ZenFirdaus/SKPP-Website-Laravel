<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\Pengecekan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengecekanController extends Controller
{
    /**
     * Dashboard Kepala
     */
    public function kepalaDashboard()
    {
        $stats = [
            'total_dicatat' => Pengajuan::where('status_pencatatan', 'selesai_dicatat')->count(),
            'menunggu_review' => Pengajuan::where('status_pencatatan', 'selesai_dicatat')->where('status_pengecekan', 'menunggu')->count(),
            'disetujui' => Pengajuan::where('status_pengecekan', 'disetujui')->count(),
            'ditolak' => Pengajuan::where('status_pengecekan', 'ditolak')->count(),
            'perlu_draft' => Pengajuan::where('status_pengecekan', 'disetujui')->where('status_draft', 'belum')->count(),
        ];

        // Pengajuan yang menunggu persetujuan
        $menungguPersetujuan = Pengajuan::with(['user', 'pencatatan'])
            ->where('status_pencatatan', 'selesai_dicatat')
            ->where('status_pengecekan', 'menunggu')
            ->latest()
            ->take(5)
            ->get();

        // Riwayat pengecekan terbaru
        $riwayatPengecekan = Pengajuan::with(['user', 'pencatatan', 'pengecekan'])
            ->where('status_pengecekan', '!=', 'menunggu')
            ->latest()
            ->take(5)
            ->get();

        return view('kepala.dashboard', compact('stats', 'menungguPersetujuan', 'riwayatPengecekan'));
    }

    public function index(Request $request)
    {
        $query = Pengajuan::with(['user', 'pencatatan', 'pengecekan'])
            ->where('status_pencatatan', 'selesai_dicatat');

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('pencatatan', fn ($q2) => $q2->where('nama_lengkap', 'like', "%{$search}%"))
                    ->orWhereHas('user', fn ($q2) => $q2->where('name', 'like', "%{$search}%"))
                    ->orWhere('id', 'like', "%{$search}%");
            });
        }

        // Filter status pengecekan
        if ($request->filled('status_pengecekan')) {
            $query->where('status_pengecekan', $request->status_pengecekan);
        }

        // Filter urutan
        $sort = $request->get('sort', 'desc');
        $query->orderBy('id', $sort === 'asc' ? 'asc' : 'desc');

        $pengajuanList = $query->paginate(10)->withQueryString();

        return view('kepala.pengecekan.index', compact('pengajuanList'));
    }

    public function show($pengajuanId)
    {
        $pengajuan = Pengajuan::with(['user', 'pencatatan.staff', 'pengecekan'])->findOrFail($pengajuanId);
        $pengecekan = Pengecekan::where('pengajuan_id', $pengajuanId)->first();

        return view('kepala.pengecekan.detail', compact('pengajuan', 'pengecekan'));
    }

    public function store(Request $request, $pengajuanId)
    {
        $request->validate([
            'slip_gaji' => 'required|in:lengkap,tidak',
            'sk' => 'required|in:lengkap,tidak',
            'surat_pengantar' => 'required|in:lengkap,tidak',
            'keputusan' => 'required|in:setuju,tolak',
            'catatan_pengecekan' => 'nullable|string|max:1000',
        ], [
            'slip_gaji.required' => 'Pemeriksaan slip gaji wajib dipilih.',
            'sk.required' => 'Pemeriksaan SK wajib dipilih.',
            'surat_pengantar.required' => 'Pemeriksaan surat pengantar wajib dipilih.',
            'keputusan.required' => 'Keputusan persetujuan wajib ditentukan.',
        ]);

        $pengajuan = Pengajuan::findOrFail($pengajuanId);

        Pengecekan::updateOrCreate(
            ['pengajuan_id' => $pengajuanId],
            [
                'slip_gaji' => $request->slip_gaji,
                'sk' => $request->sk,
                'surat_pengantar' => $request->surat_pengantar,
                'keputusan' => $request->keputusan,
                'catatan_pengecekan' => $request->catatan_pengecekan,
                'dicek_oleh' => Auth::id(),
            ]
        );

        $statusPengecekan = $request->keputusan === 'setuju' ? 'disetujui' : 'ditolak';

        $pengajuan->update([
            'status_pengecekan' => $statusPengecekan,
            'status' => $statusPengecekan,
        ]);

        return redirect()
            ->route('kepala.pengecekan.index')
            ->with('success', 'Hasil verifikasi dan keputusan berhasil disimpan.');
    }

    /**
     * Hapus pengajuan (soft delete)
     */
    public function destroy($pengajuanId)
    {
        $pengajuan = Pengajuan::findOrFail($pengajuanId);
        $pengajuan->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengajuan berhasil dipindahkan ke sampah.',
            ]);
        }

        return redirect()->route('kepala.pengecekan.index')
            ->with('success', 'Pengajuan berhasil dipindahkan ke sampah.');
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
                $q->whereHas('pencatatan', fn ($q2) => $q2->where('nama_lengkap', 'like', "%{$search}%"))
                    ->orWhereHas('user', fn ($q2) => $q2->where('name', 'like', "%{$search}%"))
                    ->orWhere('id', 'like', "%{$search}%");
            });
        }

        $sort = $request->get('sort', 'desc');
        $query->orderBy('deleted_at', $sort === 'asc' ? 'asc' : 'desc');

        $trashedList = $query->paginate(10)->withQueryString();

        return view('kepala.pengecekan.trash', compact('trashedList'));
    }

    /**
     * Pulihkan pengajuan yang dihapus
     */
    public function restore($pengajuanId)
    {
        $pengajuan = Pengajuan::onlyTrashed()->findOrFail($pengajuanId);
        $pengajuan->restore();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pengajuan berhasil dipulihkan.',
            ]);
        }

        return redirect()->route('kepala.pengecekan.trash')
            ->with('success', 'Pengajuan berhasil dipulihkan.');
    }
}
