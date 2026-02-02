@extends('layouts.app')

@section('title', 'Riwayat Tagihan')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Tagihan & Riwayat</h2>
        <p class="text-slate-500 text-sm">Daftar semua tagihan listrik Anda.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-800 font-semibold uppercase tracking-wider text-xs">
                <tr>
                    <th class="px-6 py-4">Bulan / Tahun</th>
                    <th class="px-6 py-4">Penggunaan</th>
                    <th class="px-6 py-4">Total Tagihan</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($tagihan as $t)
                    @php
                        $tarif = $t->pelanggan->tarif->tarifperkwh;
                        $total = $t->jumlah_meter * $tarif;
                    @endphp
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $t->bulan }} {{ $t->tahun }}</td>
                    <td class="px-6 py-4">{{ $t->jumlah_meter }} kWh</td>
                    <td class="px-6 py-4">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        @if($t->status == 'Lunas')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">LUNAS</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">BELUM BAYAR</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($t->status == 'Belum Bayar')
                            <a href="{{ route('pelanggan.bayar', $t->id_tagihan) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-xs font-bold shadow-md transition">
                                Bayar
                            </a>
                        @else
                            <a href="{{ route('pelanggan.tagihan.cetak', $t->id_tagihan) }}" target="_blank" class="flex items-center justify-center gap-1 bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded-lg text-xs font-bold shadow-md transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2-4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                Cetak Struk
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-slate-400">Belum ada riwayat tagihan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection