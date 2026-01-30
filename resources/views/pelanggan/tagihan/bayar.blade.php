@extends('layouts.app')

@section('title', 'Pembayaran Listrik')

@section('content')
    <div class="max-w-xl mx-auto mt-8">
        <a href="{{ route('pelanggan.dashboard') }}" class="flex items-center gap-2 text-slate-500 text-sm mb-6 hover:text-blue-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Dashboard
        </a>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
            <div class="bg-slate-50 p-8 border-b border-slate-100 text-center">
                <p class="text-slate-500 text-sm uppercase tracking-widest font-semibold mb-2">Total Tagihan</p>
                <h1 class="text-4xl font-bold text-slate-800">Rp {{ number_format($total_bayar, 0, ',', '.') }}</h1>
                <div class="mt-4 inline-flex items-center gap-2 bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                    <span>#INV-{{ $tagihan->bulan }}-{{ $tagihan->id_tagihan }}</span>
                </div>
            </div>

            <div class="p-8">
                <h3 class="font-bold text-slate-800 mb-4">Rincian Pembayaran</h3>
                <div class="space-y-3 mb-8">
                    <div class="flex justify-between text-sm text-slate-600">
                        <span>Tagihan Listrik ({{ $tagihan->jumlah_meter }} kWh)</span>
                        <span class="font-medium">Rp {{ number_format($total_bayar - $biaya_admin, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-slate-600">
                        <span>Biaya Admin / Layanan</span>
                        <span class="font-medium">Rp {{ number_format($biaya_admin, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-dashed border-slate-200 pt-3 flex justify-between font-bold text-slate-800">
                        <span>Total Bayar</span>
                        <span>Rp {{ number_format($total_bayar, 0, ',', '.') }}</span>
                    </div>
                </div>

                <h3 class="font-bold text-slate-800 mb-4">Pilih Metode Pembayaran</h3>
                <div class="grid grid-cols-2 gap-3 mb-8">
                    <label class="cursor-pointer border border-blue-500 bg-blue-50 rounded-xl p-4 flex flex-col items-center justify-center gap-2 transition hover:shadow-md">
                        <input type="radio" name="payment_method" checked class="hidden">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        <span class="text-xs font-bold text-blue-700">Virtual Account</span>
                    </label>
                    <label class="cursor-pointer border border-slate-200 rounded-xl p-4 flex flex-col items-center justify-center gap-2 opacity-50 grayscale">
                        <input type="radio" name="payment_method" disabled class="hidden">
                        <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="text-xs font-bold text-slate-700">E-Wallet (Off)</span>
                    </label>
                </div>

                <form action="{{ route('pelanggan.process', $tagihan->id_tagihan) }}" method="POST">
                    @csrf
                    <button type="submit" onclick="return confirm('Simulasi: Lanjutkan pembayaran?')" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Konfirmasi Pembayaran
                    </button>
                    <p class="text-center text-xs text-slate-400 mt-4">
                        <span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded">Mode Simulasi</span> 
                        Pembayaran akan langsung diverifikasi otomatis.
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection