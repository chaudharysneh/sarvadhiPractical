<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;

class SessionController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $student = Student::find(auth()->user()->role_id);
        $query = $student->teachingSessions()->with('teacher');

        if ($request->filled('date_from')) {
            $query->whereDate('start_time', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('start_time', '<=', $request->date_to);
        }
        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        $sessions = $query->orderByDesc('start_time')->paginate(15)->withQueryString();
        $teachers = $student->teachers()->orderBy('full_name')->get();

        return view('student.sessions.index', compact('sessions', 'teachers'));
    }
}
