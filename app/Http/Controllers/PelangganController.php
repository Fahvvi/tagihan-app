<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PelangganController extends Controller
{
    public function index()
    {
        // Mulai Query
        $query = Pelanggan::with('tarif')->latest();

        // Jika ada pencarian
        if (request('search')) {
            $query->where(function($q) {
                $q->where('nama_pelanggan', 'like', '%' . request('search') . '%')
                  ->orWhere('nomor_kwh', 'like', '%' . request('search') . '%')
                  ->orWhere('username', 'like', '%' . request('search') . '%');
            });
        }

        // Gunakan paginate(10) bukan get()
        $pelanggan = $query->paginate(10)->withQueryString();

        return view('admin.pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        // Kita butuh data tarif untuk dropdown pilihan daya
        $tarifs = Tarif::all();
        return view('admin.pelanggan.create', compact('tarifs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:pelanggan,username',
            'password' => 'required|string|min:6',
            'nomor_kwh' => 'required|string|unique:pelanggan,nomor_kwh',
            'nama_pelanggan' => 'required|string',
            'alamat' => 'required|string',
            'id_tarif' => 'required|exists:tarif,id_tarif',
        ]);

        Pelanggan::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Wajib di-hash!
            'nomor_kwh' => $request->nomor_kwh,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'id_tarif' => $request->id_tarif,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $tarifs = Tarif::all();
        return view('admin.pelanggan.edit', compact('pelanggan', 'tarifs'));
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $request->validate([
            // Validasi unik kecuali untuk data diri sendiri (ignore)
            'username' => ['required', Rule::unique('pelanggan', 'username')->ignore($pelanggan->id_pelanggan, 'id_pelanggan')],
            'nomor_kwh' => ['required', Rule::unique('pelanggan', 'nomor_kwh')->ignore($pelanggan->id_pelanggan, 'id_pelanggan')],
            'nama_pelanggan' => 'required|string',
            'alamat' => 'required|string',
            'id_tarif' => 'required|exists:tarif,id_tarif',
            // Password boleh kosong jika tidak ingin diganti
            'password' => 'nullable|string|min:6', 
        ]);

        $data = [
            'username' => $request->username,
            'nomor_kwh' => $request->nomor_kwh,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'id_tarif' => $request->id_tarif,
        ];

        // Hanya update password jika input tidak kosong
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pelanggan->update($data);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}