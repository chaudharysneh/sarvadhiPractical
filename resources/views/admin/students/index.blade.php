@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Students</h2>
    <a href="{{ route('admin.students.create') }}" class="btn btn-primary">Add Student</a>
</div>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr><th>Unique ID</th><th>Name</th><th>Parent Contact</th><th>Parent Email</th><th>DOB</th><th>Date of Join</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($students as $s)
                <tr>
                    <td>{{ $s->unique_id }}</td>
                    <td>{{ $s->full_name }}</td>
                    <td>{{ $s->parent_contact_number }}</td>
                    <td>{{ $s->parent_email }}</td>
                    <td>{{ $s->dob->format('Y-m-d') }}</td>
                    <td>{{ $s->date_of_join->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('admin.students.edit', $s) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.students.destroy', $s) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this student?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">No students yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $students->links() }}
@endsection
