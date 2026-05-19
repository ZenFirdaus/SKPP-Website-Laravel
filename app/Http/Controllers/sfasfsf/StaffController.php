<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;

class StaffController extends Controller
{
    /**
     * Dashboard Staff
     */
    public function dashboard()
    {
        // ambil semua pengajuan + relasi user
        $pengajuanList = Pengajuan::with('user')
            ->latest()
            ->get();

        return view('staff.dashboard', compact('pengajuanList'));
    }
}