<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Course;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::latest()->paginate(10);
        return view('guru.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('guru.quizzes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
        ]);

        Quiz::create($request->all());

        return redirect()->route('guru.quizzes.index')->with('success', 'Kuis berhasil dibuat.');
    }

    // Kita akan implementasi fungsi lainnya nanti
    public function show(Quiz $quiz)
    {
        // Tampilkan detail kuis dan daftar pertanyaan
        return view('guru.quizzes.show', compact('quiz'));
    }
}