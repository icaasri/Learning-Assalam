<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseAssignmentController extends Controller
{
    public function index()
    {
        $courses = Course::withCount(['users as students_count' => function ($query) {
            $query->where('role', 'siswa');
        }, 'users as teachers_count' => function ($query) {
            $query->where('role', 'guru');
        }])->paginate(10);

        return view('admin.assignments.index', compact('courses'));
    }

    public function edit(Course $course)
    {
        $students = User::where('role', 'siswa')->orderBy('name')->get();
        $teachers = User::where('role', 'guru')->orderBy('name')->get();
        $assignedUsers = $course->users->pluck('id')->toArray();

        return view('admin.assignments.edit', compact('course', 'students', 'teachers', 'assignedUsers'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'users' => 'nullable|array',
            'users.*' => 'exists:users,id',
        ]);

        $course->users()->sync($request->input('users', []));

        return redirect()->route('admin.assignments.index')->with('success', 'Penugasan pengguna untuk mata pelajaran berhasil diperbarui.');
    }
}