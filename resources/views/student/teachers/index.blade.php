@extends('layouts.app')

@section('title', 'My Teachers')

@section('content')
<div class="page-header">
    <h2>Assigned Teachers</h2>
</div>
<div class="table-wrapper">
    <div class="table-responsive">
        <table class="table table-bordered mb-0">
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
                    <tr><td colspan="3" class="text-center py-4 text-muted">No teachers assigned yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
