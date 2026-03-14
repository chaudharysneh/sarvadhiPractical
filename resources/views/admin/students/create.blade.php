@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
<h2 class="mb-4">Add Student</h2>
<form method="POST" action="{{ route('admin.students.store') }}">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Unique ID <span class="text-danger">*</span> <small class="text-muted">(6–12 alphanumeric)</small></label>
            <input type="text" class="form-control @error('unique_id') is-invalid @enderror" name="unique_id" value="{{ old('unique_id') }}">
            @error('unique_id')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Full Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}">
            @error('full_name')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Parent Contact Number <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('parent_contact_number') is-invalid @enderror" name="parent_contact_number" value="{{ old('parent_contact_number') }}">
            @error('parent_contact_number')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Parent Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control @error('parent_email') is-invalid @enderror" name="parent_email" value="{{ old('parent_email') }}">
            @error('parent_email')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" max="{{ \Carbon\Carbon::yesterday()->format('Y-m-d') }}">
            @error('dob')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Date of Join <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('date_of_join') is-invalid @enderror" name="date_of_join" value="{{ old('date_of_join') }}">
            @error('date_of_join')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Weekly Max Hours <span class="text-danger">*</span></label>
            <input type="number" step="0.01" min="0" class="form-control @error('weekly_max_hours') is-invalid @enderror" name="weekly_max_hours" value="{{ old('weekly_max_hours') }}">
            @error('weekly_max_hours')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Daily Max Hours <span class="text-danger">*</span></label>
            <input type="number" step="0.01" min="0" class="form-control @error('daily_max_hours') is-invalid @enderror" name="daily_max_hours" value="{{ old('daily_max_hours') }}">
            @error('daily_max_hours')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Password <span class="text-danger">*</span> <small>(for student login)</small></label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
            @error('password')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Create Student</button>
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>
@endsection
