@extends('layouts.app')

@section('title', 'My Teachers')

@section('content')
<h2 class="mb-4">Assigned Teachers</h2>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr><th>Unique ID</th><th>Name</th><th>Email</th></tr>
        </thead>
        <tbody>
            @forelse($teachers as $t)
                <tr>
                    <td>{{ $t->unique_id }}</td>
                    <td>{{ $t->full_name }}</td>
                    <td>{{ $t->email }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">No teachers assigned yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
