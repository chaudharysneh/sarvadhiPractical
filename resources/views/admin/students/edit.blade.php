@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<h2 class="mb-4">Edit Student</h2>
<form method="POST" action="{{ route('admin.students.update', $student) }}">
    @csrf
    @method('PUT')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Unique ID</label>
            <input type="text" class="form-control @error('unique_id') is-invalid @enderror" name="unique_id" value="{{ old('unique_id', $student->unique_id) }}" required>
            @error('unique_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" name="full_name" value="{{ old('full_name', $student->full_name) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Parent Contact Number</label>
            <input type="text" class="form-control" name="parent_contact_number" value="{{ old('parent_contact_number', $student->parent_contact_number) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Parent Email</label>
            <input type="email" class="form-control" name="parent_email" value="{{ old('parent_email', $student->parent_email) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Date of Birth</label>
            <input type="date" class="form-control" name="dob" value="{{ old('dob', $student->dob->format('Y-m-d')) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Date of Join</label>
            <input type="date" class="form-control" name="date_of_join" value="{{ old('date_of_join', $student->date_of_join->format('Y-m-d')) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Weekly Max Hours</label>
            <input type="number" step="0.01" min="0" class="form-control" name="weekly_max_hours" value="{{ old('weekly_max_hours', $student->weekly_max_hours) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Daily Max Hours</label>
            <input type="number" step="0.01" min="0" class="form-control" name="daily_max_hours" value="{{ old('daily_max_hours', $student->daily_max_hours) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">New Password <small class="text-muted">(leave blank to keep)</small></label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>
@endsection
