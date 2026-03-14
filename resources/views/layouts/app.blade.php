<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Digital Education') - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; display: flex; flex-direction: column; }
        main { flex: 1; }
        .navbar-brand { font-weight: 600; }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Digital Education</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav me-auto">
                    @auth
                        @if(auth()->user()->isSuperAdmin())
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.teachers.index') }}">Teachers</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.students.index') }}">Students</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.assignments.index') }}">Assignments</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.sessions.index') }}">Sessions</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.payouts.index') }}">Payouts</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.reports.index') }}">Reports</a></li>
                        @elseif(auth()->user()->isTeacher())
                            <li class="nav-item"><a class="nav-link" href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('teacher.sessions.index') }}">Sessions</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('teacher.sessions.create') }}">Add Session</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('teacher.students.index') }}">My Students</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('teacher.payouts.index') }}">My Payouts</a></li>
                        @elseif(auth()->user()->isStudent())
                            <li class="nav-item"><a class="nav-link" href="{{ route('student.dashboard') }}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('student.sessions.index') }}">Sessions</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('student.teachers.index') }}">My Teachers</a></li>
                        @endif
                    @endauth
                </ul>
                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                            </form>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </main>

    <footer class="bg-light py-3 mt-auto">
        <div class="container text-center text-muted small">&copy; {{ date('Y') }} Digital Education System</div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
