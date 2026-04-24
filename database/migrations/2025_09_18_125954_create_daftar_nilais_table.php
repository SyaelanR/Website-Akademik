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
        Schema::create('daftar_nilais', function (Blueprint $table) {
            $table->id('id_daftar_nilai');
            $table->unsignedBigInteger('id_mapel')->nullable();
            $table->unsignedBigInteger('id_daftar_tugas')->nullable();
            $table->string('tipe_nilai')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('tanggal')->nullable();
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->unsignedBigInteger('id_kelas')->nullable();
            $table->unsignedBigInteger('tingkat')->nullable();
            $table->enum('semester', ['ganjil', 'genap'])->nullable();
            $table->enum('sifat', ['online', 'offline'])->default('offline');
            $table->timestamps();

            $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onDelete('set null');
            $table->foreign('id_sekolah')->references('id_sekolah')->on('cliens')->onDelete('set null');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('set null');
            $table->foreign('id_daftar_tugas')->references('id_daftar_tugas')->on('daftar_tugas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_nilais');
    }
};
