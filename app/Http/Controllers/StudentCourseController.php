<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    public function show(Course $course)
    {
        // Otorisasi: Pastikan siswa terdaftar di mata pelajaran ini
        if (!Auth::user()->courses()->find($course->id)) {
            abort(403);
        }

        // Gabungkan materi dan kuis, lalu urutkan berdasarkan tanggal dibuat
        $learningItems = $course->materials->concat($course->quizzes)->sortBy('created_at');

        // Ambil data progres materi siswa
        $completedMaterials = Auth::user()->materialProgresses->pluck('material_id');

        return view('siswa.courses.show', compact('course', 'learningItems', 'completedMaterials'));
    }
}