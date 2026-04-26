<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Pencatatan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PencatatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengajuan::with(['user', 'pencatatan']);

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('pencatatan', fn($q2) => $q2->where('nama_lengkap', 'like', "%$search%"))
                  ->orWhere('id', 'like', "%$search%");
            });
        }

        // Filter urutan
        $sort = $request->get('sort', 'desc');
        $query->orderBy('id', $sort === 'asc' ? 'asc' : 'desc');

        $pengajuanList = $query->get();

        return view('staff.pencatatan.index', compact('pengajuanList'));
    }

    public function create($pengajuanId)
    {
        $pengajuan       = Pengajuan::with(['user', 'pencatatan'])->findOrFail($pengajuanId);
        $existingCatatan = Pencatatan::where('pengajuan_id', $pengajuanId)->first();

        return view('staff.pencatatan.form', compact('pengajuan', 'existingCatatan'));
    }

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

        $pengajuan->update(['status_pencatatan' => 'selesai_dicatat']);

        return redirect()
            ->route('staff.pencatatan.index')
            ->with('success', 'Data pencatatan berhasil disimpan.');
    }

    public function show($pengajuanId)
    {
        $pengajuan  = Pengajuan::with(['user', 'pencatatan.staff'])->findOrFail($pengajuanId);
        $pencatatan = $pengajuan->pencatatan;

        return view('staff.pencatatan.detail', compact('pengajuan', 'pencatatan'));
    }
}