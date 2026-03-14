@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row justify-content-center py-5">
    <div class="col-md-8 text-center">
        <h1 class="hero-title">Manage Digital Education System</h1>
        <p class="hero-subtitle">Sign in to continue</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap hero-actions">
            <a href="{{ route('login.member') }}" class="btn btn-primary btn-lg">Teacher / Student Login</a>
            <a href="{{ route('login.admin') }}" class="btn btn-outline-primary btn-lg">Admin Login</a>
        </div>
        <p class="hero-note">
            Teachers and students: use Unique ID, Password and Role.<br>
            Admin: use Email and Password.
        </p>
    </div>
</div>
@endsection
