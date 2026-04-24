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
        Schema::create('daftar_tagihans', function (Blueprint $table) {
            $table->id('id_daftar_tagihan');
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->decimal('jumlah_tagihan', 15, 2);
            $table->string('keterangan');
            $table->date('jatuh_tempo');
            $table->unsignedBigInteger('target_angkatan');
            $table->string('nama_angkatan');
            $table->integer('persentase_terbayar')->default(0); // 0: belum lunas, 1: lunas
            $table->timestamps();

            $table->foreign('id_sekolah')->references('id_sekolah')->on('cliens')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_tagihans');
    }
};
