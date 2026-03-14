@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h2 class="mb-4">Admin Dashboard</h2>
<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Teachers</h5>
                <p class="display-6 mb-0">{{ $teachersCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Students</h5>
                <p class="display-6 mb-0">{{ $studentsCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Sessions</h5>
                <p class="display-6 mb-0">{{ $sessionsCount }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
