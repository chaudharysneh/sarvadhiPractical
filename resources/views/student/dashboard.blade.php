@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="page-header">
    <h2>Welcome, {{ $student->full_name }}</h2>
</div>
<div class="row g-4">
    <div class="col-md-6">
        <div class="card app-card">
            <div class="card-body">
                <h5 class="card-title">My Sessions</h5>
                <p class="display-6 mb-0 fw-bold" style="color: var(--color-primary);">{{ $sessionsCount }}</p>
                <a href="{{ route('student.sessions.index') }}" class="btn btn-sm btn-outline-primary mt-3">View</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card app-card">
            <div class="card-body">
                <h5 class="card-title">Assigned Teachers</h5>
                <p class="display-6 mb-0 fw-bold" style="color: var(--color-primary);">{{ $teachersCount }}</p>
                <a href="{{ route('student.teachers.index') }}" class="btn btn-sm btn-outline-primary mt-3">View</a>
            </div>
        </div>
    </div>
</div>
@endsection
