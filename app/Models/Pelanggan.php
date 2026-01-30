<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Penting: Ganti Model jadi Authenticatable
use Illuminate\Notifications\Notifiable;

class Pelanggan extends Authenticatable
{
    use Notifiable;

    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'username',
        'password',
        'nomor_kwh',
        'nama_pelanggan',
        'alamat',
        'id_tarif',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi: Pelanggan punya Tarif
    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif', 'id_tarif');
    }
    
    // Relasi: Pelanggan punya banyak penggunaan
    public function penggunaan()
    {
        return $this->hasMany(Penggunaan::class, 'id_pelanggan', 'id_pelanggan');
    }
}