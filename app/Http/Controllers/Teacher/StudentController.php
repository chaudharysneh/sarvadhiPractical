<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;

class StudentController extends Controller
{
    public function index()
    {
        $teacher = Teacher::find(auth()->user()->role_id);
        $students = $teacher->students()->orderBy('full_name')->get();
        return view('teacher.students.index', compact('students'));
    }
}
