<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;

class StaffController extends Controller
{
    /**
     * Dashboard Staff
     */
    public function dashboard()
    {
        $stats = [
            'total' => Pengajuan::count(),
            'menunggu_catat' => Pengajuan::where('status_pencatatan', 'belum_dicatat')->count(),
            'selesai_dicatat' => Pengajuan::where('status_pencatatan', 'selesai_dicatat')->count(),
            'siap_arsip' => Pengajuan::where('status_draft', 'sudah_diupload')->where('status_arsip', 'belum')->count(),
            'selesai_arsip' => Pengajuan::where('status_arsip', 'diarsipkan')->count(),
        ];

        // Pengajuan yang memerlukan tindakan staff (perlu pencatatan atau siap arsip)
        $perluTindakan = Pengajuan::with(['user', 'pencatatan', 'draftSkpp', 'arsip'])
            ->where(function ($q) {
                $q->where('status_pencatatan', 'belum_dicatat')
                    ->orWhere(function ($q2) {
                        $q2->where('status_draft', 'sudah_diupload')
                            ->where('status_arsip', 'belum');
                    });
            })
            ->latest()
            ->take(5)
            ->get();

        // Daftar pengajuan terbaru
        $pengajuanTerbaru = Pengajuan::with(['user', 'pencatatan', 'arsip'])
            ->latest()
            ->take(6)
            ->get();

        return view('staff.dashboard', compact('stats', 'perluTindakan', 'pengajuanTerbaru'));
    }
}
