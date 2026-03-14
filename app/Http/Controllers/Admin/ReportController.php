<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MonthlySessionReport;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('full_name')->get();
        return view('admin.reports.index', compact('students'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'month' => 'required|date_format:Y-m',
        ]);

        $student = Student::with(['teachingSessions' => fn ($q) => $q->with('teacher')])->findOrFail($request->student_id);
        $start = Carbon::parse($request->month)->startOfMonth();
        $end = $start->copy()->endOfMonth();
        $sessions = $student->teachingSessions()
            ->whereBetween('start_time', [$start, $end])
            ->with('teacher')
            ->orderBy('start_time')
            ->get();

        Mail::to($student->parent_email)->send(new MonthlySessionReport($student, $sessions, $start));

        return redirect()->route('admin.reports.index')->with('success', 'Monthly report sent to ' . $student->parent_email);
    }
}
