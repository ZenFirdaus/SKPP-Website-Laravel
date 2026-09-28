<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PengajuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Dashboard Mitra
     */
    public function mitraDashboard()
    {
        $userId = Auth::id();

        $stats = [
            'total' => Pengajuan::where('user_id', $userId)->count(),
            'menunggu' => Pengajuan::where('user_id', $userId)->where('status', 'menunggu')->count(),
            'diproses' => Pengajuan::where('user_id', $userId)->whereIn('status', ['diproses', 'disetujui'])->count(),
            'selesai' => Pengajuan::where('user_id', $userId)
                ->where('status_arsip', 'diarsipkan')
                ->whereHas('arsip', fn ($q) => $q->where('dikirim_ke_mitra', true))
                ->count(),
            'ditolak' => Pengajuan::where('user_id', $userId)->where('status', 'ditolak')->count(),
        ];

        $pengajuanTerbaru = Pengajuan::where('user_id', $userId)
            ->with(['pencatatan', 'pengecekan', 'draftSkpp', 'arsip'])
            ->latest()
            ->take(5)
            ->get();

        return view('mitra.dashboard', compact('stats', 'pengajuanTerbaru'));
    }

    /**
     * Daftar Pengajuan Mitra
     */
    public function index(Request $request)
    {
        $query = Pengajuan::where('user_id', Auth::id())
            ->with(['pencatatan', 'pengecekan', 'draftSkpp', 'arsip']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_perusahaan', 'like', "%{$search}%")
                    ->orWhere('keperluan', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'selesai') {
                $query->where('status_arsip', 'diarsipkan')
                    ->whereHas('arsip', fn ($q) => $q->where('dikirim_ke_mitra', true));
            } else {
                $query->where('status', $status);
            }
        }

        $sort = $request->get('sort', 'desc');
        $query->orderBy('id', $sort === 'asc' ? 'asc' : 'desc');

        $pengajuans = $query->paginate(10)->withQueryString();

        return view('mitra.pengajuan.index', compact('pengajuans'));
    }

    public function create()
    {
        return view('mitra.pengajuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'npwp' => 'nullable|string|max:50',
            'keperluan' => 'required|string|max:1000',
            'file_slip_gaji' => 'required|file|mimes:pdf|max:2048',
            'file_sk' => 'required|file|mimes:pdf|max:2048',
            'file_skpp' => 'required|file|mimes:pdf|max:2048',
        ], [
            'nama_perusahaan.required' => 'Nama pegawai / perusahaan wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'keperluan.required' => 'Keperluan pengajuan wajib diisi.',
            'file_slip_gaji.required' => 'File slip gaji wajib diunggah.',
            'file_slip_gaji.mimes' => 'File slip gaji harus berformat PDF.',
            'file_slip_gaji.max' => 'Ukuran slip gaji maksimal 2MB.',
            'file_sk.required' => 'File SK wajib diunggah.',
            'file_sk.mimes' => 'File SK harus berformat PDF.',
            'file_sk.max' => 'Ukuran file SK maksimal 2MB.',
            'file_skpp.required' => 'File dokumen pendukung / SKPP wajib diunggah.',
            'file_skpp.mimes' => 'File dokumen pendukung / SKPP harus berformat PDF.',
            'file_skpp.max' => 'Ukuran dokumen pendukung maksimal 2MB.',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'npwp' => $request->npwp,
            'keperluan' => $request->keperluan,
            'status' => 'menunggu',
            'status_pencatatan' => 'belum_dicatat',
            'status_pengecekan' => 'menunggu',
            'status_draft' => 'belum',
            'status_arsip' => 'belum',
        ];

        if ($request->hasFile('file_slip_gaji')) {
            $data['file_slip_gaji'] = $request->file('file_slip_gaji')->store('pengajuan/slip_gaji', 'public');
        }
        if ($request->hasFile('file_sk')) {
            $data['file_sk'] = $request->file('file_sk')->store('pengajuan/sk', 'public');
        }
        if ($request->hasFile('file_skpp')) {
            $data['file_skpp'] = $request->file('file_skpp')->store('pengajuan/skpp', 'public');
        }

        Pengajuan::create($data);

        return redirect()->route('mitra.pengajuan.index')
            ->with('success', 'Pengajuan berhasil dibuat dan sedang menunggu pencatatan.');
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::with(['user', 'pencatatan.staff', 'pengecekan.kepala', 'draftSkpp.kepala', 'arsip.staff'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('mitra.pengajuan.show', compact('pengajuan'));
    }

    public function edit($id)
    {
        $pengajuan = Pengajuan::where('user_id', Auth::id())->findOrFail($id);

        if ($pengajuan->status !== 'menunggu' && $pengajuan->status_pencatatan !== 'belum_dicatat') {
            return redirect()->route('mitra.pengajuan.show', $id)
                ->with('error', 'Pengajuan yang sudah diproses atau ditinjau tidak dapat diedit.');
        }

        return view('mitra.pengajuan.edit', compact('pengajuan'));
    }

    public function update(Request $request, $id)
    {
        $pengajuan = Pengajuan::where('user_id', Auth::id())->findOrFail($id);

        if ($pengajuan->status !== 'menunggu' && $pengajuan->status_pencatatan !== 'belum_dicatat') {
            return redirect()->route('mitra.pengajuan.show', $id)
                ->with('error', 'Pengajuan yang sedang diproses tidak dapat diubah.');
        }

        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'npwp' => 'nullable|string|max:50',
            'keperluan' => 'required|string|max:1000',
            'file_slip_gaji' => 'nullable|file|mimes:pdf|max:2048',
            'file_sk' => 'nullable|file|mimes:pdf|max:2048',
            'file_skpp' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = [
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat' => $request->alamat,
            'npwp' => $request->npwp,
            'keperluan' => $request->keperluan,
        ];

        if ($request->hasFile('file_slip_gaji')) {
            if ($pengajuan->file_slip_gaji && Storage::disk('public')->exists($pengajuan->file_slip_gaji)) {
                Storage::disk('public')->delete($pengajuan->file_slip_gaji);
            }
            $data['file_slip_gaji'] = $request->file('file_slip_gaji')->store('pengajuan/slip_gaji', 'public');
        }

        if ($request->hasFile('file_sk')) {
            if ($pengajuan->file_sk && Storage::disk('public')->exists($pengajuan->file_sk)) {
                Storage::disk('public')->delete($pengajuan->file_sk);
            }
            $data['file_sk'] = $request->file('file_sk')->store('pengajuan/sk', 'public');
        }

        if ($request->hasFile('file_skpp')) {
            if ($pengajuan->file_skpp && Storage::disk('public')->exists($pengajuan->file_skpp)) {
                Storage::disk('public')->delete($pengajuan->file_skpp);
            }
            $data['file_skpp'] = $request->file('file_skpp')->store('pengajuan/skpp', 'public');
        }

        $pengajuan->update($data);

        return redirect()->route('mitra.pengajuan.index')
            ->with('success', 'Data pengajuan berhasil diperbarui.');
    }

    public function status(Request $request)
    {
        $pengajuans = Pengajuan::where('user_id', Auth::id())
            ->with(['pencatatan', 'pengecekan', 'draftSkpp', 'arsip'])
            ->latest()
            ->paginate(10);

        return view('mitra.pengajuan.status', compact('pengajuans'));
    }

    public function riwayat(Request $request)
    {
        $pengajuans = Pengajuan::where('user_id', Auth::id())
            ->with(['pencatatan', 'pengecekan', 'draftSkpp', 'arsip'])
            ->latest()
            ->paginate(10);

        return view('mitra.pengajuan.riwayat', compact('pengajuans'));
    }

    public function destroy($id)
    {
        $pengajuan = Pengajuan::where('user_id', Auth::id())->findOrFail($id);

        if ($pengajuan->status !== 'menunggu' && $pengajuan->status_pencatatan !== 'belum_dicatat') {
            return redirect()->route('mitra.pengajuan.index')
                ->with('error', 'Pengajuan yang sudah diproses tidak dapat dibatalkan.');
        }

        foreach (['file_slip_gaji', 'file_sk', 'file_skpp'] as $fileField) {
            if ($pengajuan->$fileField && Storage::disk('public')->exists($pengajuan->$fileField)) {
                Storage::disk('public')->delete($pengajuan->$fileField);
            }
        }

        $pengajuan->delete();

        return redirect()->route('mitra.pengajuan.index')
            ->with('success', 'Pengajuan berhasil dibatalkan dan dihapus.');
    }

    /**
     * Secure view/download for documents
     */
    public function viewDocument($id, $type): BinaryFileResponse
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $user = Auth::user();

        // Authorization check: Mitra must own it, staff or kepala can view
        if ($user->role === 'mitra' && $pengajuan->user_id !== $user->id) {
            abort(403, 'Akses ditolak.');
        }

        $filePath = match ($type) {
            'slip_gaji' => $pengajuan->file_slip_gaji,
            'sk' => $pengajuan->file_sk,
            'skpp' => $pengajuan->file_skpp,
            'draft' => $pengajuan->draftSkpp?->file_skpp,
            default => null,
        };

        if (! $filePath || ! Storage::disk('public')->exists($filePath)) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        return response()->file(Storage::disk('public')->path($filePath));
    }
}
