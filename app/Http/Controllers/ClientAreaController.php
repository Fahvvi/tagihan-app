<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ClientAreaController extends Controller
{
    // 1. Dashboard Pelanggan (Data Real)
    public function dashboard()
    {
        $id_pelanggan = Auth::guard('pelanggan')->id();
        
        // Ambil tagihan yang belum lunas
        $tagihanBelumBayar = Tagihan::where('id_pelanggan', $id_pelanggan)
                                    ->where('status', 'Belum Bayar')
                                    ->count();
        
        // Ambil total riwayat pembayaran
        $totalTransaksi = Pembayaran::where('id_pelanggan', $id_pelanggan)->count();

        // Tagihan terbaru untuk ditampilkan di widget
        $latestBill = Tagihan::where('id_pelanggan', $id_pelanggan)
                             ->where('status', 'Belum Bayar')
                             ->latest()
                             ->first();

        return view('pelanggan.dashboard', compact('tagihanBelumBayar', 'totalTransaksi', 'latestBill'));
    }

    // 2. Daftar Tagihan Saya
    public function tagihan()
    {
        $id_pelanggan = Auth::guard('pelanggan')->id();
        $tagihan = Tagihan::where('id_pelanggan', $id_pelanggan)
                          ->orderByRaw("FIELD(status, 'Belum Bayar', 'Lunas')")
                          ->latest()
                          ->get();

        return view('pelanggan.tagihan.index', compact('tagihan'));
    }

    // 3. Halaman Konfirmasi Pembayaran (Mock Payment Gateway)
    public function showPayment($id)
    {
        $tagihan = Tagihan::with('pelanggan.tarif')->findOrFail($id);
        
        // Pastikan tagihan ini milik pelanggan yang sedang login (Security Check)
        if ($tagihan->id_pelanggan != Auth::guard('pelanggan')->id()) {
            abort(403);
        }

        // Hitung Total
        $biaya_admin = 2500;
        $total_tagihan = ($tagihan->jumlah_meter * $tagihan->pelanggan->tarif->tarifperkwh);
        $total_bayar = $total_tagihan + $biaya_admin;

        return view('pelanggan.tagihan.bayar', compact('tagihan', 'biaya_admin', 'total_bayar'));
    }

    // 4. Proses Pembayaran (Action)
    public function processPayment($id)
    {
        $tagihan = Tagihan::with('pelanggan.tarif')->findOrFail($id);

        // Security Check
        if ($tagihan->id_pelanggan != Auth::guard('pelanggan')->id()) {
            abort(403);
        }

        // Hitung Ulang (Backend Validation)
        $biaya_admin = 2500;
        $total_tagihan = ($tagihan->jumlah_meter * $tagihan->pelanggan->tarif->tarifperkwh);
        $total_bayar = $total_tagihan + $biaya_admin;

        // Cari ID Admin Utama untuk mengisi kolom id_user (anggap System Auto)
        $adminSystem = User::first(); // Mengambil admin pertama sebagai 'sistem'

        Pembayaran::create([
            'id_tagihan' => $tagihan->id_tagihan,
            'id_pelanggan' => $tagihan->id_pelanggan,
            'tanggal_pembayaran' => Carbon::now(),
            'bulan_bayar' => Carbon::now()->translatedFormat('F'),
            'biaya_admin' => $biaya_admin,
            'total_bayar' => $total_bayar,
            'id_user' => $adminSystem ? $adminSystem->id_user : 1, 
        ]);

        $tagihan->update(['status' => 'Lunas']);

        return redirect()->route('pelanggan.dashboard')->with('success', 'Pembayaran Berhasil! Terima kasih.');
    }
}