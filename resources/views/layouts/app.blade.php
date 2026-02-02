<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Listriku App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        /* Custom Scrollbar agar rapi */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-white to-blue-50 min-h-screen text-slate-800" x-data="{ sidebarOpen: false }">

    <div class="md:hidden flex items-center justify-between bg-white/80 backdrop-blur-md shadow-sm p-4 sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">L</div>
            <span class="font-bold text-lg text-slate-800">Listriku</span>
        </div>
        <button @click="sidebarOpen = !sidebarOpen" class="text-slate-600 hover:text-blue-600 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>

    <div class="flex h-screen overflow-hidden">
        
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed md:static inset-y-0 left-0 z-40 w-72 bg-white shadow-[4px_0_24px_rgba(0,0,0,0.02)] transform md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col justify-between">
            
            <div class="h-24 flex items-center px-8 border-b border-slate-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center text-white shadow-blue-200 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-800 tracking-tight">Listriku</h1>
                        <p class="text-[10px] text-slate-400 font-medium tracking-wider uppercase">Payment System</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                
                @if(Auth::guard('admin')->check())
                    <p class="px-4 text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Main Menu</p>
                    
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 group {{ Request::is('admin/dashboard') ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>

                    <p class="px-4 text-xs font-bold text-slate-400 uppercase tracking-wider mt-6 mb-4">Data Master</p>

                    <a href="{{ route('pelanggan.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 group {{ Request::is('admin/pelanggan*') ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Data Pelanggan
                    </a>

                    <a href="{{ route('tarif.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 group {{ Request::is('admin/tarif*') ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Tarif Listrik
                    </a>

                    <p class="px-4 text-xs font-bold text-slate-400 uppercase tracking-wider mt-6 mb-4">Transaksi</p>

                    <a href="{{ route('tagihan.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 group {{ Request::is('admin/tagihan*') ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Tagihan & Bayar
                    </a>

                    <a href="{{ route('penggunaan.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 group {{ Request::is('admin/penggunaan*') ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                        Riwayat Meter
                    </a>

                    <a href="{{ route('admin.laporan.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 group {{ Request::is('admin/laporan*') ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                     <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Laporan
                    </a>
                
                @elseif(Auth::guard('pelanggan')->check())
                    <p class="px-4 text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Area Pelanggan</p>
                    
                    <a href="{{ route('pelanggan.dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 group {{ Request::is('pelanggan/dashboard') ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Beranda
                    </a>

                    <a href="{{ route('pelanggan.tagihan') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 group {{ Request::is('pelanggan/tagihan*') || Request::is('pelanggan/bayar*') ? 'bg-blue-50 text-blue-600 font-semibold shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        Riwayat Tagihan
                    </a>
                @endif
            </nav>
            
            <div class="p-4 border-t border-slate-50">
    <a href="{{ Auth::guard('admin')->check() ? route('admin.profile') : route('pelanggan.profile') }}" 
       class="flex items-center gap-3 px-4 py-3 bg-slate-50 rounded-xl mb-3 hover:bg-blue-50 transition cursor-pointer group">
        
        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-blue-600 font-bold shadow-sm group-hover:scale-110 transition-transform">
            {{ substr(Auth::guard('admin')->check() ? Auth::guard('admin')->user()->username : Auth::guard('pelanggan')->user()->username, 0, 1) }}
        </div>
        <div class="overflow-hidden">
            <p class="text-sm font-semibold text-slate-700 truncate group-hover:text-blue-700">
                {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->nama_admin : Auth::guard('pelanggan')->user()->nama_pelanggan }}
            </p>
            <p class="text-xs text-slate-400 truncate">
                Klik untuk edit profil
            </p>
        </div>
    </a>
    
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium text-red-500 hover:bg-red-50 hover:text-red-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Sign Out
        </button>
    </form>
</div>
        </aside>

        <main class="flex-1 overflow-y-auto" @click="sidebarOpen = false">
            <div class="p-8 max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>