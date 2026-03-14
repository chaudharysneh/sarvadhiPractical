@extends('layouts.app')

@section('title', 'Assign Students')

@section('content')
<div class="page-header">
    <h2>Assign Students to {{ $teacher->full_name }}</h2>
</div>
<div class="card app-card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.assignments.update', $teacher) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="form-label">Select students assigned to this teacher</label>
                <div class="border rounded p-4" style="max-height: 300px; overflow-y: auto; background: var(--color-background-alt); border-radius: var(--radius-md); border-color: var(--color-border) !important;">
                    @foreach($students as $s)
                        <div class="form-check py-1">
                            <input class="form-check-input" type="checkbox" name="student_ids[]" value="{{ $s->id }}" id="s{{ $s->id }}" {{ in_array($s->id, $assignedIds) ? 'checked' : '' }}>
                            <label class="form-check-label" for="s{{ $s->id }}">{{ $s->full_name }} ({{ $s->unique_id }})</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Assignments</button>
                <a href="{{ route('admin.assignments.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
