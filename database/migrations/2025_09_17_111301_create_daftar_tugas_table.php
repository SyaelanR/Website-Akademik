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
        Schema::create('daftar_tugas', function (Blueprint $table) {
            $table->id('id_daftar_tugas');
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->unsignedBigInteger('id_kelas')->nullable();
            $table->unsignedBigInteger('id_mapel')->nullable();
            $table->unsignedBigInteger('tingkat');
            $table->enum('semester', ['ganjil', 'genap']);
            $table->timestamp('deadline');
            $table->string('keterangan');
            $table->string('nama_file'); // + time(). menghasilkan namafile yang selalu unik
            $table->timestamps();  
            
            $table->foreign('id_sekolah')->references('id_sekolah')->on('cliens')->onDelete('set null');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('set null');
            $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_tugas');
    }
};
