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
        Schema::create('daftar_nilai_siswas', function (Blueprint $table) {
            $table->id('id_daftar_nilai_siswa');
            $table->unsignedBigInteger('id_siswa')->nullable();
            $table->unsignedBigInteger('id_daftar_nilai')->nullable();
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->unsignedBigInteger('id_kelas')->nullable();
            $table->unsignedBigInteger('id_mapel')->nullable();
            $table->unsignedBigInteger('tingkat')->nullable();
            $table->enum('semester', ['ganjil', 'genap'])->nullable();
            $table->integer('nilai')->default(0);
            $table->string('nama_fileTugas')->nullable(); // + time(). menghasilkan namafile yang selalu unik
            $table->timestamps();

            $table->foreign('id_siswa')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_daftar_nilai')->references('id_daftar_nilai')->on('daftar_nilais')->onDelete('cascade');
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
        Schema::dropIfExists('daftar_nilai_siswas');
    }
};
