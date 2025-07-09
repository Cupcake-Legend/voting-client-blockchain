<?php

namespace App\Http\Controllers;

use App\Models\Tps;
use Illuminate\Http\Request;

class TPSController extends Controller
{
    public function index()
    {
        $tpsList = Tps::withCount('users')->get();
        return view('tps.index', compact('tpsList'));
    }

    public function create()
    {
        return view('tps.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'max_voters' => 'required|integer|min:1',
        ]);

        Tps::create($validated);

        return redirect()->route('tps.index')->with('success', 'TPS created.');
    }

    public function edit(Tps $tps)
    {
        return view('tps.edit', compact('tps'));
    }

    public function update(Request $request, Tps $tps)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'max_voters' => 'required|integer|min:1',
        ]);

        $tps->update($validated);

        return redirect()->route('tps.index')->with('success', 'TPS updated.');
    }

    public function destroy(Tps $tps)
    {
        $tps->delete();
        return redirect()->route('tps.index')->with('success', 'TPS deleted.');
    }
}
