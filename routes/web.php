<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::middleware('role:mitra')->prefix('mitra')->group(function () {
        Route::get('/dashboard', fn() => view('mitra.dashboard'));
    });

    Route::middleware('role:staff')->prefix('staff')->group(function () {
        Route::get('/dashboard', fn() => view('staff.dashboard'));
    });

    Route::middleware('role:kepala')->prefix('kepala')->group(function () {
        Route::get('/dashboard', fn() => view('kepala.dashboard'));
    });

});


require __DIR__.'/auth.php';
