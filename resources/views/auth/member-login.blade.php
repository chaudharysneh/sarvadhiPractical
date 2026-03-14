@extends('layouts.app')

@section('title', 'Teacher / Student Login')

@section('content')
<div class="row justify-content-center py-5">
    <div class="col-md-5">
        <div class="card auth-card">
            <div class="card-header">
                <h5 class="mb-0">Teacher / Student Login</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login.member.post') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="unique_id" class="form-label">Unique ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('unique_id') is-invalid @enderror" id="unique_id" name="unique_id" value="{{ old('unique_id') }}" autofocus>
                        @error('unique_id')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        @error('password')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                            <option value="">Select role</option>
                            <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>Teacher</option>
                            <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student</option>
                        </select>
                        @error('role')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <p class="mt-4 mb-0 text-center small"><a href="{{ url('/') }}" class="text-decoration-none" style="color: var(--color-primary);">Back to home</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
