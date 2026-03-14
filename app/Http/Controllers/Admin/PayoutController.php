<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeachingSession;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index(Request $request)
    {
        $dateFrom = $request->filled('date_from') ? Carbon::parse($request->date_from)->startOfDay() : now()->startOfMonth();
        $dateTo = $request->filled('date_to') ? Carbon::parse($request->date_to)->endOfDay() : now()->endOfDay();

        $teachers = Teacher::with('teachingSessions')->get()->map(function (Teacher $teacher) use ($dateFrom, $dateTo, $request) {
            $sessions = $teacher->teachingSessions()
                ->whereBetween('start_time', [$dateFrom, $dateTo]);
            if ($request->filled('student_id')) {
                $sessions->whereHas('students', fn ($q) => $q->where('students.id', $request->student_id));
            }
            $sessions = $sessions->get();
            $totalHours = $sessions->sum(fn ($s) => $s->start_time->diffInMinutes($s->end_time) / 60);
            $amount = round($totalHours * (float) $teacher->salary_per_hour, 2);
            return (object) [
                'teacher' => $teacher,
                'total_hours' => round($totalHours, 2),
                'amount' => $amount,
                'sessions_count' => $sessions->count(),
            ];
        });

        $students = Student::orderBy('full_name')->get();
        return view('admin.payouts.index', compact('teachers', 'students', 'dateFrom', 'dateTo'));
    }
}
