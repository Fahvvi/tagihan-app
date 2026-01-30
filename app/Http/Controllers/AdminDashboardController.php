<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // --- DATA STATISTIK KARTU ---
        $totalPelanggan = Pelanggan::count();

        // Gunakan Carbon untuk ambil bulan sekarang dalam bahasa Indonesia
        $bulanIni = Carbon::now()->translatedFormat('F'); // Hasil: "Januari"
        $tahunIni = Carbon::now()->year;

        // Debugging: Pastikan query menggunakan $bulanIni yang benar
        $tagihanBulanIni = Tagihan::with('pelanggan.tarif')
                            ->where('bulan', $bulanIni) 
                            ->where('tahun', $tahunIni)
                            ->get();
        
        $totalUangTagihan = 0;
        foreach($tagihanBulanIni as $t) {
            $tarif = $t->pelanggan->tarif->tarifperkwh;
            $totalUangTagihan += ($t->jumlah_meter * $tarif);
        }

        $belumLunas = Tagihan::where('status', 'Belum Bayar')->count();


        // --- DATA UNTUK CHART 1 (PENDAPATAN) ---
        $namaBulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $dataPendapatan = [];

        foreach($namaBulan as $bulan) {
            $total = Pembayaran::where('bulan_bayar', $bulan)
                        ->whereYear('tanggal_pembayaran', $tahunIni)
                        ->sum('total_bayar');
            
            // PERBAIKAN DI SINI: Paksa jadi integer/angka
            $dataPendapatan[] = (int) $total; 
        }


        // --- DATA UNTUK CHART 2 (STATUS) ---
        $countLunas = Tagihan::where('bulan', $bulanIni)->where('tahun', $tahunIni)->where('status', 'Lunas')->count();
        $countBelum = Tagihan::where('bulan', $bulanIni)->where('tahun', $tahunIni)->where('status', 'Belum Bayar')->count();

        return view('admin.dashboard', compact(
            'totalPelanggan', 
            'totalUangTagihan', 
            'belumLunas',
            'dataPendapatan', 
            'countLunas', 
            'countBelum'
        ));
    }
}