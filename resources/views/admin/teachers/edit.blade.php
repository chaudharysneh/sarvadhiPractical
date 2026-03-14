@extends('layouts.app')

@section('title', 'Edit Teacher')

@section('content')
<h2 class="mb-4">Edit Teacher</h2>
<form method="POST" action="{{ route('admin.teachers.update', $teacher) }}">
    @csrf
    @method('PUT')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Unique ID <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('unique_id') is-invalid @enderror" name="unique_id" value="{{ old('unique_id', $teacher->unique_id) }}">
            @error('unique_id')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $teacher->email) }}">
            @error('email')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">New Password <small class="text-muted">(leave blank to keep)</small></label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
            @error('password')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>
        <div class="col-md-6">
            <label class="form-label">Full Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name', $teacher->full_name) }}">
            @error('full_name')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Gender</label>
            <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                <option value="male" {{ old('gender', $teacher->gender) === 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $teacher->gender) === 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender', $teacher->gender) === 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Date of Join <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('date_of_join') is-invalid @enderror" name="date_of_join" value="{{ old('date_of_join', $teacher->date_of_join->format('Y-m-d')) }}">
            @error('date_of_join')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Salary per Hour <span class="text-danger">*</span></label>
            <input type="number" step="0.01" min="0" class="form-control @error('salary_per_hour') is-invalid @enderror" name="salary_per_hour" value="{{ old('salary_per_hour', $teacher->salary_per_hour) }}">
            @error('salary_per_hour')<span class="text-danger d-block">{{ $message }}</span>@enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>
@endsection
