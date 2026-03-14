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

        $students = $teacher->students()->orderBy('full_name')->limit(10)->get();
        $recentSessions = $teacher->teachingSessions()->with('students')
            ->orderByDesc('start_time')
            ->limit(10)
            ->get();

        return view('teacher.dashboard', compact(
            'teacher',
            'sessionsCount',
            'studentsCount',
            'students',
            'recentSessions'
        ));
    }
}
