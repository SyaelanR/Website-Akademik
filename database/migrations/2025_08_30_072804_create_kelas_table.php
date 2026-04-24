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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas'); // ->primary() sudah implisit
            $table->string('nama_kelas');
            $table->unsignedBigInteger('id_angkatan')->nullable(); // Tambahkan kolomnya dulu dan buat nullable
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('wali_kelas')->nullable();
            $table->timestamps();
            
            $table->foreign('id_angkatan')->references('id_angkatan')->on('angkatans')->onDelete('set null');
            $table->foreign('id_sekolah')->references('id_sekolah')->on('cliens')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
