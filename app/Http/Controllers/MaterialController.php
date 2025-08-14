<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        // Ambil ID mata pelajaran yang diajar guru
        $courseIds = Auth::user()->courses()->pluck('id');

        // Tampilkan hanya materi dari mata pelajaran tersebut
        $materials = Material::whereIn('course_id', $courseIds)->latest()->paginate(10);

        return view('guru.materials.index', compact('materials'));
    }

    public function create()
    {
        // Tampilkan hanya mata pelajaran yang diajar guru
        $courses = Auth::user()->courses;
        return view('guru.materials.create', compact('courses'));
    }

    // ... (method store, show, destroy tidak berubah signifikan)

    public function edit(Material $material)
    {
        // Otorisasi: Pastikan guru hanya bisa mengedit materi dari mata pelajarannya
        if (!Auth::user()->courses()->find($material->course_id)) {
            abort(403);
        }

        $courses = Auth::user()->courses;
        return view('guru.materials.edit', compact('material', 'courses'));
    }

    // ... (method update, destroy)
}