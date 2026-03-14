@extends('layouts.app')

@section('title', 'Payouts')

@section('content')
<div class="page-header">
    <h2>Teacher Payouts</h2>
</div>
<form method="GET" class="row g-3 mb-4 filter-form">
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
<div class="table-wrapper">
    <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead>
                <tr><th>Teacher</th><th>Sessions</th><th>Total Hours</th><th>Rate/Hr</th><th>Amount</th></tr>
            </thead>
            <tbody>
                @foreach($teachers as $row)
                    <tr>
                        <td>{{ $row->teacher->full_name }} ({{ $row->teacher->unique_id }})</td>
                        <td>{{ $row->sessions_count }}</td>
                        <td>{{ $row->total_hours }}</td>
                        <td>{{ number_format($row->teacher->salary_per_hour, 2) }}</td>
                        <td>{{ number_format($row->amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
