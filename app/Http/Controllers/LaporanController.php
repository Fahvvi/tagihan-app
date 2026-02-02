<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Default: Bulan & Tahun saat ini jika tidak ada filter
        $bulan = $request->input('bulan', date('m')); 
        $tahun = $request->input('tahun', date('Y'));

        // Query Data dengan Filter
        $pembayaran = Pembayaran::with('pelanggan')
            ->whereMonth('tanggal_pembayaran', $bulan)
            ->whereYear('tanggal_pembayaran', $tahun)
            ->latest()
            ->get();

        return view('admin.laporan.index', compact('pembayaran', 'bulan', 'tahun'));
    }

    public function cetak(Request $request)
    {
        // Ambil data yang sama persis dengan index untuk dicetak
        $bulan = $request->input('bulan'); 
        $tahun = $request->input('tahun');

        $pembayaran = Pembayaran::with('pelanggan')
            ->whereMonth('tanggal_pembayaran', $bulan)
            ->whereYear('tanggal_pembayaran', $tahun)
            ->get();

        return view('admin.laporan.cetak', compact('pembayaran', 'bulan', 'tahun'));
    }
}