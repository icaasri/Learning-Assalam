<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class StudentMaterialController extends Controller
{
    /**
     * Menampilkan satu materi pembelajaran.
     */
    public function show(Material $material)
    {
        return view('siswa.materials.show', compact('material'));
    }
}