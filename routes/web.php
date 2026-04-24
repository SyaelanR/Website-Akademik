<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDevController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JadwalController;
use Illuminate\Auth\Events\Login;

// Rute Autentikasi Kustom
// Menggunakan middleware 'guest' agar pengguna yang sudah login tidak bisa mengakses halaman login lagi.
Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'welcome'])->name('welcome');
    Route::post('/', [LoginController::class, 'login'])->name('login');
});


// Rute yang memerlukan autentikasi (hanya bisa diakses setelah login)\

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

    Route::get('/pengaturan_akun', [LoginController::class, 'pengaturanAkun'])->name('pengaturanAkun');
    Route::put('/', [LoginController::class, 'updateAkun'])->name('updateAkun');

        // Grup rute ini sekarang hanya bisa diakses oleh pengguna dengan role 'admin'.
    Route::middleware('role:admin')->group(function () {
        Route::prefix('manajemen-siswa')->group(function () {
            Route::get('/', [AdminController::class, 'manajSiswa'])->name('manajemenSiswa');
            Route::get('/tambah-siswa', [AdminController::class, 'tambahSiswa'])->name('tambahSiswa');
            Route::post('/tambah-siswa', [AdminController::class, 'storeSiswa'])->name('storeSiswa');
            // Route untuk Edit Siswa
            Route::get('/{siswa}/edit', [AdminController::class, 'editSiswa'])->name('editSiswa');
            Route::put('/{siswa}', [AdminController::class, 'updateSiswa'])->name('updateSiswa');
            // Route untuk Hapus Siswa
            Route::delete('/{siswa}', [AdminController::class, 'hapusSiswa'])->name('hapusSiswa');
            Route::get('/lihat-detail/{idsiswa}', [AdminController::class, 'lihatDetailSiswa'])->name('lihatDetailSiswa');
            Route::get('/history-kbm/{idsiswa}/{idTingkat}/{semester}', [AdminController::class, 'historyKBM'])->name('historyKBM');

            Route::get('/rapor/{id_siswa}/{id_tingkat}/{semester}', [AdminController::class, 'rapor'])->name('rapor');
        });
        
        Route::prefix('manajemen-guru')->group(function () {
            Route::get('/', [AdminController::class, 'manajGuru'])->name('manajemenGuru');
            Route::get('/tambah-guru', [AdminController::class, 'tambahGuru'])->name('tambahGuru');
            Route::post('/tambah-guru', [AdminController::class, 'storeGuru'])->name('storeGuru');

            Route::delete('/{id}', [AdminController::class, 'hapusGuru'])->name('hapusGuru');

            Route::get('/edit_guru/{id}', [AdminController::class, 'editGuru'])->name('editGuru');

            Route::put('/manajemen-guru/{id}', [AdminController::class, 'updateGuru'])->name('updateGuru');
        });

        Route::prefix('manajemen-angkatan')->group(function () {
            Route::get('/', [AdminController::class, 'manajAngkatan'])->name('manajemenAngkatan');
            Route::post('/', [AdminController::class, 'storeAngkatan'])->name('storeAngkatan');
            Route::put('/{id}', [AdminController::class, 'updateAngkatan'])->name('updateAngkatan');
            Route::delete('/{id}', [AdminController::class, 'destroyAngkatan'])->name('destroyAngkatan');
        });

        Route::prefix('manajemen-kelas')->group(function () {
            Route::get('/', [AdminController::class, 'manajKelas'])->name('manajemenKelas');
            Route::post('/', [AdminController::class, 'storeKelas'])->name('storeKelas');
            // PERBAIKAN: Mengubah route untuk menerima ID kelas dari URL dengan method GET
            Route::get('/lihat-kelas/{id_kelas}', [AdminController::class, 'lihatKelas'])->name('lihatKelas');
            Route::post('/lihat-kelas/tambah-siswa-ke-kelas', [AdminController::class, 'tambahSiswaKeKelas'])->name('tambahSiswaKeKelas');

 
            Route::get('/edit-kelas/{id}', [AdminController::class, 'editKelas'])->name('editKelas');
            Route::put('/edit-kelas/{id}', [AdminController::class, 'updateKelas'])->name('updateKelas');
            // Route::delete('/edit-kelas/{id}', [AdminController::class, 'destroyKelas'])->name('destroyKelas');
            Route::delete('/kelas/keluarkan-siswa/{id_siswa}/{id_kelas}', [AdminController::class, 'keluarkanSiswaDariKelas'])->name('keluarkanSiswaDariKelas');


            Route::delete('/{id_kelas}', [AdminController::class, 'destroyKelas'])->name('destroyKelas');

        });
        
        Route::prefix('manajemen-kurikulum')->group(function(){
            Route::get('/', [AdminController::class, 'manajKurikulum'])->name('manajemenKurikulum');
            Route::post('/', [AdminController::class, 'storeKurikulum'])->name('storeKurikulum');
            Route::put('/{id}', [AdminController::class, 'updateKurikulum'])->name('updateKurikulum');
            Route::delete('/{id}', [AdminController::class, 'destroyKurikulum'])->name('destroyKurikulum');
        });

        Route::prefix('manajemen-keuangan')->group(function () {
            Route::get('/', [AdminController::class, 'manajKeuangan'])->name('manajemenKeuangan');
            Route::post('/pemasukan', [AdminController::class, 'storePemasukan'])->name('storePemasukan');
            Route::post('/pengeluaran', [AdminController::class, 'storePengeluaran'])->name('storePengeluaran');
            Route::get('/tagihan-siswa', [AdminController::class, 'tagihanSiswa'])->name('tagihanSiswa');
            Route::post('/tagihan-siswa', [AdminController::class, 'storeTagihan'])->name('storeTagihan');
            
            // Route::post('/tagihan-siswa/pembayaran-tagihan', [AdminController::class, 'pembayaranTagihansiswa'])->name('pembayaranTagihanSiswa');
        });

        Route::prefix('manajemen-mapel')->group(function () {
            Route::get('/', [AdminController::class, 'manajMapel'])->name('manajemenMapel');
            Route::post('/', [AdminController::class, 'storeMapel'])->name('storeMapel');
            Route::put('/{id}', [AdminController::class, 'updateMapel'])->name('updateMapel');
            Route::delete('/{id}', [AdminController::class, 'destroyMapel'])->name('destroyMapel');
        });

        Route::prefix('manajemen-jadwal')->group(function () {
            Route::get('/', [AdminController::class, 'manajJadwal'])->name('manajemenJadwal');
            Route::get('/tambah-jadwal/{id_kelas}', [AdminController::class, 'tambahJadwal'])->name('tambahJadwal');
            Route::post('/tambah-jadwal/{id_kelas}', [AdminController::class, 'storeJadwal'])->name('storeJadwal');
            Route::put('/update-jadwal/{id_jadwal}', [AdminController::class, 'updateJadwal'])->name('updateJadwal');
            Route::delete('/jadwal/{id_jadwal}', [AdminController::class, 'destroyJadwal'])->name('jadwal.destroy.single');

            // Rute untuk menghapus SEMUA jadwal berdasarkan ID KELAS
            // Route::delete('/jadwal/kelas/{id_kelas}', [JadwalController::class, 'destroyByClass'])->name('jadwal.destroy.by_class');
            // Rute untuk menghapus SATU jadwal spesifik berdasarkan ID JADWAL
            
        });

        Route::prefix('manajemen-tingkat')->group(function () {
            Route::get('/', [AdminController::class, 'manajTingkat'])->name('manajemenTingkat');
            Route::post('/', [AdminController::class, 'storeTingkat'])->name('storeTingkat');
            Route::put('/{id_tingkat}', [AdminController::class, 'updateTingkat'])->name('updateTingkat');
            Route::delete('/{id_tingkat}', [AdminController::class, 'destroyTingkat'])->name('destroyTingkat');
        });


        // Route::prefix('pelanggaran')->group(function () {
        //     Route::get('/', [\App\Http\Controllers\pelanggaranController::class, 'index'])->name('pelanggaran.index');
        //     Route::post('/', [\App\Http\Controllers\pelanggaranController::class, 'store'])->name('pelanggaran.store');
        //     Route::get('/daftar/{id_kelas}', [\App\Http\Controllers\pelanggaranController::class, 'daftarPelanggar'])->name('pelanggaran.daftar');
        //     Route::put('/{pelanggaran}', [\App\Http\Controllers\pelanggaranController::class, 'update'])->name('pelanggaran.update');
        //     Route::delete('/{pelanggaran}', [\App\Http\Controllers\pelanggaranController::class, 'destroy'])->name('pelanggaran.destroy');
        // });


        Route::prefix('manajemen-rapor')->group(function (){
            Route::get('/', [AdminController::class, 'manajRapor'])->name('manajemenRapor');
            Route::get('/rapor/{id_kelas}', [AdminController::class, 'Rapors'])->name('Rapors');

        });

        Route::prefix('manajemen-acara')->group(function () {
            Route::get('/', [AdminController::class, 'manajAcara'])->name('manajAcara');
            Route::post('/acara-sekolah', [AdminController::class, 'storeAcara'])->name('admin.acara.store');
            Route::put('/acara-sekolah/{id}', [AdminController::class, 'updateAcara'])->name('admin.acara.update');
            Route::delete('/acara-sekolah/{id}', [AdminController::class, 'destroyAcara'])->name('admin.acara.destroy');
        });

        Route::get('/profileA', [AdminController::class, 'showProfileA'])->name('admin.profile');

       /////////////////////////////alumni/////////////////////////////////////////
        Route::prefix('manajemen-alumni')->group(function () {
            Route::get('/', [AdminController::class, 'manajAlumni'])->name('manajemenAlumni');
            Route::get('/siswa/{id_angkatan}', [AdminController::class, 'siswaAlumni'])->name('siswaAlumni');
            Route::get('/detail_siswa_alumni/{id_siswa}', [AdminController::class, 'lihatDetailSiswa'])->name('detailSiswaAlumni');
            Route::get('/history-kbm-alumni/{idsiswa}/{idTingkat}/{semester}', [AdminController::class, 'historyKBM'])->name('historyKBMAlumni');
            // Route::post('/', [AdminController::class, 'storeAlumni'])->name('storeAlumni');
            // jadi kita bisa arahkan ke sana atau buat method baru jika perlu logic berbeda
            // Route::put('/{id}', [AdminController::class, 'updateAlumni'])->name('updateAlumni');
            // Route::delete('/{id}', [AdminController::class, 'destroyAlumni'])->name('destroyAlumni');
        });
    });

        

        // Grup rute ini sekarang hanya bisa diakses oleh pengguna dengan role 'adminDev'.
    Route::middleware('role:adminDev')->group(function () {
        Route::get('/tambah-admin-klien/{id_sekolah}', [AdminDevController::class, 'tambahAdminKlien'])->name('tambahAdminKlien');
        Route::post('/tambah-admin-klien/{id_sekolah}', [AdminDevController::class, 'storeAdmin'])->name('storeAdmin');

        Route::get('/klien', [AdminDevController::class, 'daftarKlien'])->name('daftarKlien');
        Route::get('/klien/{id_sekolah}', [AdminDevController::class, 'infoKlien'])->name('infoKlien');

        Route::get('/tambah-klien', [AdminDevController::class, 'tambahKlien'])->name('tambahKlien');
        Route::post('/tambah-klien', [AdminDevController::class, 'storeKlien'])->name('storeKlien');

        Route::put('/info-klien/{id}', [AdminDevController::class, 'updateAdminKlien'])->name('updateAdminKlien');
        Route::delete('/info-klien/{id}', [AdminDevController::class, 'destroyAdminKlien'])->name('destroyAdminKlien');

        Route::put('/info-klien/update-klien/{id}', [AdminDevController::class, 'updateKlien'])->name('updateKlien');

    });


        //Grup rute ini sekarang hanya bisa diakses oleh pengguna dengan role 'guru'.
    Route::middleware('role:guru')->group(function () {
        Route::get('/lihat-jadwal-guru', [GuruController::class, 'lihatjadwalG'])->name('lihatjadwalG');
        /////////////////////profile_guru//////////////////////////////////
        Route::get('/profil-saya', [GuruController::class, 'myProfile'])->name('guru.profile');

        Route::prefix('manajemen-nilai')->group(function () {
            Route::get('/', [GuruController::class, 'manajNilaiKelas'])->name('manajemenNilai');
            Route::get('/input-nilai/{id_kelas}/{id_mapel}/{id_daftar_nilai}', [GuruController::class, 'inputNilai'])->name('inputNilai');
            Route::get('/manajemen-nilai-daftar/{id_kelas}/{id_mapel}', [GuruController::class, 'manajNilaiDaftar'])->name('manajemenNilaiDaftar');
            Route::post('/manajemen-nilai-daftar/{id_kelas}/{id_mapel}', [GuruController::class, 'storeDaftarNilai'])->name('storeDaftarNilai');
            Route::post('/input-nilai', [GuruController::class, 'storeNilaiSiswa'])->name('storeNilaiSiswa');
            Route::put('/update-nilai/{id_daftar_nilai_siswa}', [GuruController::class, 'updateNilaiSiswa'])->name('updateNilaiSiswa');
            Route::delete('/destroy/{id_daftar_nilai}', [GuruController::class, 'destroyDaftarNilai'])->name('destroyDaftarNilai');

            Route::get('/input-nilai-online/{id_kelas}/{id_mapel}/{id_daftar_nilai}', [GuruController::class, 'inputNilaiOnline'])->name('inputNilaiOnline');
            Route::get('/lihatTugasSiswa/{namaFile}', [GuruController::class, 'lihatTugasSiswa'])->name('lihatTugasSiswa');
            Route::get('/lihatSoalSiswa/{namaFile}', [GuruController::class, 'lihatSoalSiswa'])->name('lihatSoalSiswa');

            Route::get('/export-nilai/{id_kelas}/{id_mapel}', [GuruController::class, 'exportNilai'])->name('exportNilai');


        });


        Route::prefix('manajemen-absensi')->group(function () {
            Route::get('/', [GuruController::class, 'manajAbsensi'])->name('manajAbsensi');
            Route::get('/manajemen-absensi-daftar/{id_kelas}/{id_mapel}', [GuruController::class, 'manajAbsensiDaftar'])->name('manajAbsensiDaftar');
            Route::post('/manajemen-absensi-daftar/{id_kelas}/{id_mapel}', [GuruController::class, 'storeAbsensiDaftar'])->name('storeAbsensiDaftar');
            Route::get('/input-absensi/{id_kelas}/{id_mapel}/{id_daftar_absensi}', [GuruController::class, 'inputAbsensi'])->name('inputAbsensi');
            Route::post('/input-absensi', [GuruController::class, 'storeAbsensiSiswa'])->name('storeAbsensiSiswa');
            Route::put('/update-absensi/{id_daftar_absensi_siswa}', [GuruController::class, 'updateAbsensiSiswa'])->name('updateAbsensiSiswa');
        });


        Route::prefix('manajemen-tugas')->group(function () {
            Route::get('/', [GuruController::class, 'manajTugasKelas'])->name('manajTugas');
            Route::get('/input-tugas/{id_kelas}/{id_mapel}', [GuruController::class, 'inputTugas'])->name('inputTugas');
            Route::post('/input-tugas/{id_kelas}/{id_mapel}', [GuruController::class, 'storeTugas'])->name('storeTugas');
            Route::put('/update/{id}', [GuruController::class, 'updateTugas'])->name('updateTugas');
            Route::delete('/delete/{id}', [GuruController::class, 'destroyTugas'])->name('destroyTugas');

        });

        Route::prefix('manajemen-materi')->group(function () {
            Route::get('/', [GuruController::class, 'manajMateriKelas'])->name('manajMateri');
            Route::get('/input-materi/{id_kelas}/{id_mapel}', [GuruController::class, 'inputMateri'])->name('inputMateri');
            Route::post('/input-materi/{id_kelas}/{id_mapel}', [GuruController::class, 'storeMateri'])->name('storeMateri');
            Route::put('/update-materi/{id}', [GuruController::class, 'updateMateri'])->name('updateMateri');
            Route::delete('/destroy-materi/{id_materi}', [GuruController::class, 'destroyMateri'])->name('destroyMateri');

            Route::get('/lihat-materi/{namaFile}', [GuruController::class, 'lihatMateri'])->name('lihatMateri');
        });


        Route::prefix('manajemen-pengumuman')->group(function () {
            Route::get('/', [GuruController::class, 'manajPengumumanKelas'])->name('manajPengumuman');
            Route::get('/manajemen-pengumuman-daftar/{id_kelas}/{id_mapel}', [GuruController::class, 'manajPengumumanDaftar'])->name('manajPengumumanDaftar');
            Route::post('/manajemen-pengumuman-daftar/{id_kelas}/{id_mapel}', [GuruController::class, 'storePengumumanDaftar'])->name('storePengumumanDaftar');
            Route::delete('/pengumuman/{id_pengumuman}', [GuruController::class, 'destroyPengumuman'])->name('deletePengumuman');
            Route::put('/pengumuman/{id_pengumuman}', [GuruController::class, 'updatePengumuman'])->name('updatePengumuman');

        });

        Route::get('/profileG', [GuruController::class, 'showProfileG'])->name('guru.profile');
    
        
    });


    Route::middleware('role:siswa')->group(function () {

        Route::prefix('tugas')->group(function () {
            Route::get('/mapel', [SiswaController::class, 'lihatTugasMapel'])->name('lihatTugasMapel');
            Route::get('/tugas-daftar/{id_mapel}', [SiswaController::class, 'lihatTugasDaftar'])->name('lihatTugasDaftar');
            Route::get('/lihat-soal/{namaFile}', [SiswaController::class, 'lihatSoal'])->name('lihatSoal');
            Route::post('/unggah-tugas', [SiswaController::class, 'unggahTugas'])->name('unggahTugas');
            Route::get('/unggah-tugas/{id_daftar_nilai_siswa}', [SiswaController::class, 'halamanUnggahTugas'])->name('halamanUnggahTugas');

            Route::get('/lihat-jawaban/{namaFile}', [SiswaController::class, 'lihatJawaban'])->name('lihatJawaban');
        });

        Route::prefix('materi')->group(function (){
            Route::get('/mapel', [SiswaController::class, 'lihatMateriMapel'])->name('lihatMateriMapel');
            Route::get('/lihat-materi/{id_materi}', [SiswaController::class, 'lihatDaftarMateri'])->name('lihatDaftarMateri');
            Route::get('/lihat-file-materi/{namaFile}', [SiswaController::class, 'lihatMateriS'])->name('lihatMateriS');
        });

        Route::prefix('nilai')->group(function () {
            Route::get('/mapel', [SiswaController::class, 'lihatNilaiMapel'])->name('lihatNilaiMapel');
            Route::get('/daftar-nilai/{id_mapel}', [SiswaController::class, 'lihatNilaiDaftar'])->name('lihatNilaiDaftar');

        });

        Route::prefix('absensi')->group(function () {
            Route::get('/mapel', [SiswaController::class, 'pilihMapelAbsensi'])->name('lihatAbsensi');
            Route::get('/lihat-absensi/{id_mapel}', [SiswaController::class, 'lihatAbsensiPerMapel'])->name('lihatAbsensi.perMapel');

        });
        Route::get('/lihat-jadwal', [SiswaController::class, 'lihatJadwalS'])->name('lihatJadwalS');

        Route::get('/krs', [SiswaController::class, 'KRS'])->name('KRS');

        Route::get('/lihat-acara', [SiswaController::class, 'lihatAcara'])->name('lihatAcaraSiswa');
        Route::get('/lihat-pengumuman', [SiswaController::class, 'lihatPengumuman'])->name('lihatPengumumanSiswa');

        // Rute untuk profil siswa
        Route::get('/profileS', [SiswaController::class, 'showProfileS'])->name('siswa.profile');

    });

    // Rute untuk menampilkan profil guru
    Route::get('/profil-guru/{id}', [GuruController::class, 'showProfile'])->name('profil_guru.guru');


    Route::fallback(function () {
        abort(404);
    });

});





####################################################################################################################
    // // Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    // Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // Route::get('/manajemen siswa', [AdminController::class, 'manajSiswa'])->name('manajemenSiswa');
    // Route::get('/tambah siswa', [AdminController::class, 'tambahSiswa'])->name('tambahSiswa');
    // Route::post('/tambah siswa', [AdminController::class, 'storeSiswa'])->name('storeSiswa');
    // Route::get('/', [LoginController::class, 'create'])->name('login');
    // Route::post('/', [LoginController::class, 'store']);

    // Route::get('/manajemen-guru', [AdminController::class, 'manajGuru'])->name('manajemenGuru');
    // Route::get('/tambah-guru', [AdminController::class, 'tambahGuru'])->name('tambahGuru');
    // Route::post('/tambah-guru', [AdminController::class, 'storeGuru'])->name('storeGuru');


    // Route::get('/manajemen-siswa', [AdminController::class, 'manajSiswa'])->name('manajemenSiswa');
    // Route::get('/tambah-siswa', [AdminController::class, 'tambahSiswa'])->name('tambahSiswa');
    // Route::post('/tambah-siswa', [AdminController::class, 'storeSiswa'])->name('storeSiswa');

    // Route::get('/manajemen-klien', [AdminDevController::class, 'manajKlien'])->name('manajemenKlien');
    // Route::get('/tambah-admin-klien', [AdminDevController::class, 'tambahKlien'])->name('tambahKlien');
    // Route::post('/tambah-admin-klien', [AdminDevController::class, 'storeAdmin'])->name('storeAdmin');

    // Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    // Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    ########################################################################################################################################
    // Route::get('/tambah-admin-klien/{id_sekolah}', [AdminDevController::class, 'tambahAdminKlien'])->name('tambahAdminKlien');
    // Route::post('/tambah-admin-klien/{id_sekolah}', [AdminDevController::class, 'storeAdmin'])->name('storeAdmin');

    // Route::get('/klien', [AdminDevController::class, 'daftarKlien'])->name('daftarKlien');
    // Route::get('/klien/{id_sekolah}', [AdminDevController::class, 'infoKlien'])->name('infoKlien');

    // Route::get('/tambah-klien', [AdminDevController::class, 'tambahKlien'])->name('tambahKlien');
    // Route::post('/tambah-klien', [AdminDevController::class, 'storeKlien'])->name('storeKlien');

    // Route::put('/info-klien/{id}', [AdminDevController::class, 'updateAdminKlien'])->name('updateAdminKlien');
    // Route::delete('/info-klien/{id}', [AdminDevController::class, 'destroyAdminKlien'])->name('destroyAdminKlien');

    // Route::put('/info-klien/update-klien/{id}', [AdminDevController::class, 'updateKlien'])->name('updateKlien');


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
#####################################################################################################################################################
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////