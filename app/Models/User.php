<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Sesuaikan dengan nama tabel di database
    protected $table = 'user';
    // Sesuaikan primary key
    protected $primaryKey = 'id_user';
    
    protected $fillable = [
        'username',
        'password',
        'nama_admin',
        'id_level',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi ke Level
    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level', 'id_level');
    }
}