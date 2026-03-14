@extends('layouts.app')

@section('title', 'Send Monthly Report')

@section('content')
<div class="page-header">
    <h2>Send Monthly Session Report to Parent</h2>
</div>
<div class="card app-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.reports.send') }}">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">Student <span class="text-danger">*</span></label>
                    <select class="form-select @error('student_id') is-invalid @enderror" name="student_id">
                        <option value="">Select student</option>
                        @foreach($students as $s)
                            <option value="{{ $s->id }}" {{ old('student_id') == $s->id ? 'selected' : '' }}>{{ $s->full_name }} – {{ $s->parent_email }}</option>
                        @endforeach
                    </select>
                    @error('student_id')<span class="text-danger d-block">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Month <span class="text-danger">*</span></label>
                    <input type="month" class="form-control @error('month') is-invalid @enderror" name="month" value="{{ old('month', date('Y-m')) }}">
                    @error('month')<span class="text-danger d-block">{{ $message }}</span>@enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Send Report Email</button>
                </div>
            </div>
        </form>
        <p class="mt-4 mb-0 text-muted small">Report will be sent to the parent email of the selected student using your configured SMTP.</p>
    </div>
</div>
@endsection
