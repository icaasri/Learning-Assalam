<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini

class QuizController extends Controller
{
    public function index()
    {
        $courseIds = Auth::user()->courses()->pluck('id');
        $quizzes = Quiz::whereIn('course_id', $courseIds)->latest()->paginate(10);
        return view('guru.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $courses = Auth::user()->courses;
        return view('guru.quizzes.create', compact('courses'));
    }

    // ... (method store tidak berubah)

    public function show(Quiz $quiz)
    {
        if (!Auth::user()->courses()->find($quiz->course_id)) {
            abort(403);
        }
        return view('guru.quizzes.show', compact('quiz'));
    }

    // ... (sisa method bisa ditambahkan otorisasi serupa jika perlu)
}