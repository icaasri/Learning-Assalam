<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- Tambahkan ini

class MaterialController extends Controller
{
    // ... (method index, create, show tidak berubah)

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'video_url' => 'nullable|url',
            'file' => 'nullable|file|mimes:pdf,docx,pptx|max:10240', // Validasi file (maks 10MB)
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            // Simpan file ke storage/app/public/materials
            $filePath = $request->file('file')->store('materials', 'public');
            $data['file_path'] = $filePath;
        }

        Material::create($data);

        return redirect()->route('guru.materials.index')->with('success', 'Materi berhasil ditambahkan.');
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
            'file' => 'nullable|file|mimes:pdf,docx,pptx|max:10240',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($material->file_path) {
                Storage::disk('public')->delete($material->file_path);
            }
            // Simpan file baru
            $filePath = $request->file('file')->store('materials', 'public');
            $data['file_path'] = $filePath;
        }

        $material->update($data);

        return redirect()->route('guru.materials.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Material $material)
    {
        // Hapus file dari storage saat materi dihapus
        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }
        $material->delete();
        return redirect()->route('guru.materials.index')->with('success', 'Materi berhasil dihapus.');
    }
}