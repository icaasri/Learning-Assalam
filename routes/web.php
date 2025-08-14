<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CourseAssignmentController;
use App\Http\Controllers\Guru\AssignmentController as GuruAssignmentController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\Siswa\SubmissionController;
use App\Http\Controllers\TakeQuizController;
use App\Http\Controllers\StudentMaterialController;
use App\Http\Controllers\StudentCourseController;
use App\Http\Controllers\ProfileController;

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

// Halaman utama, langsung arahkan ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rute Dashboard utama yang akan mengarahkan pengguna berdasarkan peran
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'guru') {
        return redirect()->route('guru.assignments.index'); // Arahkan guru ke daftar tugas
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
    Route::resource('assignments', GuruAssignmentController::class);
    
    // Rute untuk Pertanyaan (CRUD Lengkap)
    Route::post('quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('quizzes.questions.store');
    Route::get('questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
});

// --- GRUP RUTE UNTUK SISWA ---
Route::middleware(['auth', 'verified', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('dashboard', [TakeQuizController::class, 'dashboard'])->name('dashboard');
    Route::get('courses/{course}', [StudentCourseController::class, 'show'])->name('courses.show');
    Route::get('materials/{material}', [StudentMaterialController::class, 'show'])->name('materials.show');
    Route::post('materials/{material}/complete', [StudentMaterialController::class, 'complete'])->name('materials.complete');
    Route::get('quizzes/{quiz}', [TakeQuizController::class, 'show'])->name('quizzes.show');
    Route::post('quizzes/{quiz}', [TakeQuizController::class, 'submit'])->name('quizzes.submit');
    Route::get('quizzes/{quiz}/result/{attempt}', [TakeQuizController::class, 'result'])->name('quizzes.result');
    Route::post('assignments/{assignment}/submit', [SubmissionController::class, 'store'])->name('assignments.submit');
});

// Rute Profil untuk semua pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute autentikasi bawaan dari Laravel Breeze
require __DIR__.'/auth.php';