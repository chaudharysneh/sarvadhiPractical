<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\SessionDocument;
use App\Models\Student;
use App\Models\TeachingSession;
use App\Services\SessionValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        $teacher = \App\Models\Teacher::find(auth()->user()->role_id);
        $query = $teacher->teachingSessions()->with('students');

        if ($request->filled('date_from')) {
            $query->whereDate('start_time', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('start_time', '<=', $request->date_to);
        }
        if ($request->filled('student_id')) {
            $query->whereHas('students', fn ($q) => $q->where('students.id', $request->student_id));
        }

        $sessions = $query->orderByDesc('start_time')->paginate(15)->withQueryString();
        $students = $teacher->students()->orderBy('full_name')->get();

        return view('teacher.sessions.index', compact('sessions', 'students'));
    }

    public function create()
    {
        $teacher = \App\Models\Teacher::find(auth()->user()->role_id);
        $students = $teacher->students()->orderBy('full_name')->get();
        return view('teacher.sessions.create', compact('students'));
    }

    public function store(Request $request, SessionValidationService $validator)
    {
        $teacher = \App\Models\Teacher::find(auth()->user()->role_id);

        $data = $request->validate([
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => [Rule::in($teacher->students()->pluck('students.id')->toArray())],
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date',
            'end_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:2000',
            'documents.*' => 'nullable|file|mimes:doc,docx,pdf,txt|max:5120',
        ]);

        $startTime = \Carbon\Carbon::parse($data['start_date'] . ' ' . $data['start_time']);
        $endTime = \Carbon\Carbon::parse($data['end_date'] . ' ' . $data['end_time']);
        $students = Student::whereIn('id', $data['student_ids'])->get();

        $errors = $validator->validate($students, $startTime, $endTime);
        if (! empty($errors)) {
            return redirect()->back()->withInput()->withErrors(['student_ids' => $errors]);
        }

        DB::beginTransaction();
        try {
            $session = TeachingSession::create([
                'teacher_id' => $teacher->id,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'notes' => $data['notes'] ?? null,
            ]);
            $session->students()->sync($data['student_ids']);

            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $file) {
                    if (! $file->isValid()) {
                        continue;
                    }
                    $path = $file->store('session-docs', 'local');
                    SessionDocument::create([
                        'teaching_session_id' => $session->id,
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                    ]);
                }
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Failed to create session.');
        }

        return redirect()->route('teacher.sessions.index')->with('success', 'Session added successfully.');
    }
}
