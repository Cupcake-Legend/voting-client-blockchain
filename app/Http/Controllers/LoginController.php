<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nik' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['nik' => $credentials['nik'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            if (auth()->user()->role === 'admin') {
                return redirect()->route('users.index');
            } else {
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'nik' => 'NIK or password is incorrect.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
