@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="row justify-content-center py-5">
    <div class="col-md-5">
        <div class="card auth-card">
            <div class="card-header">
                <h5 class="mb-0">Admin Login</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login.admin.post') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" autofocus>
                        @error('email')<span class="text-danger d-block">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        @error('password')<span class="text-danger d-block">{{ $message }}</span>@enderror
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
