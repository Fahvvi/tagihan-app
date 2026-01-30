@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Dashboard Overview</h2>
            <p class="text-slate-500 text-sm mt-1">Pantau aktivitas pembayaran listrik terkini.</p>
        </div>
        
        <div class="flex gap-3">
            <a href="{{ route('tarif.index') }}" class="flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 px-5 py-2.5 rounded-xl text-sm font-medium transition transform hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                Kelola Tarif
            </a>

            <button class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-lg shadow-blue-200 transition transform hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Penggunaan
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-slate-100 hover:border-blue-100 transition duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">Aktif</span>
            </div>
            <div class="text-slate-500 text-sm font-medium">Total Pelanggan</div>
            <div class="text-3xl font-bold text-slate-800 mt-1">{{ $totalPelanggan }}</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-slate-100 hover:border-blue-100 transition duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="text-slate-500 text-sm font-medium">Tagihan Bulan Ini</div>
            <div class="text-3xl font-bold text-slate-800 mt-1">Rp {{ number_format($totalUangTagihan, 0, ',', '.') }}</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-slate-100 hover:border-blue-100 transition duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-red-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-red-600 bg-red-50 px-2 py-1 rounded-full">Action Needed</span>
            </div>
            <div class="text-slate-500 text-sm font-medium">Belum Lunas</div>
            <div class="text-3xl font-bold text-slate-800 mt-1">
                {{ $belumLunas }} <span class="text-sm font-normal text-slate-400">Orang</span>
            </div>
        </div>

        
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-slate-100 lg:col-span-2">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Grafik Pendapatan Tahun Ini</h3>
            <div class="relative h-72 w-full">
                <canvas id="incomeChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-slate-100">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Status Tagihan Bulan Ini</h3>
            <div class="relative h-64 w-full flex justify-center">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // --- DATA DARI CONTROLLER ---
            // Kita gunakan json_encode agar aman dari syntax error JS
            const incomeData = {!! json_encode($dataPendapatan) !!};
            const statusData = {!! json_encode([$countLunas, $countBelum]) !!};

            // Debugging: Cek di Console Browser (F12) jika masih error
            console.log("Data Pendapatan:", incomeData);
            console.log("Data Status:", statusData);

            // --- CHART 1: PENDAPATAN (BAR) ---
            const ctxIncome = document.getElementById('incomeChart');
            if (ctxIncome) {
                new Chart(ctxIncome.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                        datasets: [{
                            label: 'Total Pendapatan (Rp)',
                            data: incomeData, 
                            backgroundColor: '#3b82f6',
                            borderRadius: 6,
                            barThickness: 25,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let value = context.raw;
                                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                border: { dash: [4, 4] },
                                grid: { color: '#f3f4f6' },
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + (value / 1000) + 'k'; // Format ribuan
                                    }
                                }
                            },
                            x: {
                                grid: { display: false }
                            }
                        }
                    }
                });
            }

            // --- CHART 2: STATUS (DOUGHNUT) ---
            const ctxStatus = document.getElementById('statusChart');
            if (ctxStatus) {
                new Chart(ctxStatus.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Lunas', 'Belum Bayar'],
                        datasets: [{
                            data: statusData,
                            backgroundColor: ['#22c55e', '#ef4444'],
                            borderWidth: 0,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '75%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { 
                                    usePointStyle: true, 
                                    padding: 20,
                                    font: { family: "'Poppins', sans-serif" }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection