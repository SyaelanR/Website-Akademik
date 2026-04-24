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
        Schema::table('users', function (Blueprint $table) {
            $table->text('password')->change();
            $table->string('nisn_nik')->unique()->after('password');
            $table->string('alamat')->nullable()->after('nisn_nik');
            $table->string('role')->default('siswa')->after('alamat');
            $table->unsignedBigInteger('id_kelas')->nullable()->after('role');
            $table->unsignedBigInteger('id_angkatan')->nullable()->after('id_kelas');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable()->after('id_angkatan');
            $table->string('username')->unique()->after('jenis_kelamin');
            $table->unsignedBigInteger('id_sekolah')->nullable()->after('username');

            //tambahan guru
            $table->string('no_telp')->nullable()->after('id_sekolah');
            $table->string('tempat_lahir')->nullable()->after('no_telp');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->integer('usia')->nullable()->after('tanggal_lahir');

            //tambahan siswa
            $table->date('tanggal_masuk')->nullable()->after('usia');
            $table->date('tanggal_lulus')->nullable()->after('tanggal_masuk');
            $table->string('nama_orang_tua')->nullable()->after('tanggal_lulus');
            $table->integer('gaji_orang_tua')->nullable()->after('nama_orang_tua');
            $table->integer('jumlah_sodara')->nullable()->after('gaji_orang_tua');

            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('set null');
            $table->foreign('id_angkatan')->references('id_angkatan')->on('angkatans')->onDelete('set null');
            $table->foreign('id_sekolah')->references('id_sekolah')->on('cliens')->onDelete('set null');


            // Tips: Jika Anda sudah memiliki tabel 'kelas', Anda bisa menambahkan foreign key constraint.
            // Cukup hapus komentar pada baris di bawah ini.
            // $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign keys first by their column names for reliability
            $table->dropForeign(['id_sekolah']);
            $table->dropForeign(['id_angkatan']);
            $table->dropForeign(['id_kelas']);

            // Drop all columns that were added in the up() method
            $table->dropColumn([
                'nisn_nik',
                'alamat',
                'role',
                'id_kelas',
                'id_angkatan',
                'jenis_kelamin',
                'username',
                'id_sekolah',
                'no_telp',
                'tempat_lahir',
                'tanggal_lahir',
                'usia',
                'tanggal_masuk',
                'tanggal_lulus',
                'nama_orang_tua',
                'gaji_orang_tua',
                'jumlah_sodara',
            ]);
        });
    }
};