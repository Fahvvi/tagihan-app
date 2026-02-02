@extends('layouts.app')

@section('title', 'Laporan Pembayaran')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Laporan Pendapatan</h2>
        <p class="text-slate-500 text-sm">Rekapitulasi transaksi pembayaran listrik.</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 mb-6">
        <form action="{{ route('admin.laporan.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
            
            <div class="w-full md:w-1/4">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Bulan</label>
                <select name="bulan" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 focus:outline-blue-500">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-1/4">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Tahun</label>
                <select name="tahun" class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 focus:outline-blue-500">
                    @for($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-bold transition shadow-lg shadow-blue-200">
                    Filter Data
                </button>
                
                <a href="{{ route('admin.laporan.cetak', ['bulan' => $bulan, 'tahun' => $tahun]) }}" target="_blank" class="bg-slate-800 hover:bg-slate-900 text-white px-6 py-2.5 rounded-xl font-bold transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2-4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak PDF
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-800 font-semibold uppercase tracking-wider text-xs">
                <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Tanggal Bayar</th>
                    <th class="px-6 py-4">Pelanggan</th>
                    <th class="px-6 py-4 text-right">Biaya Admin</th>
                    <th class="px-6 py-4 text-right">Total Bayar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @php $grandTotal = 0; @endphp
                @forelse($pembayaran as $index => $item)
                @php $grandTotal += $item->total_bayar; @endphp
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 font-medium text-slate-800">
                        {{ $item->pelanggan->nama_pelanggan }}
                        <div class="text-xs text-slate-400 font-mono">{{ $item->pelanggan->nomor_kwh }}</div>
                    </td>
                    <td class="px-6 py-4 text-right">Rp {{ number_format($item->biaya_admin, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-right font-bold text-blue-600">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-slate-400">Tidak ada data transaksi pada periode ini.</td></tr>
                @endforelse
            </tbody>
            <tfoot class="bg-slate-50 border-t border-slate-200">
                <tr>
                    <td colspan="4" class="px-6 py-4 text-right font-bold text-slate-800 uppercase text-xs tracking-wider">Total Pendapatan</td>
                    <td class="px-6 py-4 text-right font-bold text-xl text-slate-800">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection