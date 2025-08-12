<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\QuizController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return 'Ini adalah dashboard Admin';
    } elseif ($user->role === 'guru') {
        // Arahkan guru ke halaman daftar materi sebagai halaman utama mereka
        return redirect()->route('guru.materials.index');
    } else {
        return 'Ini adalah dashboard Siswa';
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup Rute untuk Admin
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Rute untuk fungsionalitas admin akan ditambahkan di sini
});

// Grup Rute untuk Guru
Route::middleware(['auth', 'verified', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::resource('materials', MaterialController::class);
    Route::resource('quizzes', QuizController::class);
});

// Grup Rute untuk Siswa
Route::middleware(['auth', 'verified', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    // Rute untuk fungsionalitas siswa akan ditambahkan di sini
});

require __DIR__.'/auth.php';