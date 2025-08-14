<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TakeQuizController;
use App\Http\Controllers\StudentMaterialController;

// ... (kode sebelumnya)

// --- GRUP RUTE UNTUK SISWA ---
Route::middleware(['auth', 'verified', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('dashboard', [TakeQuizController::class, 'dashboard'])->name('dashboard');
    Route::get('materials/{material}', [StudentMaterialController::class, 'show'])->name('materials.show');
    Route::post('materials/{material}/complete', [StudentMaterialController::class, 'complete'])->name('materials.complete'); // <-- Tambahkan Rute ini
    Route::get('quizzes/{quiz}', [TakeQuizController::class, 'show'])->name('quizzes.show');
    Route::post('quizzes/{quiz}', [TakeQuizController::class, 'submit'])->name('quizzes.submit');
    Route::get('quizzes/{quiz}/result/{attempt}', [TakeQuizController::class, 'result'])->name('quizzes.result');
});

require __DIR__.'/auth.php';