@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Welcome, {{ auth()->user()->name }}</h2>
        <p><strong>NIK:</strong> {{ auth()->user()->nik }}</p>
        <p><strong>Assigned TPS:</strong> {{ auth()->user()->tps->name ?? '-' }}</p>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($hasVoted)
            <div class="alert alert-info">You have already voted.</div>
        @else
            <form action="{{ route('vote.store') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Cast Vote</button>
            </form>
        @endif
    </div>
@endsection
