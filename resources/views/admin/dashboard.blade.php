@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <h2>Admin Dashboard</h2>
</div>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card app-card">
            <div class="card-body">
                <h5 class="card-title">Teachers</h5>
                <p class="display-6 mb-0 fw-bold" style="color: var(--color-primary);">{{ $teachersCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card app-card">
            <div class="card-body">
                <h5 class="card-title">Students</h5>
                <p class="display-6 mb-0 fw-bold" style="color: var(--color-primary);">{{ $studentsCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card app-card">
            <div class="card-body">
                <h5 class="card-title">Sessions</h5>
                <p class="display-6 mb-0 fw-bold" style="color: var(--color-primary);">{{ $sessionsCount }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
