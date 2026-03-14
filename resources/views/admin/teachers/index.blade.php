@extends('layouts.app')

@section('title', 'Teachers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Teachers</h2>
    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">Add Teacher</a>
</div>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr><th>Unique ID</th><th>Name</th><th>Email</th><th>Gender</th><th>Date of Join</th><th>Salary/Hr</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($teachers as $t)
                <tr>
                    <td>{{ $t->unique_id }}</td>
                    <td>{{ $t->full_name }}</td>
                    <td>{{ $t->email }}</td>
                    <td>{{ ucfirst($t->gender) }}</td>
                    <td>{{ $t->date_of_join->format('Y-m-d') }}</td>
                    <td>{{ number_format($t->salary_per_hour, 2) }}</td>
                    <td>
                        <a href="{{ route('admin.teachers.edit', $t) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.teachers.destroy', $t) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this teacher?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">No teachers yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $teachers->links() }}
@endsection
