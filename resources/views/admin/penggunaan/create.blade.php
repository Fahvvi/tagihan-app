@extends('layouts.app')

@section('title', 'Catat Penggunaan Listrik')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold text-slate-800 mb-6">Catat Penggunaan Listrik</h2>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
            <form action="{{ route('penggunaan.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Pelanggan</label>
                    <select name="id_pelanggan" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-blue-500 outline-none">
                        @foreach($pelanggan as $p)
                            <option value="{{ $p->id_pelanggan }}">{{ $p->nomor_kwh }} - {{ $p->nama_pelanggan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Bulan Tagihan</label>
                        <select name="bulan" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 outline-none">
                            @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                                <option value="{{ $bulan }}">{{ $bulan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tahun</label>
                        <input type="number" name="tahun" value="{{ date('Y') }}" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Meter Awal</label>
                        <input type="number" name="meter_awal" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 outline-none" placeholder="0">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Meter Akhir</label>
                        <input type="number" name="meter_akhir" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 outline-none" placeholder="100">
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition mt-4">
                    Simpan & Buat Tagihan
                </button>
            </form>
        </div>
    </div>
@endsection