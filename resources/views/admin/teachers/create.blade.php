@extends('layouts.app')

@section('title', 'Add Teacher')

@section('content')
<h2 class="mb-4">Add Teacher</h2>
<form method="POST" action="{{ route('admin.teachers.store') }}">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Unique ID <small class="text-muted">(6–12 alphanumeric)</small></label>
            <input type="text" class="form-control @error('unique_id') is-invalid @enderror" name="unique_id" value="{{ old('unique_id') }}" required>
            @error('unique_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" required>
            @error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Gender</label>
            <select class="form-select @error('gender') is-invalid @enderror" name="gender" required>
                <option value="">Select</option>
                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Date of Join</label>
            <input type="date" class="form-control @error('date_of_join') is-invalid @enderror" name="date_of_join" value="{{ old('date_of_join') }}" required>
            @error('date_of_join')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Salary per Hour</label>
            <input type="number" step="0.01" min="0" class="form-control @error('salary_per_hour') is-invalid @enderror" name="salary_per_hour" value="{{ old('salary_per_hour') }}" required>
            @error('salary_per_hour')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Create Teacher</button>
            <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>
@endsection
