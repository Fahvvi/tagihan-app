<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    // 1. Tampilkan Semua Data
    public function index()
    {
        $tarifs = Tarif::all(); // Ambil semua data tarif
        return view('admin.tarif.index', compact('tarifs'));
    }

    // 2. Tampilkan Form Tambah
    public function create()
    {
        return view('admin.tarif.create');
    }

    // 3. Simpan Data Baru
    public function store(Request $request)
    {
        $request->validate([
            'daya' => 'required|string|max:20',
            'tarifperkwh' => 'required|numeric|min:0',
        ]);

        Tarif::create($request->all());

        return redirect()->route('tarif.index')->with('success', 'Data tarif berhasil ditambahkan!');
    }

    // 4. Tampilkan Form Edit
    public function edit($id)
    {
        $tarif = Tarif::findOrFail($id);
        return view('admin.tarif.edit', compact('tarif'));
    }

    // 5. Update Data
    public function update(Request $request, $id)
    {
        $request->validate([
            'daya' => 'required|string|max:20',
            'tarifperkwh' => 'required|numeric|min:0',
        ]);

        $tarif = Tarif::findOrFail($id);
        $tarif->update($request->all());

        return redirect()->route('tarif.index')->with('success', 'Data tarif berhasil diperbarui!');
    }

    // 6. Hapus Data
    public function destroy($id)
    {
        $tarif = Tarif::findOrFail($id);
        $tarif->delete();

        return redirect()->route('tarif.index')->with('success', 'Data tarif berhasil dihapus!');
    }
}