<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Course;
use App\Models\QuizAttempt;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TakeQuizController extends Controller
{
    public function dashboard()
    {
        // Ambil hanya mata pelajaran yang diikuti siswa
        $courses = Auth::user()->courses()->with(['quizzes', 'materials'])->get();
        return view('siswa.dashboard', compact('courses'));
    }

    public function show(Quiz $quiz)
    {
        // Otorisasi: Pastikan siswa terdaftar di mata pelajaran kuis ini
        if (!Auth::user()->courses()->find($quiz->course_id)) {
            abort(403);
        }

        $quiz->load('questions.answers');
        return view('siswa.quizzes.show', compact('quiz'));
    }

    // ... (sisa method tidak berubah)
}