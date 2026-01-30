@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Daftar Pelanggan</h2>
            <p class="text-slate-500 text-sm">Kelola akun dan data meteran pelanggan.</p>
        </div>
        <a href="{{ route('pelanggan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-lg shadow-blue-200 transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            Tambah Pelanggan
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-100 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-800 font-semibold uppercase tracking-wider text-xs">
                <tr>
                    <th class="px-6 py-4">Nama & Username</th>
                    <th class="px-6 py-4">Nomor KWH</th>
                    <th class="px-6 py-4">Alamat</th>
                    <th class="px-6 py-4">Tarif / Daya</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($pelanggan as $item)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800">{{ $item->nama_pelanggan }}</div>
                        <div class="text-xs text-slate-400">@ {{ $item->username }}</div>
                    </td>
                    <td class="px-6 py-4 font-mono text-blue-600 bg-blue-50/50 rounded inline-block mt-2 px-2 py-1 mx-6">{{ $item->nomor_kwh }}</td>
                    <td class="px-6 py-4 truncate max-w-xs">{{ $item->alamat }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-indigo-50 text-indigo-700 px-2 py-1 rounded text-xs font-bold">
                            {{ $item->tarif->daya }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex justify-center gap-2">
                        <a href="{{ route('pelanggan.edit', $item->id_pelanggan) }}" class="p-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>
                        <form action="{{ route('pelanggan.destroy', $item->id_pelanggan) }}" method="POST" onsubmit="return confirm('Hapus pelanggan ini beserta semua data tagihannya?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-slate-400">Belum ada data pelanggan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection