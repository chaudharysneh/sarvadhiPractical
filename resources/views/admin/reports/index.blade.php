@extends('layouts.app')

@section('title', 'Send Monthly Report')

@section('content')
<h2 class="mb-4">Send Monthly Session Report to Parent</h2>
<form method="POST" action="{{ route('admin.reports.send') }}">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Student</label>
            <select class="form-select @error('student_id') is-invalid @enderror" name="student_id" required>
                <option value="">Select student</option>
                @foreach($students as $s)
                    <option value="{{ $s->id }}" {{ old('student_id') == $s->id ? 'selected' : '' }}>{{ $s->full_name }} – {{ $s->parent_email }}</option>
                @endforeach
            </select>
            @error('student_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Month</label>
            <input type="month" class="form-control @error('month') is-invalid @enderror" name="month" value="{{ old('month', date('Y-m')) }}" required>
            @error('month')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Send Report Email</button>
        </div>
    </div>
</form>
<p class="mt-3 text-muted small">Report will be sent to the parent email of the selected student using your configured SMTP.</p>
@endsection
