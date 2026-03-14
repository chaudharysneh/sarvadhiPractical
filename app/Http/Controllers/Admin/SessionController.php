<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\TeachingSession;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        $query = TeachingSession::with('teacher', 'students');

        if ($request->filled('date_from')) {
            $query->whereDate('start_time', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('start_time', '<=', $request->date_to);
        }
        if ($request->filled('student_id')) {
            $query->whereHas('students', fn ($q) => $q->where('students.id', $request->student_id));
        }

        $sessions = $query->orderByDesc('start_time')->paginate(20)->withQueryString();
        $students = Student::orderBy('full_name')->get();

        return view('admin.sessions.index', compact('sessions', 'students'));
    }
}
