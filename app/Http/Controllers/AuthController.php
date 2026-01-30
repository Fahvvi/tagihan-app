<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Tampilkan Halaman Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 2. Proses Login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // A. Coba Login sebagai ADMIN
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            // Cek level (opsional, untuk redirect spesifik jika ada superadmin/admin bank)
            return redirect()->intended('/admin/dashboard');
        }

        // B. Coba Login sebagai PELANGGAN
        if (Auth::guard('pelanggan')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/pelanggan/dashboard');
        }

        // C. Jika Gagal Semuanya
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // 3. Proses Logout
    public function logout(Request $request)
    {
        // Cek siapa yang login, lalu logout sesuai guard
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('pelanggan')->check()) {
            Auth::guard('pelanggan')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}