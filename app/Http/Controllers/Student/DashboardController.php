<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $student = Student::find(auth()->user()->role_id);
        $sessionsCount = $student->teachingSessions()->count();
        $teachersCount = $student->teachers()->count();
        return view('student.dashboard', compact('student', 'sessionsCount', 'teachersCount'));
    }
}
