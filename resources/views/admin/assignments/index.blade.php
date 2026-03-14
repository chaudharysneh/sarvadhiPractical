@extends('layouts.app')

@section('title', 'Student Assignments')

@section('content')
<div class="page-header">
    <h2>Assign Students to Teachers</h2>
</div>
<div class="table-wrapper">
    <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead>
                <tr><th>Teacher</th><th>Unique ID</th><th>Assigned Students</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @foreach($teachers as $t)
                    <tr>
                        <td>{{ $t->full_name }}</td>
                        <td>{{ $t->unique_id }}</td>
                        <td>{{ $t->students->pluck('full_name')->join(', ') ?: '—' }}</td>
                        <td><a href="{{ route('admin.assignments.edit', $t) }}" class="btn btn-sm btn-primary">Edit Assignments</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
