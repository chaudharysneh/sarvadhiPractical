<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index(Request $request)
    {
        $teacher = Teacher::find(auth()->user()->role_id);
        $dateFrom = $request->filled('date_from') ? Carbon::parse($request->date_from)->startOfDay() : now()->startOfMonth();
        $dateTo = $request->filled('date_to') ? Carbon::parse($request->date_to)->endOfDay() : now()->endOfDay();

        $query = $teacher->teachingSessions()->whereBetween('start_time', [$dateFrom, $dateTo]);
        if ($request->filled('student_id')) {
            $query->whereHas('students', fn ($q) => $q->where('students.id', $request->student_id));
        }
        $sessions = $query->with('students')->orderBy('start_time')->get();

        $totalHours = $sessions->sum(fn ($s) => $s->start_time->diffInMinutes($s->end_time) / 60);
        $amount = round($totalHours * (float) $teacher->salary_per_hour, 2);
        $students = $teacher->students()->orderBy('full_name')->get();

        return view('teacher.payouts.index', compact('sessions', 'teacher', 'totalHours', 'amount', 'students', 'dateFrom', 'dateTo'));
    }
}
