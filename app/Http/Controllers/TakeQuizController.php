<?php
// ... use statements

class TakeQuizController extends Controller
{
    public function dashboard()
    {
        // Tambahkan with('materials') untuk memuat materi juga
        $courses = Course::with(['quizzes', 'materials'])->get();
        return view('siswa.dashboard', compact('courses'));
    }

    // ... sisa method tidak berubah
}