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
        Schema::create('cliens', function (Blueprint $table) {
            $table->id('id_sekolah');
            $table->string('nama_sekolah');
            $table->string('email')->unique();
            $table->string('alamat');
            $table->string('no_telp');
            $table->enum('status', ['Aktif', 'Pending', 'Non-Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliens');
    }
};
