@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('pelanggan.index') }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-200 text-slate-600 hover:border-blue-500 hover:text-blue-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Edit Pelanggan</h2>
                <p class="text-slate-500 text-sm">Update data atau reset password pelanggan.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
            <form action="{{ route('pelanggan.update', $pelanggan->id_pelanggan) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <h3 class="text-lg font-bold text-blue-600 border-b border-slate-100 pb-2">Informasi Akun</h3>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                            <input type="text" name="username" value="{{ $pelanggan->username }}" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Password Baru <span class="text-xs font-normal text-slate-400">(Biarkan kosong jika tetap)</span></label>
                            <input type="password" name="password" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition" placeholder="••••••••">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nomor KWH</label>
                            <input type="number" name="nomor_kwh" value="{{ $pelanggan->nomor_kwh }}" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition font-mono">
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-lg font-bold text-blue-600 border-b border-slate-100 pb-2">Data Instalasi</h3>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Golongan Tarif / Daya</label>
                            <select name="id_tarif" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition">
                                @foreach($tarifs as $tarif)
                                    <option value="{{ $tarif->id_tarif }}" {{ $pelanggan->id_tarif == $tarif->id_tarif ? 'selected' : '' }}>
                                        {{ $tarif->daya }} - Rp {{ number_format($tarif->tarifperkwh) }}/kWh
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Lengkap</label>
                            <textarea name="alamat" rows="3" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition">{{ $pelanggan->alamat }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-50 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-200 transition transform hover:-translate-y-0.5">
                        Update Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection