<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Course; // <-- Tambahkan ini
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::latest()->paginate(10);
        return view('guru.materials.index', compact('materials'));
    }

    public function create()
    {
        $courses = Course::all(); // <-- Ambil semua mata pelajaran
        return view('guru.materials.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'video_url' => 'nullable|url',
        ]);

        Material::create($request->all());

        return redirect()->route('guru.materials.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show(Material $material)
    {
        return view('guru.materials.show', compact('material'));
    }

    public function edit(Material $material)
    {
        $courses = Course::all();
        return view('guru.materials.edit', compact('material', 'courses'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'video_url' => 'nullable|url',
        ]);

        $material->update($request->all());

        return redirect()->route('guru.materials.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('guru.materials.index')->with('success', 'Materi berhasil dihapus.');
    }
}