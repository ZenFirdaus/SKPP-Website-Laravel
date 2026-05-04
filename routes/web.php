<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\Staff\PencatatanController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Staff\ArsipController;
use App\Http\Controllers\Kepala\PengecekanController;
use App\Http\Controllers\Kepala\DraftController;
use App\Http\Controllers\Mitra\PengunduhController;


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
            Route::get('/dashboard', fn() => view('mitra.dashboard'))->name('dashboard');

            // Pengajuan
            Route::get('/pengajuan/status', [PengajuanController::class, 'status'])->name('pengajuan.status');
            Route::get('/pengajuan/riwayat', [PengajuanController::class, 'riwayat'])->name('pengajuan.riwayat');
            Route::resource('pengajuan', PengajuanController::class);

            // Pengunduhan SKPP
            Route::get('/pengunduhan', [PengunduhController::class, 'index'])->name('pengunduhan.index');
            Route::get('/pengunduhan/{id}/download', [PengunduhController::class, 'unduh'])->name('pengunduhan.download');
        });

    // ================= STAFF =================
    Route::middleware(['role:staff'])
        ->prefix('staff')
        ->name('staff.')
        ->group(function () {
            Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');

            // Pencatatan
            Route::get('/pencatatan', [PencatatanController::class, 'index'])->name('pencatatan.index');
            Route::get('/pencatatan/{id}/form', [PencatatanController::class, 'create'])->name('pencatatan.create');
            Route::post('/pencatatan/{id}/store', [PencatatanController::class, 'store'])->name('pencatatan.store');
            Route::get('/pencatatan/{id}/detail', [PencatatanController::class, 'show'])->name('pencatatan.show');

            // Pengarsipan
            Route::get('/pengarsipan', [ArsipController::class, 'index'])->name('pengarsipan.index');
            Route::post('/pengarsipan/{id}', [ArsipController::class, 'store'])->name('pengarsipan.store');
            Route::post('/pengarsipan/{id}/kirim', [ArsipController::class, 'kirimMitra'])->name('pengarsipan.kirim');
        });

    // ================= KEPALA =================
    Route::middleware(['role:kepala'])
        ->prefix('kepala')
        ->name('kepala.')
        ->group(function () {
            Route::get('/dashboard', fn() => view('kepala.dashboard'))->name('dashboard');

            // Pengecekan
            Route::get('/pengecekan', [PengecekanController::class, 'index'])->name('pengecekan.index');
            Route::get('/pengecekan/trash', [PengecekanController::class, 'trash'])->name('pengecekan.trash');
            Route::get('/pengecekan/{id}', [PengecekanController::class, 'show'])->name('pengecekan.show');
            Route::post('/pengecekan/{id}', [PengecekanController::class, 'store'])->name('pengecekan.store');
            Route::delete('/pengecekan/{id}/hapus', [PengecekanController::class, 'destroy'])->name('pengecekan.destroy');
            Route::post('/pengecekan/{id}/pulihkan', [PengecekanController::class, 'restore'])->name('pengecekan.pulihkan');

            // Draft SKPP
            Route::get('/draft', [DraftController::class, 'index'])->name('draft.index');
            Route::get('/draft/{id}/upload', [DraftController::class, 'create'])->name('draft.create');
            Route::post('/draft/{id}/upload', [DraftController::class, 'store'])->name('draft.store');
        });

    // ================= PROFILE =================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ================= LOGOUT =================
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    
});

// Panduan Pengguna - bisa diakses semua role
Route::get('/panduan', function () {
    return view('panduan');
})->name('panduan');

require __DIR__ . '/auth.php';

