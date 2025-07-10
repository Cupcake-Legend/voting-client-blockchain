@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Submit Vote Results to Blockchain</h2>

    @if(session('success'))
        <div class="alert alert-success">{!! session('success') !!}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{!! session('error') !!}</div>
    @endif

    <form method="POST" action="{{ route('vote-results.submit') }}">
        @csrf

        <div class="form-group mb-3">
            <label for="tps_id">Select TPS:</label>
            <select class="form-control" id="tps_id" name="tps_id" required>
                <option value="" disabled selected>-- Choose TPS --</option>
                @foreach($tpsList as $tps)
                    <option value="{{ $tps->id }}">
                        {{ $tps->name }} (Max Voters: {{ $tps->max_voters }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-2">
            <label>Votes for Paslon A:</label>
            <input type="number" class="form-control" name="votes_paslonA" value="0" min="0" required>
        </div>
        <div class="form-group mb-4">
            <label>Votes for Paslon B:</label>
            <input type="number" class="form-control" name="votes_paslonB" value="0" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit to Blockchain</button>
    </form>
</div>
@endsection
