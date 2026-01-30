@extends('layouts.app')

@section('title', 'Riwayat Penggunaan Listrik')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Riwayat Penggunaan Meter</h2>
            <p class="text-slate-500 text-sm">Data pencatatan meteran listrik pelanggan.</p>
        </div>
        <a href="{{ route('penggunaan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-lg transition flex items-center gap-2">
            + Catat Baru
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-800 font-semibold uppercase tracking-wider text-xs">
                <tr>
                    <th class="px-6 py-4">Pelanggan</th>
                    <th class="px-6 py-4">Periode</th>
                    <th class="px-6 py-4">Meter Awal</th>
                    <th class="px-6 py-4">Meter Akhir</th>
                    <th class="px-6 py-4">Tanggal Catat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($penggunaan as $item)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800">{{ $item->pelanggan->nama_pelanggan }}</div>
                        <div class="text-xs text-slate-400">{{ $item->pelanggan->nomor_kwh }}</div>
                    </td>
                    <td class="px-6 py-4">{{ $item->bulan }} {{ $item->tahun }}</td>
                    <td class="px-6 py-4">{{ $item->meter_awal }}</td>
                    <td class="px-6 py-4 font-bold text-blue-600">{{ $item->meter_akhir }}</td>
                    <td class="px-6 py-4 text-xs text-slate-400">{{ $item->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-slate-400">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection