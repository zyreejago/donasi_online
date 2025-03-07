<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('donasis', function (Blueprint $table) {
        $table->id();
        $table->string('nama_donatur');
        $table->string('email')->nullable();
        $table->enum('jenis_donasi', ['zakat', 'infaq', 'shodaqoh', 'qurban', 'wakaf']);
        $table->enum('metode_donasi', ['uang', 'barang']);
        $table->decimal('jumlah', 15, 2)->nullable();
        $table->text('deskripsi_barang')->nullable();
        $table->enum('status', ['pending', 'terverifikasi'])->default('pending');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};
