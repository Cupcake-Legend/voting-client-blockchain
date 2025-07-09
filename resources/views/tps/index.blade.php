@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All TPS</h2>
    <a href="{{ route('tps.create') }}" class="btn btn-primary mb-3">Add TPS</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Max Voters</th>
                <th>Registered Voters</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tpsList as $tps)
                <tr>
                    <td>{{ $tps->name }}</td>
                    <td>{{ $tps->location }}</td>
                    <td>{{ $tps->max_voters }}</td>
                    <td>{{ $tps->users_count }}</td>
                    <td>
                        <a href="{{ route('tps.edit', $tps) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('tps.destroy', $tps) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete TPS?')" class="btn btn-sm btn-danger">Del</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
