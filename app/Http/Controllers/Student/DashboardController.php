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

        $teachers = $student->teachers()->orderBy('full_name')->limit(10)->get();
        $recentSessions = $student->teachingSessions()->with('teacher')
            ->orderByDesc('start_time')
            ->limit(10)
            ->get();

        return view('student.dashboard', compact(
            'student',
            'sessionsCount',
            'teachersCount',
            'teachers',
            'recentSessions'
        ));
    }
}
