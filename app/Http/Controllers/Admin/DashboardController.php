<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeachingSession;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $teachersCount = Teacher::count();
        $studentsCount = Student::count();
        $sessionsCount = TeachingSession::count();

        $teachers = Teacher::orderBy('full_name')->limit(10)->get();
        $students = Student::orderBy('full_name')->limit(10)->get();
        $recentSessions = TeachingSession::with('teacher', 'students')
            ->orderByDesc('start_time')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'teachersCount',
            'studentsCount',
            'sessionsCount',
            'teachers',
            'students',
            'recentSessions'
        ));
    }
}
