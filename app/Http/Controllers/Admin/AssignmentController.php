<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('students')->orderBy('full_name')->get();
        return view('admin.assignments.index', compact('teachers'));
    }

    public function edit(Teacher $teacher)
    {
        $assignedIds = $teacher->students()->pluck('students.id')->toArray();
        $students = Student::orderBy('full_name')->get();
        return view('admin.assignments.edit', compact('teacher', 'students', 'assignedIds'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate(['student_ids' => 'nullable|array', 'student_ids.*' => 'exists:students,id']);
        $teacher->students()->sync($request->student_ids ?? []);
        return redirect()->route('admin.assignments.index')->with('success', 'Assignments updated for ' . $teacher->full_name);
    }
}
