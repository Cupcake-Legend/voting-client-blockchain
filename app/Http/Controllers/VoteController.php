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
        //$hasVoted = auth()->user()->has_voted;
        return view('vote.index');
    }

    public function store(Request $request)
    {
        $user = auth()->user();


        // if ($user->has_voted) {
        //     return redirect()->route('dashboard')->with('success', 'You have already voted.');
        // }

        $response = Http::post('http://172.26.140.53:3000/api/vote', [
            'tpsId' => $user->tps->id,
            'userId' => $user->nik,
        ]);

        if (!$response->successful()) {
            return redirect()->route('dashboard')->with('error', 'Failed to record vote on blockchain.');
        }

        // $user->has_voted = true;
        // $user->save();

        return redirect()->route('dashboard')->with('success', 'Vote successfully cast!');
    }

    public function showVoteResultForm()
    {
        $tpsList = Tps::all();
        return view('tps.vote-results', compact('tpsList'));
    }

    public function submitVoteResults(Request $request)
    {
        $request->validate([
            'tps_id' => 'required|exists:tps,id',
            'votes_paslonA' => 'required|integer|min:0',
            'votes_paslonB' => 'required|integer|min:0',
        ]);

        $tps = Tps::findOrFail($request->tps_id);
        $totalA = (int) $request->votes_paslonA;
        $totalB = (int) $request->votes_paslonB;

        if ($totalA + $totalB > $tps->max_voters) {
            return back()->with('error', "Total votes ({$totalA} + {$totalB}) exceed max voters for {$tps->name} ({$tps->max_voters}).");
        }

        try {
            $res = Http::post('http://172.26.140.53:3000/api/vote-results', [
                'tpsId' => $tps->id,
                'paslonA' => $totalA,
                'paslonB' => $totalB,
            ]);

            if ($res->successful()) {
                return back()->with('success', "✅ Vote results submitted successfully for {$tps->name}.");
            } else {
                return back()->with('error', "❌ Blockchain rejected the submission for {$tps->name}: " . $res->body());
            }
        } catch (\Exception $e) {
            return back()->with('error', "🔥 Error sending to blockchain: " . $e->getMessage());
        }
    }
}
