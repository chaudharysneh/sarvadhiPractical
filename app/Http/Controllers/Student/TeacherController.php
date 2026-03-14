<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;

class TeacherController extends Controller
{
    public function index()
    {
        $student = Student::find(auth()->user()->role_id);
        $teachers = $student->teachers()->orderBy('full_name')->get();
        return view('student.teachers.index', compact('teachers'));
    }
}
