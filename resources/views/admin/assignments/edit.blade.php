@extends('layouts.app')

@section('title', 'Assign Students')

@section('content')
<h2 class="mb-4">Assign Students to {{ $teacher->full_name }}</h2>
<form method="POST" action="{{ route('admin.assignments.update', $teacher) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Select students assigned to this teacher</label>
        <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
            @foreach($students as $s)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="student_ids[]" value="{{ $s->id }}" id="s{{ $s->id }}" {{ in_array($s->id, $assignedIds) ? 'checked' : '' }}>
                    <label class="form-check-label" for="s{{ $s->id }}">{{ $s->full_name }} ({{ $s->unique_id }})</label>
                </div>
            @endforeach
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Save Assignments</button>
    <a href="{{ route('admin.assignments.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
