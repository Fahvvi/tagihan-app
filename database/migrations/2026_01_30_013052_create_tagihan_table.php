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
    Schema::create('tagihan', function (Blueprint $table) {
        $table->id('id_tagihan');
        $table->unsignedBigInteger('id_penggunaan');
        $table->unsignedBigInteger('id_pelanggan');
        $table->string('bulan');
        $table->string('tahun');
        $table->integer('jumlah_meter');
        $table->string('status')->default('Belum Bayar'); // Default status
        $table->timestamps();

        $table->foreign('id_penggunaan')->references('id_penggunaan')->on('penggunaan');
        $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};
