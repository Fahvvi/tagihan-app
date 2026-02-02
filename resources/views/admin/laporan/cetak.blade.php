<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan - Listriku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background: white; font-family: sans-serif; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body class="p-8">

    <div class="text-center border-b-2 border-slate-800 pb-6 mb-8">
        <h1 class="text-3xl font-bold uppercase tracking-widest text-slate-800">LISTRIKU PPOB</h1>
        <p class="text-slate-500">Laporan Pendapatan Resmi</p>
        <p class="mt-2 text-sm">Periode: <span class="font-bold">{{ date('F', mktime(0, 0, 0, $bulan, 1)) }} {{ $tahun }}</span></p>
    </div>

    <table class="w-full text-left text-sm border-collapse border border-slate-300">
        <thead class="bg-slate-100 text-slate-800">
            <tr>
                <th class="border border-slate-300 px-4 py-2">No</th>
                <th class="border border-slate-300 px-4 py-2">Tanggal</th>
                <th class="border border-slate-300 px-4 py-2">Pelanggan</th>
                <th class="border border-slate-300 px-4 py-2 text-right">Admin</th>
                <th class="border border-slate-300 px-4 py-2 text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($pembayaran as $index => $item)
            @php $grandTotal += $item->total_bayar; @endphp
            <tr>
                <td class="border border-slate-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                <td class="border border-slate-300 px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('d/m/Y') }}</td>
                <td class="border border-slate-300 px-4 py-2">
                    {{ $item->pelanggan->nama_pelanggan }} <br>
                    <span class="text-xs text-slate-500">{{ $item->pelanggan->nomor_kwh }}</span>
                </td>
                <td class="border border-slate-300 px-4 py-2 text-right">Rp {{ number_format($item->biaya_admin, 0, ',', '.') }}</td>
                <td class="border border-slate-300 px-4 py-2 text-right font-bold">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="bg-slate-50">
                <td colspan="4" class="border border-slate-300 px-4 py-3 text-right font-bold uppercase">Total Pendapatan</td>
                <td class="border border-slate-300 px-4 py-3 text-right font-bold text-lg">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="mt-12 flex justify-end">
        <div class="text-center">
            <p class="text-sm text-slate-500 mb-16">Jakarta, {{ date('d F Y') }}</p>
            <p class="font-bold border-b border-slate-800 pb-1">{{ Auth::guard('admin')->user()->nama_admin }}</p>
            <p class="text-xs text-slate-400">Administrator</p>
        </div>
    </div>

    <script>
        window.onload = function() { window.print(); }
    </script>
</body>
</html>