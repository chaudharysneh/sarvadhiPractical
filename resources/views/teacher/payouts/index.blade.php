@extends('layouts.app')

@section('title', 'My Payouts')

@section('content')
<h2 class="mb-4">My Payouts</h2>
<form method="GET" class="row g-3 mb-4">
    <div class="col-auto">
        <label class="form-label">Date from</label>
        <input type="date" class="form-control" name="date_from" value="{{ $dateFrom->format('Y-m-d') }}">
    </div>
    <div class="col-auto">
        <label class="form-label">Date to</label>
        <input type="date" class="form-control" name="date_to" value="{{ $dateTo->format('Y-m-d') }}">
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
<div class="card mb-4">
    <div class="card-body">
        <p class="mb-0"><strong>Total hours (filtered):</strong> {{ number_format($totalHours, 2) }} &nbsp;|&nbsp; <strong>Rate:</strong> {{ number_format($teacher->salary_per_hour, 2) }}/hr &nbsp;|&nbsp; <strong>Amount:</strong> {{ number_format($amount, 2) }}</p>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr><th>Date & Time</th><th>Students</th><th>Duration</th></tr>
        </thead>
        <tbody>
            @foreach($sessions as $s)
                <tr>
                    <td>{{ $s->start_time->format('M d, Y H:i') }} – {{ $s->end_time->format('H:i') }}</td>
                    <td>{{ $s->students->pluck('full_name')->join(', ') }}</td>
                    <td>{{ round($s->start_time->diffInMinutes($s->end_time) / 60, 2) }} hrs</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
