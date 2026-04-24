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
        Schema::create('mapels', function (Blueprint $table) {
            $table->id('id_mapel');
            $table->string('kode_mapel');
            $table->string('kategori');
            $table->string('nama_mapel');
            $table->string('nama_guru')->nullable();
            $table->integer('sks');
            $table->unsignedBigInteger('id_guru')->nullable();
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('id_guru')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_sekolah')->references('id_sekolah')->on('cliens')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapels');
    }
};
