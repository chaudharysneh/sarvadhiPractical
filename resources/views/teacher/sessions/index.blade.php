@extends('layouts.app')

@section('title', 'My Sessions')

@section('content')
<div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-2">
    <h2>My Sessions</h2>
    <a href="{{ route('teacher.sessions.create') }}" class="btn btn-primary">Add Session</a>
</div>
<form method="GET" class="row g-3 mb-4 filter-form">
    <div class="col-auto">
        <label class="form-label">Date from</label>
        <input type="date" class="form-control" name="date_from" value="{{ request('date_from') }}">
    </div>
    <div class="col-auto">
        <label class="form-label">Date to</label>
        <input type="date" class="form-control" name="date_to" value="{{ request('date_to') }}">
    </div>
    <div class="col-auto">
        <label class="form-label">Student</label>
        <select class="form-select" name="student_id" style="width: 200px;">
            <option value="">All</option>
            @foreach($students as $s)
                <option value="{{ $s->id }}" {{ request('student_id') == $s->id ? 'selected' : '' }}>{{ $s->full_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-auto d-flex align-items-end">
        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
</form>
<div class="table-wrapper">
    <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead>
                <tr><th>Date & Time</th><th>Students</th><th>Duration</th><th>Notes</th></tr>
            </thead>
            <tbody>
                @forelse($sessions as $s)
                    <tr>
                        <td>{{ $s->start_time->format('M d, Y H:i') }} – {{ $s->end_time->format('H:i') }}</td>
                        <td>{{ $s->students->pluck('full_name')->join(', ') }}</td>
                        <td>{{ $s->duration_hours }} hrs</td>
                        <td>{{ Str::limit($s->notes, 50) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-4 text-muted">No sessions yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $sessions->links() }}
@endsection
