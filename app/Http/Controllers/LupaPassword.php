<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LupaPassword extends Controller
{
    // Menampilkan form lupa password
    public function showForgotForm()
    {
        return view('lupa-password.forgot-password');
    }

    // Menampilkan form reset password dengan token
    public function index($token)
    {
        return view('lupa-password.reset-password', ['token' => $token]);
    }

    // Mengirim email reset password
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    // Menyimpan password baru
    public function reset(Request $request)
    {
        // Validasi input
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Cek apakah token dan email cocok di tabel password_resets
        $resetData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetData) {
            return back()->withErrors(['error' => 'Token reset tidak valid atau sudah kadaluarsa.']);
        }

        // Ambil user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['error' => 'Email tidak ditemukan dalam sistem.']);
        }

        // Update password baru
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Hapus token setelah digunakan
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Login user setelah reset password berhasil
        Auth::login($user);

        // Redirect ke dashboard atau halaman login
        return redirect()->to('/login')->with('success', 'Password berhasil diperbarui.');
    }
}
