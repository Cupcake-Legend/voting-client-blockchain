<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('tps')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $tpsList = Tps::all();
        return view('users.create', compact('tpsList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'nik' => 'required|string|unique:users',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|string|min:6',
            'tps_id' => 'required|exists:tps,id',
            'role' => 'required|in:voter,admin',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        $tpsList = Tps::all();
        return view('users.edit', compact('user', 'tpsList'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'nik' => 'required|string|unique:users,nik,' . $user->id,
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'tps_id' => 'nullable|exists:tps,id',
            'role' => 'required|in:voter,admin',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted.');
    }
}

