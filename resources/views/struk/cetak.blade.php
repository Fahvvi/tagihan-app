<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran - {{ $tagihan->pelanggan->nama_pelanggan }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            /* Sembunyikan tombol cetak saat diprint */
            .no-print { display: none; }
            body { background-color: white; }
            .struk-container { box-shadow: none; border: none; }
        }
        body { font-family: 'Courier New', Courier, monospace; } /* Font ala struk */
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="struk-container bg-white w-full max-w-md p-8 rounded-none md:rounded-lg shadow-lg border border-gray-200">
        
        <div class="text-center border-b-2 border-dashed border-gray-300 pb-4 mb-4">
            <h1 class="text-xl font-bold uppercase tracking-widest text-gray-800">LISTRIKU PPOB</h1>
            <p class="text-xs text-gray-500">Jl. Teknologi No. 12, Jakarta</p>
            <p class="text-xs text-gray-500 mt-1">BUKTI PEMBAYARAN TAGIHAN LISTRIK</p>
        </div>

        <div class="space-y-2 text-sm text-gray-700 mb-6">
            <div class="flex justify-between">
                <span>Tanggal Bayar</span>
                <span class="font-bold">{{ \Carbon\Carbon::parse($tagihan->pembayaran->tanggal_pembayaran)->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between">
                <span>No. Ref</span>
                <span class="font-bold uppercase">{{ substr(md5($tagihan->id_tagihan), 0, 8) }}</span>
            </div>
            <div class="flex justify-between">
                <span>Bulan Tagihan</span>
                <span>{{ $tagihan->bulan }} {{ $tagihan->tahun }}</span>
            </div>
        </div>

        <div class="border-t-2 border-dashed border-gray-300 py-4 mb-4 text-sm">
            <div class="flex justify-between mb-1">
                <span>ID Pelanggan</span>
                <span class="font-bold">{{ $tagihan->pelanggan->nomor_kwh }}</span>
            </div>
            <div class="flex justify-between mb-1">
                <span>Nama</span>
                <span class="uppercase">{{ $tagihan->pelanggan->nama_pelanggan }}</span>
            </div>
            <div class="flex justify-between mb-1">
                <span>Tarif / Daya</span>
                <span>{{ $tagihan->pelanggan->tarif->daya }}</span>
            </div>
            <div class="flex justify-between">
                <span>Stand Meter</span>
                <span>{{ $tagihan->penggunaan->meter_awal }} - {{ $tagihan->penggunaan->meter_akhir }}</span>
            </div>
        </div>

        <div class="bg-gray-50 p-4 border border-gray-100 rounded mb-6 text-sm">
            <div class="flex justify-between mb-1">
                <span>Tagihan Listrik</span>
                <span>Rp {{ number_format(($tagihan->pembayaran->total_bayar - $tagihan->pembayaran->biaya_admin), 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span>Biaya Admin</span>
                <span>Rp {{ number_format($tagihan->pembayaran->biaya_admin, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between font-bold text-lg border-t border-gray-300 pt-2 text-gray-900">
                <span>TOTAL BAYAR</span>
                <span>Rp {{ number_format($tagihan->pembayaran->total_bayar, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="text-center text-xs text-gray-400 mb-6">
            <p>Struk ini adalah bukti pembayaran yang sah.</p>
            <p>Terima kasih atas kepercayaan Anda.</p>
        </div>

        <div class="no-print flex flex-col gap-2">
            <button onclick="window.print()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition shadow-lg">
                🖨️ Cetak Struk
            </button>
            <button onclick="window.close()" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 rounded-lg transition">
                Tutup Jendela
            </button>
        </div>

    </div>

    <script>
        window.onload = function() {
            // Uncomment baris bawah ini jika ingin langsung print saat dibuka
            // window.print();
        }
    </script>
</body>
</html>