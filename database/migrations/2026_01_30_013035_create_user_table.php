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
    Schema::create('user', function (Blueprint $table) {
        $table->id('id_user');
        $table->string('username')->unique();
        $table->string('password');
        $table->string('nama_admin');
        // Foreign Key ke Level
        $table->unsignedBigInteger('id_level');
        $table->foreign('id_level')->references('id_level')->on('level');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
