@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row justify-content-center py-5">
    <div class="col-md-8 text-center">
        <h1 class="mb-4">Manage Digital Education System</h1>
        <p class="lead text-muted mb-4">Sign in to continue</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('login.member') }}" class="btn btn-primary btn-lg">Teacher / Student Login</a>
            <a href="{{ route('login.admin') }}" class="btn btn-outline-primary btn-lg">Admin Login</a>
        </div>
        <p class="mt-4 small text-muted">
            Teachers and students: use Unique ID, Password and Role.<br>
            Admin: use Email and Password.
        </p>
    </div>
</div>
@endsection
