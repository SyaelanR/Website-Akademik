<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Clien;
use App\Models\Angkatan;
use App\Models\Kelas;
use App\Models\Tingkat;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Clien::create([
            'nama_sekolah' => 'SMK Bhakti Mulia Wonogiri',
            'email' => 'bhaktimulia@gmail.com',
            'alamat' => 'Wonogiri',
            'no_telp' => '081234567890',
            'status' => 'Aktif'
        ]);

        Tingkat::create([
            'tingkat' => 1,
            'id_sekolah' => 1,
        ]);

        Tingkat::create([
            'tingkat' => 2,
            'id_sekolah' => 1,
        ]);

        Angkatan::create([
            'angkatan' => '2025/2026',
            'id_sekolah' => 1,
            'semester' => 'ganjil',
            'tanggal_mulai' => '2025-07-01',
            'tanggal_selesai' => '2026-06-30',
            'tingkat' => 2,
            'id_tingkat' => 2,
        ]);
    
        Angkatan::create([
            'angkatan' => '2026/2027',
            'id_sekolah' => 1,
            'semester' => 'genap',
            'tanggal_mulai' => '2026-07-01',
            'tanggal_selesai' => '2027-06-30',
            'tingkat' => 1,
            'id_tingkat' => 1,
        ]);

        Kelas::create([
            'nama_kelas' => 'X RPL 1',
            'id_angkatan' => 1,
            'id_sekolah' => 1,
            'jurusan' => 'RPL',
            'wali_kelas' => 'jarwo',
        ]);
            
        User::create([
            'nisn_nik' => '220103190',
            'name' => 'SyaelanR',
            'email' => 'syaelanr@gmail.com',
            'password' => 'password',
            'username' => 'syaelanr',
            'role' => 'adminDev'
        ]);

        User::create([
            'nisn_nik' => '220103191',
            'name' => 'yanto',
            'email' => 'yanto@gmail.com',
            'password' => 'password',
            'username' => 'yanto',
            'role' => 'admin',
            'id_sekolah' => 1
        ]);

        User::create([
            'nisn_nik' => '220103192',
            'name' => 'jarwo',
            'alamat' => 'Wonogiri',
            'tempat_lahir' => 'Wonogiri',
            'tanggal_lahir' => '1990-05-15',
            'usia' => 34,
            'no_telp' => '081234567892',
            'role' => 'guru', 
            'email' => 'jarwo@gmail.com',
            'password' => 'password',
            'username' => 'jarwo',
            'id_sekolah' => 1,
        ]);

        User::create([
            'nisn_nik' => '220103193',
            'name' => 'yono',
            'alamat' => 'Wonogiri',
            'tempat_lahir' => 'Wonogiri',
            'tanggal_lahir' => '2007-08-20',
            'tanggal_masuk' => '2025-07-01',
            'tanggal_lulus' => '2028-06-30',
            'nama_orang_tua' => 'sulami',
            'no_telp' => '081234567891',
            'jumlah_sodara' => 2,
            'gaji_orang_tua' => 1500000,
            'jenis_kelamin' => 'Laki-laki',
            'id_angkatan' => 1,
            'email' => 'yono@gmail.com',
            'password' => 'password',
            'username' => 'yono',
            'role' => 'siswa',
            'id_sekolah' => 1,
            'id_kelas' => 1,
        ]);

        User::create([
            'nisn_nik' => '220103196',
            'name' => 'yanti',
            'alamat' => 'Wonogiri',
            'tempat_lahir' => 'Wonogiri',
            'tanggal_lahir' => '2007-08-20',
            'tanggal_masuk' => '2025-07-01',
            'tanggal_lulus' => '2028-06-30',
            'nama_orang_tua' => 'sulami',
            'no_telp' => '081234567891',
            'jumlah_sodara' => 2,
            'gaji_orang_tua' => 1500000,
            'jenis_kelamin' => 'perempuan',
            'id_angkatan' => 1,
            'email' => 'yanti@gmail.com',
            'password' => 'password',
            'username' => 'yanti',
            'role' => 'siswa',
            'id_sekolah' => 1,
            'id_kelas' => 1,
        ]);

        User::create([
            'nisn_nik' => '220103196',
            'name' => 'parno',
            'alamat' => 'Wonogiri',
            'tempat_lahir' => 'Wonogiri',
            'tanggal_lahir' => '2007-08-20',
            'tanggal_masuk' => '2025-07-01',
            'tanggal_lulus' => '2028-06-30',
            'nama_orang_tua' => 'sulami',
            'no_telp' => '081234567891',
            'jumlah_sodara' => 2,
            'gaji_orang_tua' => 1500000,
            'jenis_kelamin' => 'Laki-laki',
            'email' => 'parno@gmail.com',
            'password' => 'password',
            'username' => 'parno',
            'role' => 'siswa',
            'id_sekolah' => 1,
        ]);
    }
}
