@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create User</h2>
    <form action="{{ route('users.store') }}" method="POST">
        @include('users.form')
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
