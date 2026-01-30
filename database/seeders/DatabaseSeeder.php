<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Level;
use App\Models\Tarif;
use App\Models\Pelanggan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Level
        $adminLevel = Level::create(['nama_level' => 'Administrator']);
        
        // 2. Buat Tarif Dummy
        $tarifR1 = Tarif::create([
            'daya' => '900VA',
            'tarifperkwh' => 1352
        ]);

        // 3. Buat Akun Admin
        User::create([
            'username' => 'admin',
            'password' => Hash::make('password'), // Password di-hash!
            'nama_admin' => 'Admin Serkom',
            'id_level' => $adminLevel->id_level,
        ]);

        // 4. Buat Akun Pelanggan
        Pelanggan::create([
            'username' => 'budi',
            'password' => Hash::make('password'),
            'nomor_kwh' => '1234567890',
            'nama_pelanggan' => 'Budi Santoso',
            'alamat' => 'Jl. Mawar No 1',
            'id_tarif' => $tarifR1->id_tarif,
        ]);
    }
}