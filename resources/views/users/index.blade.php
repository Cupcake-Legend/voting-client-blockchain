@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Users</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>NIK</th>
                <th>Role</th>
                <th>TPS</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->nik }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->tps->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete user?')" class="btn btn-sm btn-danger">Del</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
