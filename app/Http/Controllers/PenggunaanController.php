<?php

namespace App\Http\Controllers;

use App\Models\Penggunaan;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class PenggunaanController extends Controller
{
    public function index()
    {
        $penggunaan = Penggunaan::with('pelanggan')->latest()->get();
        return view('admin.penggunaan.index', compact('penggunaan'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        return view('admin.penggunaan.create', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'bulan' => 'required',
            'tahun' => 'required',
            'meter_awal' => 'required|numeric',
            'meter_akhir' => 'required|numeric|gt:meter_awal', // Akhir harus lebih besar dari Awal
        ]);

        // 1. Simpan Data Penggunaan
        $penggunaan = Penggunaan::create($request->all());

        // 2. Otomatis Generate Tagihan
        $jumlah_meter = $request->meter_akhir - $request->meter_awal;
        
        Tagihan::create([
            'id_penggunaan' => $penggunaan->id_penggunaan,
            'id_pelanggan' => $request->id_pelanggan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'jumlah_meter' => $jumlah_meter,
            'status' => 'Belum Bayar'
        ]);

        return redirect()->route('tagihan.index')->with('success', 'Penggunaan dicatat & Tagihan berhasil dibuat otomatis!');
    }
}