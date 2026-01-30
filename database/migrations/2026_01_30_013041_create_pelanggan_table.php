<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pelanggan', function (Blueprint $table) {
        $table->id('id_pelanggan');
        $table->string('username')->unique();
        $table->string('password');
        $table->string('nomor_kwh')->unique();
        $table->string('nama_pelanggan');
        $table->text('alamat');
        // Foreign Key ke Tarif
        $table->unsignedBigInteger('id_tarif');
        $table->foreign('id_tarif')->references('id_tarif')->on('tarif');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
