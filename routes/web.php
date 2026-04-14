<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\Staff\PencatatanController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Kepala\PengecekanController;

// ================= AUTH =================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ================= MITRA =================
    Route::middleware(['role:mitra'])
        ->prefix('mitra')
        ->name('mitra.')
        ->group(function () {
            Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');

            Route::resource('pengajuan', PengajuanController::class);

            Route::get('/pengajuan/status', [PengajuanController::class, 'status'])->name('pengajuan.status');
            Route::get('/pengajuan/riwayat', [PengajuanController::class, 'riwayat'])->name('pengajuan.riwayat');
        });

    // ================= STAFF =================
    Route::middleware(['role:staff'])
        ->prefix('staff')
        ->name('staff.')
        ->group(function () {
            Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');

            // Pencatatan Data
            Route::get('/pencatatan', [PencatatanController::class, 'index'])->name('pencatatan.index');
            Route::get('/pencatatan/{id}/form', [PencatatanController::class, 'create'])->name('pencatatan.create');
            Route::post('/pencatatan/{id}/store', [PencatatanController::class, 'store'])->name('pencatatan.store');
            Route::get('/pencatatan/{id}/detail', [PencatatanController::class, 'show'])->name('pencatatan.show');
        });

    // ================= KEPALA =================


    Route::middleware(['role:kepala'])->prefix('kepala')->name('kepala.')->group(function () {
        Route::get('/dashboard', fn() => view('kepala.dashboard'))->name('dashboard');
        Route::get('/pengecekan', [PengecekanController::class, 'index'])->name('pengecekan.index');
        Route::get('/pengecekan/{id}', [PengecekanController::class, 'show'])->name('pengecekan.show');
        Route::post('/pengecekan/{id}', [PengecekanController::class, 'store'])->name('pengecekan.store');
    });

    // ================= PROFILE =================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ================= LOGOUT =================
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

require __DIR__ . '/auth.php';
