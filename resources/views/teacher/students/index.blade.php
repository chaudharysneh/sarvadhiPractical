@extends('layouts.app')

@section('title', 'My Students')

@section('content')
<h2 class="mb-4">Assigned Students</h2>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr><th>Unique ID</th><th>Name</th><th>Parent Contact</th><th>Parent Email</th><th>Daily Max (hrs)</th><th>Weekly Max (hrs)</th></tr>
        </thead>
        <tbody>
            @forelse($students as $s)
                <tr>
                    <td>{{ $s->unique_id }}</td>
                    <td>{{ $s->full_name }}</td>
                    <td>{{ $s->parent_contact_number }}</td>
                    <td>{{ $s->parent_email }}</td>
                    <td>{{ $s->daily_max_hours }}</td>
                    <td>{{ $s->weekly_max_hours }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No students assigned to you yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
