<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->intended('/dashboard/admin')->with('success', 'Selamat datang, Admin!');
        } elseif ($user->role === 'petugas') {
            return redirect()->intended('/dashboard/kasir')->with('success', 'Selamat datang, petugas!');
        } else {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun Anda tidak memiliki peran yang valid.',
            ])->onlyInput('email');
        }
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
}
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
