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
    public function authentication(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Coba autentikasi pengguna
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Jika berhasil, redirect ke dashboard
            $user = Auth::user();

            // Simpan session untuk username dan level
            session([
                'id' => $user->id,
                'username' => $user->username,
                'level' => $user->level, // pastikan kolom 'level' ada pada tabel users
            ]);

            if($user->level == 'admin'){
                return redirect()->intended('/beranda')->with('success', 'Login berhasil!');
            }else{
                return redirect()->intended('user/beranda')->with('success', 'Login berhasil!');
            }
            
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
