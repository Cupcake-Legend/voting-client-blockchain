@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Login</h2>

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <div class="mb-3">
            <label for="nik">NIK</label>
            <input id="nik" type="text" class="form-control" name="nik" value="{{ old('nik') }}" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection
