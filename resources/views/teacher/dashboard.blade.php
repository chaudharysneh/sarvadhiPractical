@extends('layouts.app')

@section('title', 'Teacher Dashboard')

@section('content')
<div class="page-header">
    <h2>Welcome, {{ $teacher->full_name }}</h2>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card app-card">
            <div class="card-body">
                <h5 class="card-title">My Sessions</h5>
                <p class="display-6 mb-0 fw-bold" style="color: var(--color-primary);">{{ $sessionsCount }}</p>
                <a href="{{ route('teacher.sessions.index') }}" class="btn btn-sm btn-outline-primary mt-3">View all</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card app-card">
            <div class="card-body">
                <h5 class="card-title">Assigned Students</h5>
                <p class="display-6 mb-0 fw-bold" style="color: var(--color-primary);">{{ $studentsCount }}</p>
                <a href="{{ route('teacher.students.index') }}" class="btn btn-sm btn-outline-primary mt-3">View all</a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card app-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Assigned Students</span>
                @if($studentsCount > 0)
                    <a href="{{ route('teacher.students.index') }}" class="btn btn-sm btn-outline-primary">View all</a>
                @endif
            </div>
            <div class="card-body p-0">
                @if($students->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Unique ID</th>
                                    <th>Name</th>
                                    <th>Parent Contact</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $s)
                                    <tr>
                                        <td>{{ $s->unique_id }}</td>
                                        <td>{{ $s->full_name }}</td>
                                        <td>{{ $s->parent_contact_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($studentsCount > 10)
                        <p class="small text-muted mb-0 px-3 py-2">Showing latest 10 of {{ $studentsCount }} students.</p>
                    @endif
                @else
                    <div class="text-center py-5 px-3">
                        <p class="text-muted mb-2">No students assigned to you yet.</p>
                        <p class="small text-muted mb-0">Ask an admin to assign students to you from the Assignments page.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card app-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Recent Sessions</span>
                @if($sessionsCount > 0)
                    <a href="{{ route('teacher.sessions.index') }}" class="btn btn-sm btn-outline-primary">View all</a>
                @endif
            </div>
            <div class="card-body p-0">
                @if($recentSessions->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Students</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSessions as $s)
                                    <tr>
                                        <td>{{ $s->start_time->format('M d, Y H:i') }} – {{ $s->end_time->format('H:i') }}</td>
                                        <td>{{ $s->students->pluck('full_name')->join(', ') }}</td>
                                        <td>{{ $s->duration_hours }} hrs</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($sessionsCount > 10)
                        <p class="small text-muted mb-0 px-3 py-2">Showing latest 10 of {{ $sessionsCount }} sessions.</p>
                    @endif
                @else
                    <div class="text-center py-5 px-3">
                        <p class="text-muted mb-2">No sessions recorded yet.</p>
                        <p class="small text-muted mb-0">Add a session from the <a href="{{ route('teacher.sessions.create') }}">Add Session</a> page.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
