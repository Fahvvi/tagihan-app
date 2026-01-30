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
    Schema::create('pembayaran', function (Blueprint $table) {
        $table->id('id_pembayaran');
        $table->unsignedBigInteger('id_tagihan');
        $table->unsignedBigInteger('id_pelanggan');
        $table->date('tanggal_pembayaran');
        $table->string('bulan_bayar');
        $table->decimal('biaya_admin', 10, 2);
        $table->decimal('total_bayar', 10, 2);
        $table->unsignedBigInteger('id_user'); // Admin yang memproses
        $table->timestamps();

        $table->foreign('id_tagihan')->references('id_tagihan')->on('tagihan');
        $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan');
        $table->foreign('id_user')->references('id_user')->on('user');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
