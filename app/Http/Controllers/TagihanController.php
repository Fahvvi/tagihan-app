<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TagihanController extends Controller
{
    public function index()
    {
        // Ambil semua tagihan, urutkan yang belum bayar di atas
        $tagihan = Tagihan::with(['pelanggan', 'pelanggan.tarif'])
                    ->orderByRaw("FIELD(status, 'Belum Bayar', 'Lunas')")
                    ->latest()
                    ->get();
                    
        return view('admin.tagihan.index', compact('tagihan'));
    }

    // Fungsi Proses Pembayaran
    public function bayar($id)
    {
        $tagihan = Tagihan::with('pelanggan.tarif')->findOrFail($id);

        // Hitung Biaya
        $biaya_admin = 2500; // Biaya admin statis (bisa diubah)
        $tarif_per_kwh = $tagihan->pelanggan->tarif->tarifperkwh;
        $total_tagihan = ($tagihan->jumlah_meter * $tarif_per_kwh);
        $total_bayar = $total_tagihan + $biaya_admin;

        // Simpan ke Tabel Pembayaran
        Pembayaran::create([
            'id_tagihan' => $tagihan->id_tagihan,
            'id_pelanggan' => $tagihan->id_pelanggan,
            'tanggal_pembayaran' => Carbon::now(),
            'bulan_bayar' => Carbon::now()->translatedFormat('F'), // Pakai translatedFormat agar jadi Indo
            'biaya_admin' => $biaya_admin,
            'total_bayar' => $total_bayar,
            'id_user' => Auth::guard('admin')->user()->id_user, // Admin yang memproses
        ]);

        // Update Status Tagihan
        $tagihan->update(['status' => 'Lunas']);

        return redirect()->back()->with('success', 'Pembayaran berhasil diproses!');
    }

    public function cetak($id)
    {
        // Pastikan load relasi pembayaran agar tidak error
        $tagihan = Tagihan::with(['pelanggan.tarif', 'pembayaran', 'penggunaan'])->findOrFail($id);
        
        return view('struk.cetak', compact('tagihan'));
    }
}