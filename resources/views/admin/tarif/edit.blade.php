@extends('layouts.app')

@section('title', 'Edit Tarif')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('tarif.index') }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-600 hover:border-blue-500 hover:text-blue-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Edit Data Tarif</h2>
                <p class="text-slate-500 text-sm">Perbarui informasi tarif listrik.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
            <form action="{{ route('tarif.update', $tarif->id_tarif) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT') <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Golongan Daya</label>
                    <input type="text" name="daya" value="{{ $tarif->daya }}" required 
                        class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tarif per kWh (Rp)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-slate-400">Rp</span>
                        <input type="number" name="tarifperkwh" value="{{ $tarif->tarifperkwh }}" required 
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-blue-200 transition">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection