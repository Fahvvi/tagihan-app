@extends('layouts.app')

@section('title', 'Transaksi & Riwayat Tagihan')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Tagihan & Pembayaran</h2>
            <p class="text-slate-500 text-sm">Kelola pembayaran listrik pelanggan.</p>
        </div>
        <a href="{{ route('penggunaan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-lg transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Catat Meter Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-100 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-800 font-semibold uppercase tracking-wider text-xs">
                <tr>
                    <th class="px-6 py-4">Pelanggan</th>
                    <th class="px-6 py-4">Periode</th>
                    <th class="px-6 py-4">Meter (Awal - Akhir)</th>
                    <th class="px-6 py-4">Total Tagihan</th>
                    <th class="px-6 py-4">Status & Jatuh Tempo</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($tagihan as $t)
                    @php
                        // Logika Hitung Tagihan
                        $tarif = $t->pelanggan->tarif->tarifperkwh;
                        $total = $t->jumlah_meter * $tarif;
                        
                        // Logika Cek Keterlambatan (Jatuh tempo tgl 10 bulan ini/bulan tagihan)
                        // Asumsi: Tagihan bulan X jatuh tempo tgl 10 bulan X
                        $bulanAngka = date('m', strtotime($t->bulan)); // Konversi nama bulan ke angka (perlu helper jika bhs indo)
                        // Cara simpel serkom: Cek tanggal hari ini > 10
                        $isLate = (date('d') > 10 && $t->status == 'Belum Bayar');
                    @endphp

                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800">{{ $t->pelanggan->nama_pelanggan }}</div>
                        <div class="text-xs text-slate-400 font-mono">{{ $t->pelanggan->nomor_kwh }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-medium text-slate-700">{{ $t->bulan }} {{ $t->tahun }}</span>
                    </td>
                    <td class="px-6 py-4">
                        {{ $t->jumlah_meter }} kWh
                        <div class="text-xs text-slate-400">({{ $t->penggunaan->meter_awal }} - {{ $t->penggunaan->meter_akhir }})</div>
                    </td>
                   <td class="px-6 py-4 text-center">
                        @if($t->status == 'Belum Bayar')
                            <form action="{{ route('tagihan.bayar', $t->id_tagihan) }}" method="POST" onsubmit="return confirm('Proses pembayaran?');">
                                @csrf
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-xs font-bold shadow-md transition">
                                    Bayar
                                </button>
                            </form>
                        @else
                            <a href="{{ route('admin.tagihan.cetak', $t->id_tagihan) }}" target="_blank" class="flex items-center justify-center gap-1 bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded-lg text-xs font-bold shadow-md transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2-4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                Cetak
                            </a>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($t->status == 'Lunas')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">LUNAS</span>
                        @else
                            <div class="flex flex-col gap-1">
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold w-fit">BELUM BAYAR</span>
                                @if($isLate)
                                    <span class="text-xs text-red-500 font-bold flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Terlambat!
                                    </span>
                                @else 
                                    <span class="text-xs text-slate-400">Jatuh Tempo Tgl 10</span>
                                @endif
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($t->status == 'Belum Bayar')
                            <form action="{{ route('tagihan.bayar', $t->id_tagihan) }}" method="POST" onsubmit="return confirm('Proses pembayaran senilai Rp {{ number_format($total + 2500) }} (termasuk admin)?');">
                                @csrf
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-xs font-bold shadow-md transition">
                                    Bayar
                                </button>
                            </form>
                        @else
                            <button disabled class="bg-slate-100 text-slate-400 px-4 py-2 rounded-lg text-xs font-bold cursor-not-allowed">
                                Selesai
                            </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-6 py-8 text-center text-slate-400">Belum ada riwayat tagihan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection