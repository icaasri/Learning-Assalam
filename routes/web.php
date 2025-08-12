<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return 'Ini adalah dashboard Admin';
    } elseif ($user->role === 'guru') {
        return 'Ini adalah dashboard Guru';
    } else {
        return 'Ini adalah dashboard Siswa';
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup Rute untuk Admin
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Contoh: Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

// Grup Rute untuk Guru
Route::middleware(['auth', 'verified', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    // Contoh: Route::resource('materi', MaterialController::class);
});

// Grup Rute untuk Siswa
Route::middleware(['auth', 'verified', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    // Contoh: Route::get('/materi', [SiswaMaterialController::class, 'index'])->name('materi.index');
});

require __DIR__.'/auth.php';