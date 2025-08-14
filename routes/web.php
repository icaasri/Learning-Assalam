<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController; // <-- Tambahkan ini
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TakeQuizController;
use App\Http\Controllers\StudentMaterialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Rute Dashboard utama yang akan mengarahkan pengguna berdasarkan peran
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        // Arahkan admin ke dashboard statistik mereka
        return redirect()->route('admin.dashboard'); // <-- Ubah ini
    } elseif ($user->role === 'guru') {
        return redirect()->route('guru.materials.index');
    } else {
        return redirect()->route('siswa.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// --- GRUP RUTE UNTUK ADMIN ---
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard'); // <-- Tambahkan Rute ini
    Route::resource('courses', AdminCourseController::class);
    Route::resource('users', AdminUserController::class);
});

// ... (Sisa grup rute guru dan siswa tidak berubah)

// Rute autentikasi bawaan dari Laravel Breeze
require __DIR__.'/auth.php';