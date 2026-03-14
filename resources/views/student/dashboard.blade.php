@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="page-header">
    <h2>Welcome, {{ $student->full_name }}</h2>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card app-card">
            <div class="card-body">
                <h5 class="card-title">My Sessions</h5>
                <p class="display-6 mb-0 fw-bold" style="color: var(--color-primary);">{{ $sessionsCount }}</p>
                <a href="{{ route('student.sessions.index') }}" class="btn btn-sm btn-outline-primary mt-3">View all</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card app-card">
            <div class="card-body">
                <h5 class="card-title">Assigned Teachers</h5>
                <p class="display-6 mb-0 fw-bold" style="color: var(--color-primary);">{{ $teachersCount }}</p>
                <a href="{{ route('student.teachers.index') }}" class="btn btn-sm btn-outline-primary mt-3">View all</a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card app-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>My Teachers</span>
                @if($teachersCount > 0)
                    <a href="{{ route('student.teachers.index') }}" class="btn btn-sm btn-outline-primary">View all</a>
                @endif
            </div>
            <div class="card-body p-0">
                @if($teachers->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Unique ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachers as $t)
                                    <tr>
                                        <td>{{ $t->unique_id }}</td>
                                        <td>{{ $t->full_name }}</td>
                                        <td>{{ $t->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($teachersCount > 10)
                        <p class="small text-muted mb-0 px-3 py-2">Showing 10 of {{ $teachersCount }} teachers.</p>
                    @endif
                @else
                    <div class="text-center py-5 px-3">
                        <p class="text-muted mb-2">No teachers assigned to you yet.</p>
                        <p class="small text-muted mb-0">An admin will assign teachers to you from the Assignments page.</p>
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
                    <a href="{{ route('student.sessions.index') }}" class="btn btn-sm btn-outline-primary">View all</a>
                @endif
            </div>
            <div class="card-body p-0">
                @if($recentSessions->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Teacher</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSessions as $s)
                                    <tr>
                                        <td>{{ $s->start_time->format('M d, Y H:i') }} – {{ $s->end_time->format('H:i') }}</td>
                                        <td>{{ $s->teacher->full_name }}</td>
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
                        <p class="text-muted mb-2">No sessions yet.</p>
                        <p class="small text-muted mb-0">Your session history will appear here once your teachers add sessions.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
