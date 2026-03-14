@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="row justify-content-center py-5">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Admin Login</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login.admin.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Login</button>
                </form>
                <p class="mt-3 mb-0 text-center small"><a href="{{ url('/') }}">Back to home</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
