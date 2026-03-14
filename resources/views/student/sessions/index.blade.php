@extends('layouts.app')

@section('title', 'My Sessions')

@section('content')
<h2 class="mb-4">My Sessions</h2>
<form method="GET" class="row g-3 mb-4">
    <div class="col-auto">
        <label class="form-label">Date from</label>
        <input type="date" class="form-control" name="date_from" value="{{ request('date_from') }}">
    </div>
    <div class="col-auto">
        <label class="form-label">Date to</label>
        <input type="date" class="form-control" name="date_to" value="{{ request('date_to') }}">
    </div>
    <div class="col-auto">
        <label class="form-label">Teacher</label>
        <select class="form-select" name="teacher_id" style="width: 200px;">
            <option value="">All</option>
            @foreach($teachers as $t)
                <option value="{{ $t->id }}" {{ request('teacher_id') == $t->id ? 'selected' : '' }}>{{ $t->full_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-auto d-flex align-items-end">
        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
</form>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr><th>Date & Time</th><th>Teacher</th><th>Duration</th><th>Notes</th></tr>
        </thead>
        <tbody>
            @forelse($sessions as $s)
                <tr>
                    <td>{{ $s->start_time->format('M d, Y H:i') }} – {{ $s->end_time->format('H:i') }}</td>
                    <td>{{ $s->teacher->full_name }}</td>
                    <td>{{ $s->duration_hours }} hrs</td>
                    <td>{{ Str::limit($s->notes, 40) }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">No sessions yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $sessions->links() }}
@endsection
