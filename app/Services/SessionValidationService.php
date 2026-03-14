<?php

namespace App\Services;

use App\Models\Student;
use App\Models\TeachingSession;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SessionValidationService
{
    /**
     * Session cannot be in the future (per doc: "Session can not be added with future time&date").
     * Session cannot exceed daily/weekly max for each selected student.
     * Session cannot overlap with selected students' existing sessions.
     */
    public function validate(Collection $students, Carbon $startTime, Carbon $endTime, ?int $excludeSessionId = null): array
    {
        $errors = [];

        // Only reject if the session date is in the future (use copy() so we don't mutate start/end)
        $today = now()->startOfDay();
        if ($startTime->copy()->startOfDay()->gt($today) || $endTime->copy()->startOfDay()->gt($today)) {
            $errors[] = 'Session must not be on a future date. Use today or a past date.';
        }
        if ($startTime->gte($endTime)) {
            $errors[] = 'End time must be after start time.';
        }

        $durationHours = $startTime->diffInMinutes($endTime) / 60;

        foreach ($students as $student) {
            $student = $student instanceof Student ? $student : Student::find($student);
            if (! $student) {
                continue;
            }

            $dayStart = $startTime->copy()->startOfDay();
            $dayEnd = $startTime->copy()->endOfDay();
            $weekStart = $startTime->copy()->startOfWeek();
            $weekEnd = $startTime->copy()->endOfWeek();

            $existingSessions = TeachingSession::whereHas('students', fn ($q) => $q->where('students.id', $student->id))
                ->when($excludeSessionId, fn ($q) => $q->where('id', '!=', $excludeSessionId));

            $sameDaySessions = (clone $existingSessions)->whereBetween('start_time', [$dayStart, $dayEnd])->get();
            $sameWeekSessions = (clone $existingSessions)->whereBetween('start_time', [$weekStart, $weekEnd])->get();

            $dayHours = $sameDaySessions->sum(fn ($s) => $s->start_time->diffInMinutes($s->end_time) / 60);
            $weekHours = $sameWeekSessions->sum(fn ($s) => $s->start_time->diffInMinutes($s->end_time) / 60);

            if ($dayHours + $durationHours > (float) $student->daily_max_hours) {
                $errors[] = "{$student->full_name}: Would exceed daily max ({$student->daily_max_hours} hrs).";
            }
            if ($weekHours + $durationHours > (float) $student->weekly_max_hours) {
                $errors[] = "{$student->full_name}: Would exceed weekly max ({$student->weekly_max_hours} hrs).";
            }

            $overlaps = (clone $existingSessions)
                ->where('start_time', '<', $endTime)
                ->where('end_time', '>', $startTime)
                ->count();
            if ($overlaps > 0) {
                $errors[] = "{$student->full_name}: Session overlaps with an existing session.";
            }
        }

        return $errors;
    }
}
