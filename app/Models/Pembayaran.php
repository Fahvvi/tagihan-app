<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $guarded = []; // Ini cara cepat agar semua kolom bisa diisi (selain id)
    
    // Relasi ke Penggunaan
    public function penggunaan()
    {
        return $this->belongsTo(Penggunaan::class, 'id_penggunaan', 'id_penggunaan');
    }

    // Relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function user() // Relasi ke Admin yang memproses (opsional)
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
