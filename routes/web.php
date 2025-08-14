<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CourseAssignmentController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TakeQuizController;
use App\Http\Controllers\StudentMaterialController;

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

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Rute Dashboard utama yang akan mengarahkan pengguna berdasarkan peran
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'guru') {
        return redirect()->route('guru.materials.index');
    } else {
        return redirect()->route('siswa.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// --- GRUP RUTE UNTUK ADMIN ---
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('courses', AdminCourseController::class);
    Route::resource('users', AdminUserController::class);
    
    // Rute untuk Penugasan
    Route::get('assignments', [CourseAssignmentController::class, 'index'])->name('assignments.index');
    Route::get('assignments/{course}', [CourseAssignmentController::class, 'edit'])->name('assignments.edit');
    Route::put('assignments/{course}', [CourseAssignmentController::class, 'update'])->name('assignments.update');
});

// --- GRUP RUTE UNTUK GURU ---
Route::middleware(['auth', 'verified', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::resource('materials', MaterialController::class);
    Route::resource('quizzes', QuizController::class);
    Route::post('quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('quizzes.questions.store');
});

// --- GRUP RUTE UNTUK SISWA ---
Route::middleware(['auth', 'verified', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('dashboard', [TakeQuizController::class, 'dashboard'])->name('dashboard');
    Route::get('materials/{material}', [StudentMaterialController::class, 'show'])->name('materials.show');
    Route::post('materials/{material}/complete', [StudentMaterialController::class, 'complete'])->name('materials.complete');
    Route::get('quizzes/{quiz}', [TakeQuizController::class, 'show'])->name('quizzes.show');
    Route::post('quizzes/{quiz}', [TakeQuizController::class, 'submit'])->name('quizzes.submit');
    Route::get('quizzes/{quiz}/result/{attempt}', [TakeQuizController::class, 'result'])->name('quizzes.result');
});

// Rute autentikasi bawaan dari Laravel Breeze
require __DIR__.'/auth.php';