<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermohonanController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ================= MITRA =================
    Route::middleware('role:mitra')->prefix('mitra')->group(function () {

        Route::get('/dashboard', fn() => view('mitra.dashboard'))->name('mitra.dashboard');

        // CRUD Permohonan
        Route::resource('permohonan', PermohonanController::class);

    });

    // ================= STAFF =================
    Route::middleware('role:staff')->prefix('staff')->group(function () {
        Route::get('/dashboard', fn() => view('staff.dashboard'))->name('staff.dashboard');
    });

    // ================= KEPALA =================
    Route::middleware('role:kepala')->prefix('kepala')->group(function () {
        Route::get('/dashboard', fn() => view('kepala.dashboard'))->name('kepala.dashboard');
    });

    // ================= PROFILE =================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';