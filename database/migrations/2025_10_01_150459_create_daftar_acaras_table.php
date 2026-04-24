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
        Schema::create('daftar_acaras', function (Blueprint $table) {
            $table->id('id_daftar_acara');
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->string('judul_acara');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->string('lokasi');
            $table->string('peserta');
            $table->string('deskripsi');
            $table->timestamps();

            $table->foreign('id_sekolah')->references('id_sekolah')->on('cliens')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_acaras');
    }
};
