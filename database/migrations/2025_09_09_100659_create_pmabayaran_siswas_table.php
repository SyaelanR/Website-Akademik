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
        Schema::create('pmabayaran_siswas', function (Blueprint $table) {
            $table->id('id_pembayaran_siswa');
            $table->unsignedBigInteger('id_siswa')->nullable();
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->unsignedBigInteger('id_daftar_tagihan')->nullable();
            $table->decimal('jumlah_tagihan', 15, 2);
            $table->enum('status_pembayaran', ['lunas', 'belum lunas'])->default('belum lunas');
            $table->boolean('sinkronisasi')->default(false);
            $table->timestamps();

            $table->foreign('id_siswa')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_sekolah')->references('id_sekolah')->on('cliens')->onDelete('set null');
            $table->foreign('id_daftar_tagihan')->references('id_daftar_tagihan')->on('daftar_tagihans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pmabayaran_siswas');
    }
};
