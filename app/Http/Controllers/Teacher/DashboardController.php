<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $teacher = Teacher::find(auth()->user()->role_id);
        $sessionsCount = $teacher->teachingSessions()->count();
        $studentsCount = $teacher->students()->count();
        return view('teacher.dashboard', compact('teacher', 'sessionsCount', 'studentsCount'));
    }
}
