@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<h2 class="mb-4">Welcome, {{ $student->full_name }}</h2>
<div class="row g-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">My Sessions</h5>
                <p class="display-6 mb-0">{{ $sessionsCount }}</p>
                <a href="{{ route('student.sessions.index') }}" class="btn btn-sm btn-outline-primary mt-2">View</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Assigned Teachers</h5>
                <p class="display-6 mb-0">{{ $teachersCount }}</p>
                <a href="{{ route('student.teachers.index') }}" class="btn btn-sm btn-outline-primary mt-2">View</a>
            </div>
        </div>
    </div>
</div>
@endsection
