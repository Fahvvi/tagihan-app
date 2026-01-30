<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pelanggan;

class ProfileController extends Controller
{
    // 1. Tampilkan Form Profil
    public function edit()
    {
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            return view('profile.admin_edit', compact('user'));
        } 
        elseif (Auth::guard('pelanggan')->check()) {
            $user = Auth::guard('pelanggan')->user();
            return view('profile.pelanggan_edit', compact('user'));
        }
        
        return redirect('/login');
    }

    // 2. Proses Update Profil
    public function update(Request $request)
    {
        // --- LOGIKA UNTUK ADMIN ---
        if (Auth::guard('admin')->check()) {
            $id = Auth::guard('admin')->id();
            $admin = User::findOrFail($id);

            $request->validate([
                'nama_admin' => 'required|string|max:255',
                'password' => 'nullable|min:6|confirmed', // confirmed butuh input name="password_confirmation"
            ]);

            $admin->nama_admin = $request->nama_admin;
            if ($request->filled('password')) {
                $admin->password = Hash::make($request->password);
            }
            $admin->save();

            return back()->with('success', 'Profil admin berhasil diperbarui!');
        }

        // --- LOGIKA UNTUK PELANGGAN ---
        elseif (Auth::guard('pelanggan')->check()) {
            $id = Auth::guard('pelanggan')->id();
            $pelanggan = Pelanggan::findOrFail($id);

            $request->validate([
                'nama_pelanggan' => 'required|string|max:255',
                'alamat' => 'required|string',
                'password' => 'nullable|min:6|confirmed',
            ]);

            $pelanggan->nama_pelanggan = $request->nama_pelanggan;
            $pelanggan->alamat = $request->alamat;
            
            if ($request->filled('password')) {
                $pelanggan->password = Hash::make($request->password);
            }
            $pelanggan->save();

            return back()->with('success', 'Profil Anda berhasil diperbarui!');
        }

        return back();
    }
}