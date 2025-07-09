@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($tps) ? 'Edit' : 'Create' }} TPS</h2>
    <form action="{{ isset($tps) ? route('tps.update', $tps) : route('tps.store') }}" method="POST">
        @csrf
        @if(isset($tps)) @method('PUT') @endif

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $tps->name ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $tps->location ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label>Max Voters</label>
            <input type="number" name="max_voters" class="form-control" value="{{ old('max_voters', $tps->max_voters ?? '') }}" required>
        </div>

        <button class="btn btn-success">{{ isset($tps) ? 'Update' : 'Save' }}</button>
    </form>
</div>
@endsection
