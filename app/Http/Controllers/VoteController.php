<?php

namespace App\Http\Controllers;

use App\Models\Tps;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VoteController extends Controller
{
    public function index()
    {
        $hasVoted = auth()->user()->has_voted;
        return view('vote.index', compact('hasVoted'));
    }

    public function store(Request $request)
    {
        $user = User::find(auth()->user()->id);

        if ($user->has_voted) {
            return redirect()->route('dashboard')->with('success', 'You have already voted.');
        }

        $response = Http::post('http://localhost:3000/api/vote', [
            'tpsId' => $user->tps->id,
            'userId' => $user->nik,
        ]);

        if (!$response->successful()) {
            return redirect()->route('dashboard')->with('error', 'Failed to record vote on blockchain.');
        }

        $user->has_voted = true;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Vote successfully cast!');
    }

    public function updateVoteResults($tpsId)
    {
        $tps = Tps::findOrFail($tpsId);

        // These totals can be based on whatever local storage you use
        $totalVotesA = 50; // Replace with actual count
        $totalVotesB = 30;

        try {
            $response = Http::post('http://localhost:3000/api/vote-results', [
                'tpsId' => $tps->id,
                'paslonA' => $totalVotesA,
                'paslonB' => $totalVotesB,
            ]);

            if ($response->successful()) {
                return back()->with('success', 'Vote results updated on blockchain.');
            } else {
                return back()->with('error', 'Failed to update blockchain.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
