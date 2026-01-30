@extends('layouts.app')

@section('title', 'Beranda Pelanggan')

@section('content')
    @if(session('success'))
        <div class="bg-green-500 text-white px-6 py-4 rounded-2xl mb-6 shadow-lg flex items-center gap-3 animate-pulse">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl p-8 text-white shadow-xl shadow-blue-200 mb-10">
        <div class="absolute top-0 right-0 -mr-10 -mt-10 w-40 h-40 rounded-full bg-white opacity-10 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -ml-10 -mb-10 w-40 h-40 rounded-full bg-white opacity-10 blur-2xl"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-bold mb-2">Halo, {{ Auth::guard('pelanggan')->user()->nama_pelanggan }}! 👋</h2>
                <p class="text-blue-100 text-sm max-w-lg leading-relaxed">Selamat datang di aplikasi Listriku. Cek tagihan listrik Anda dan lakukan pembayaran dengan mudah di sini.</p>
            </div>
            <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl border border-white/30 text-center min-w-[150px]">
                <p class="text-xs text-blue-100 uppercase tracking-wider mb-1">Nomor KWH</p>
                <p class="font-mono text-xl font-bold tracking-widest">{{ Auth::guard('pelanggan')->user()->nomor_kwh }}</p>
            </div>
        </div>
    </div>

    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-slate-800">Tagihan Bulan Ini</h3>
            <a href="{{ route('pelanggan.tagihan') }}" class="text-sm text-blue-600 font-semibold hover:underline">Lihat Semua Riwayat &rarr;</a>
        </div>
        
        @if($latestBill)
            <div class="bg-white border border-slate-100 rounded-2xl p-6 flex flex-col md:flex-row items-center justify-between shadow-sm hover:shadow-md transition-shadow relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-yellow-400"></div>
                <div class="flex items-center gap-4 mb-4 md:mb-0 w-full">
                    <div class="w-14 h-14 bg-yellow-50 rounded-full flex items-center justify-center text-yellow-600 flex-shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-slate-800">Tagihan {{ $latestBill->bulan }} {{ $latestBill->tahun }}</h4>
                        <p class="text-slate-500 text-sm">Penggunaan: <span class="font-semibold text-slate-700">{{ $latestBill->jumlah_meter }} kWh</span></p>
                    </div>
                </div>
                
                <a href="{{ route('pelanggan.bayar', $latestBill->id_tagihan) }}" class="w-full md:w-auto text-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition transform hover:-translate-y-0.5 whitespace-nowrap">
                    Bayar Sekarang
                </a>
            </div>
        @else
            <div class="bg-white border border-slate-100 rounded-2xl p-6 flex flex-col md:flex-row items-center justify-between shadow-sm">
                <div class="flex items-center gap-4 mb-4 md:mb-0">
                    <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-slate-800">Tidak Ada Tagihan Aktif</h4>
                        <p class="text-slate-500 text-sm">Terima kasih sudah membayar tagihan listrik tepat waktu.</p>
                    </div>
                </div>
                <button class="px-6 py-2 bg-slate-100 text-slate-400 font-medium rounded-xl cursor-not-allowed" disabled>Aman Terkendali</button>
            </div>
        @endif
    </div>
@endsection