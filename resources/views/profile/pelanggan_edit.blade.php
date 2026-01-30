@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold text-slate-800 mb-6">Profil Saya</h2>

        @if(session('success'))
            <div class="bg-green-50 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm border border-green-100 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
            <form action="{{ route('pelanggan.profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nomor KWH</label>
                        <input type="text" value="{{ $user->nomor_kwh }}" disabled class="w-full px-4 py-3 rounded-xl bg-slate-100 border border-slate-200 text-slate-500 font-mono cursor-not-allowed">
                    </div>
                    <div class="w-1/2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Daya / Tarif</label>
                        <input type="text" value="{{ $user->tarif->daya }}" disabled class="w-full px-4 py-3 rounded-xl bg-slate-100 border border-slate-200 text-slate-500 cursor-not-allowed">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_pelanggan" value="{{ $user->nama_pelanggan }}" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat</label>
                    <textarea name="alamat" rows="2" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition">{{ $user->alamat }}</textarea>
                </div>

                <hr class="border-slate-100 my-6">

                <h3 class="font-bold text-slate-800">Keamanan</h3>
                <p class="text-sm text-slate-400 mb-4">Kosongkan jika tidak ingin mengubah password.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Password Baru</label>
                        <input type="password" name="password" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition" placeholder="Ulangi password">
                    </div>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-blue-200 transition">
                        Update Profil
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection