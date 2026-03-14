@extends('layouts.app')

@section('title', 'Edit Teacher')

@section('content')
<h2 class="mb-4">Edit Teacher</h2>
<form method="POST" action="{{ route('admin.teachers.update', $teacher) }}">
    @csrf
    @method('PUT')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Unique ID</label>
            <input type="text" class="form-control @error('unique_id') is-invalid @enderror" name="unique_id" value="{{ old('unique_id', $teacher->unique_id) }}" required>
            @error('unique_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $teacher->email) }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
        <div class="col-md-6">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name', $teacher->full_name) }}" required>
            @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Gender</label>
            <select class="form-select" name="gender" required>
                <option value="male" {{ old('gender', $teacher->gender) === 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $teacher->gender) === 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender', $teacher->gender) === 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Date of Join</label>
            <input type="date" class="form-control" name="date_of_join" value="{{ old('date_of_join', $teacher->date_of_join->format('Y-m-d')) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Salary per Hour</label>
            <input type="number" step="0.01" min="0" class="form-control" name="salary_per_hour" value="{{ old('salary_per_hour', $teacher->salary_per_hour) }}" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>
@endsection
