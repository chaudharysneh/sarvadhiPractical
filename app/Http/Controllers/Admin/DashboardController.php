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
        return view('admin.dashboard', [
            'teachersCount' => Teacher::count(),
            'studentsCount' => Student::count(),
            'sessionsCount' => TeachingSession::count(),
        ]);
    }
}
