<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentMaterialController extends Controller
{
    public function show(Material $material)
    {
        $isCompleted = MaterialProgress::where('user_id', Auth::id())
                                       ->where('material_id', $material->id)
                                       ->exists();

        return view('siswa.materials.show', compact('material', 'isCompleted'));
    }

    public function complete(Request $request, Material $material)
    {
        MaterialProgress::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'material_id' => $material->id,
            ],
            [
                'completed_at' => now()
            ]
        );

        return redirect()->route('siswa.dashboard')->with('success', 'Materi telah ditandai sebagai selesai!');
    }
}