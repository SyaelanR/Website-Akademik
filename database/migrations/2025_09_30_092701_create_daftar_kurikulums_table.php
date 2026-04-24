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
        Schema::create('daftar_kurikulums', function (Blueprint $table) {
            $table->id('id_kurikulum');
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->unsignedBigInteger('id_angkatan')->nullable();
            $table->string('nama_kurikulum');
            $table->enum('jenjang', ['SD', 'SMP', 'SMA', 'SMK']);
            $table->integer('jumlah_matpel');
            $table->enum('status', ['aktif', 'non-aktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('id_sekolah')->references('id_sekolah')->on('cliens')->onDelete('set null');
            $table->foreign('id_angkatan')->references('id_angkatan')->on('angkatans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_kurikulums');
    }
};
