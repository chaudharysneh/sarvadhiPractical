@extends('layouts.app')

@section('title', 'Teacher Dashboard')

@section('content')
<div class="page-header">
    <h2>Welcome, {{ $teacher->full_name }}</h2>
</div>
<div class="row g-4">
    <div class="col-md-6">
        <div class="card app-card">
            <div class="card-body">
                <h5 class="card-title">My Sessions</h5>
                <p class="display-6 mb-0 fw-bold" style="color: var(--color-primary);">{{ $sessionsCount }}</p>
                <a href="{{ route('teacher.sessions.index') }}" class="btn btn-sm btn-outline-primary mt-3">View</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card app-card">
            <div class="card-body">
                <h5 class="card-title">Assigned Students</h5>
                <p class="display-6 mb-0 fw-bold" style="color: var(--color-primary);">{{ $studentsCount }}</p>
                <a href="{{ route('teacher.students.index') }}" class="btn btn-sm btn-outline-primary mt-3">View</a>
            </div>
        </div>
    </div>
</div>
@endsection
