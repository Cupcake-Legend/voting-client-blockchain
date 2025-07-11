@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf @method('PUT')
        @include('users.form')
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
