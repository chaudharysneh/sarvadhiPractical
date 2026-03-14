@extends('layouts.app')

@section('title', 'Add Session')

@section('content')
<h2 class="mb-4">Add Session</h2>
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('teacher.sessions.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        <div class="col-12">
            <label class="form-label">Students <span class="text-danger">*</span></label>
            <div class="border rounded p-3">
                @forelse($students as $s)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="student_ids[]" value="{{ $s->id }}" id="s{{ $s->id }}" {{ in_array($s->id, old('student_ids', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="s{{ $s->id }}">{{ $s->full_name }} ({{ $s->unique_id }})</label>
                    </div>
                @empty
                    <p class="text-muted mb-0">No students assigned to you. Ask admin to assign students.</p>
                @endforelse
            </div>
        </div>
        <div class="col-md-6">
            <label class="form-label">Start Date <span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Start Time <span class="text-danger">*</span></label>
            <input type="time" class="form-control" name="start_time" value="{{ old('start_time') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">End Date <span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">End Time <span class="text-danger">*</span></label>
            <input type="time" class="form-control" name="end_time" value="{{ old('end_time') }}" required>
        </div>
        <div class="col-12">
            <label class="form-label">Notes (optional)</label>
            <textarea class="form-control" name="notes" rows="2">{{ old('notes') }}</textarea>
        </div>
        <div class="col-12">
            <label class="form-label">Documents (optional, docx/pdf/txt, max 5MB each)</label>
            <input type="file" class="form-control" name="documents[]" multiple accept=".doc,.docx,.pdf,.txt">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Add Session</button>
            <a href="{{ route('teacher.sessions.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>
<p class="mt-3 small text-muted">Session must not be in the future. It cannot exceed each student's daily/weekly max hours and cannot overlap with their existing sessions.</p>
@endsection
