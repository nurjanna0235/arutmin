<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        return view('login.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|username',
            'password' => 'required|min:6',
        ]);

        // Coba autentikasi pengguna
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Jika berhasil, redirect ke dashboard
            return redirect()->intended('/dashboard')->with('success', 'Login berhasil!');
        }

        // Jika gagal, kembali ke halaman login dengan error
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput($request->only('username', 'remember'));
    }

    // Proses logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}
