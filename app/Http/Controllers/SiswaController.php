<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\DaftarMateri;
use App\Models\DaftarAbsensiSiswa;
use App\Models\DaftarAcara;
use App\Models\DaftarNilaiSiswa;
use App\Models\DaftarPengumuman;
use App\Models\DaftarTugas;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function lihatTugasMapel (Request $request)
    {
        $idKelas = $request->cookie('id_kelas');
        $idSekolah = $request->cookie('id_sekolah');

        $daftarMapel = Jadwal::where('id_kelas', $idKelas)
                        ->with(['mapel.guru'])
                        ->with('kelas.angkatan')
                        ->where('id_sekolah', $idSekolah)
                        ->whereHas('kelas.angkatan', function ($query) {
                            $query->whereColumn('angkatans.semester', 'jadwals.semester');
                        })
                        ->whereHas('kelas.angkatan', function ($query) {
                            $query->whereColumn('angkatans.id_tingkat', 'jadwals.tingkat');
                        })
                        ->select('id_kelas', 'id_mapel') // hanya ambil kombinasi unik kelas+mapel
                        ->distinct()
                        ->get();

        return view('siswa.lihat_tugas_mapel', ['daftarMapel' => $daftarMapel]);
    }

    public function lihatTugasDaftar (Request $request, $idMapel)
    {
        $idSiswa = $request->cookie('id_user');
        $idSekolah = $request->cookie('id_sekolah');
        $idKelas = $request->cookie('id_kelas');
        // $idAngkatan = $request->cookie('id_angkatan');

        // $infoAngkatan = Angkatan::where('id_sekolah', $idSekolah)
        //                         ->where('id_angkatan', $idAngkatan)
        //                         ->first();

        $infoJadwal = Jadwal::where('id_kelas', $idKelas)
                        ->where('id_sekolah', $idSekolah)
                        ->where('id_mapel', $idMapel)
                        ->with('kelas.angkatan')
                        ->where('id_sekolah', $idSekolah)
                        ->whereHas('kelas.angkatan', function ($query) {
                            $query->whereColumn('angkatans.semester', 'jadwals.semester');
                        })
                        ->whereHas('kelas.angkatan', function ($query) {
                            $query->whereColumn('angkatans.id_tingkat', 'jadwals.tingkat');
                        })
                        ->with(['mapel'])
                        ->firstOrFail();


        $daftarTugas = DaftarNilaiSiswa::where('id_siswa', $idSiswa)
                        ->where('id_sekolah', $idSekolah)
                        ->where('id_kelas', $idKelas)
                        ->where('tingkat', $infoJadwal->kelas->angkatan->id_tingkat)
                        ->where('semester', $infoJadwal->kelas->angkatan->semester)
                        ->where('id_mapel', $idMapel)
                        ->with(['daftarNilai.tugas.mapel'])
                        ->whereHas('daftarNilai', function ($query) {
                            $query->where('sifat', 'online');
                        })
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('siswa.lihat_daftar_tugas', ['daftarTugas' => $daftarTugas, 'infoJadwal' => $infoJadwal]);
    
    }

    public function lihatSoal (Request $request, $namaFile)
    {
        $idSekolah = $request->cookie('id_sekolah');
        $idKelas = $request->cookie('id_kelas');
        $idAngkatan = $request->cookie('id_angkatan');

        $infoAngkatan = Angkatan::where('id_sekolah', $idSekolah)
                                ->where('id_angkatan', $idAngkatan)
                                ->first();


        DaftarTugas::where('nama_file', $namaFile)
                    ->where('id_sekolah', $idSekolah)
                    ->where('id_kelas', $idKelas)
                    ->where('tingkat', $infoAngkatan->id_tingkat)
                    ->where('semester', $infoAngkatan->semester)
                    ->firstOrFail();


        if (Storage::disk('local')->exists("tugas/$namaFile")) {
            $path = Storage::disk('local')->path("tugas/$namaFile");
            $headers = ['Content-Type' => 'application/pdf'];

            // Mengembalikan file sebagai respons inline
            return response()->file($path, $headers);
        }

        abort(404, 'File not found');

    }

    public function unggahTugas (Request $request)
    {
        // 1. Validasi request
        $request->validate([
            // 'id_daftar_nilai_siswa' => 'required|exists:daftar_nilai_siswas,id_daftar_nilai_siswa',
            'file' => 'required|file|mimes:pdf|max:10240', // PDF, max 10MB
        ], [
            'file.required' => 'Anda harus memilih file untuk diunggah.',
            'file.mimes' => 'File jawaban harus dalam format PDF.',
            'file.max' => 'Ukuran file maksimal adalah 10MB.',
        ]);

        $idSiswa = $request->cookie('id_user');
        $idDaftarNilaiSiswa = $request->input('id_daftar_nilai_siswa');

        // dd($idDaftarNilaiSiswa);

        // 2. Cari record tugas siswa yang sesuai
        $tugasSiswa = DaftarNilaiSiswa::where('id_daftar_nilai_siswa', $idDaftarNilaiSiswa)
                                      ->where('id_siswa', $idSiswa)
                                      ->firstOrFail();

        // dd($tugasSiswa);

        // // 3. Proses unggah file
        $file = $request->file('file');
        // Buat nama file yang unik: idsiswa_iddns_timestamp.extension
        $namaFile = time() . '_' . $file->getClientOriginalName();

        // dd($namaFile);
        
        // // Simpan file ke storage/app/jawaban_tugas
        $file->storeAs('tugasSiswa', $namaFile,);

        // // 4. Update nama file di database
        $tugasSiswa->update(['nama_fileTugas' => $namaFile]);

        return redirect()->route('lihatTugasDaftar', ['id_mapel' => $tugasSiswa->id_mapel])->with('success', 'Jawaban tugas berhasil diunggah!');


    }


        public function lihatJawaban (Request $request, $namaFile)
    {
        $idSekolah = $request->cookie('id_sekolah');
        $idKelas = $request->cookie('id_kelas');
        $idAngkatan = $request->cookie('id_angkatan');

        $infoAngkatan = Angkatan::where('id_sekolah', $idSekolah)
                                ->where('id_angkatan', $idAngkatan)
                                ->first();


        DaftarNilaiSiswa::where('nama_fileTugas', $namaFile)
                    ->where('id_sekolah', $idSekolah)
                    ->where('id_kelas', $idKelas)
                    ->where('tingkat', $infoAngkatan->id_tingkat)
                    ->where('semester', $infoAngkatan->semester)
                    ->firstOrFail();


        if (Storage::disk('local')->exists("tugasSiswa/$namaFile")) {
            $path = Storage::disk('local')->path("tugasSiswa/$namaFile");
            $headers = ['Content-Type' => 'application/pdf'];

            // Mengembalikan file sebagai respons inline
            return response()->file($path, $headers);
        }

        abort(404, 'File not found');

    }

    public function lihatJadwalS (Request $request)
    {
        $id_kelas = $request->cookie('id_kelas');
        $id_sekolah = $request->cookie('id_sekolah');
        
        $jadwals = Jadwal::with('kelas.angkatan', 'mapel.guru')
        ->whereHas('mapel', function ($query) use ($id_kelas) {
            $query->where('id_kelas', $id_kelas);
        })
        ->whereHas('kelas.angkatan', function ($query) use ($id_sekolah) {
            $query->where('id_sekolah', $id_sekolah);
        })
        ->whereHas('kelas.angkatan', function ($query) {
            $query->whereColumn('angkatans.semester', 'jadwals.semester');
        })
        ->whereHas('kelas.angkatan', function ($query) {
            // Filter Jadwal berdasarkan tingkat yang ada di relasi angkatan
            $query->whereColumn('angkatans.id_tingkat', 'jadwals.tingkat');
        })
        ->orderBy('hari') // Mengurutkan berdasarkan hari
        ->orderBy('jam_mulai') // Kemudian berdasarkan jam mulai
        ->get();

        return view('siswa.lihat_jadwalS', ['jadwals' => $jadwals]);
    }

    public function KRS (Request $request)
    {
        $id_kelas = $request->cookie('id_kelas');
        $id_sekolah = $request->cookie('id_sekolah');
        $id_user = $request->cookie('id_user');
        
        $user = User::where('id', $id_user)->first();

        $jadwals = Jadwal::with('kelas.angkatan.sekolah', 'mapel')
        ->whereHas('mapel', function ($query) use ($id_kelas) {
            $query->where('id_kelas', $id_kelas);
        })
        ->whereHas('kelas.angkatan', function ($query) use ($id_sekolah) {
            $query->where('id_sekolah', $id_sekolah);
        })
        ->whereHas('kelas.angkatan', function ($query) {
            $query->whereColumn('angkatans.semester', 'jadwals.semester');
        })
        ->whereHas('kelas.angkatan', function ($query) {
            // Filter Jadwal berdasarkan tingkat yang ada di relasi angkatan
            $query->whereColumn('angkatans.id_tingkat', 'jadwals.tingkat');
        })
        ->select('id_kelas', 'id_mapel') // hanya ambil kombinasi unik kelas+mapel
        ->distinct()
        // ->with('kelas.angkatan', 'mapel') // tetap load relasi
        ->get();

        $waliKelas = $jadwals->first()?->kelas?->wali_kelas;
        $sekolah = $jadwals->first()?->kelas?->angkatan?->sekolah?->nama_sekolah;
        $tingkat = $jadwals->first()?->kelas?->angkatan?->tingkat;
        $semester = $jadwals->first()?->kelas?->angkatan?->semester;


        $jumlahSKS = 0;
        foreach ($jadwals as $jadwal) {
            $jumlahSKS += $jadwal->mapel->sks;
        }


        // return view('debug', ['tes' => $jadwals]);
        return view('siswa.krs', ['jadwals' => $jadwals, 
                                            'user' => $user, 
                                            'waliKelas' => $waliKelas, 
                                            'sekolah' => $sekolah,
                                            'tingkat' => $tingkat,
                                            'semester' => $semester,
                                            'jumlahSKS' => $jumlahSKS
                                        ]);
    /**
     * Menampilkan halaman riwayat absensi untuk siswa yang sedang login.
     */
    }
    

    public function lihatMateriMapel (Request $request)
    {
        $idKelas = $request->cookie('id_kelas');
        $idSekolah = $request->cookie('id_sekolah');

        $daftarMapel = Jadwal::where('id_kelas', $idKelas)
                        ->where('id_sekolah', $idSekolah)
                        ->whereHas('kelas.angkatan', function ($query) {
                            $query->whereColumn('angkatans.semester', 'jadwals.semester');
                        })
                        ->whereHas('kelas.angkatan', function ($query) {
                            $query->whereColumn('angkatans.id_tingkat', 'jadwals.tingkat');
                        })
                        ->with(['mapel.guru'])
                        ->select('id_kelas', 'id_mapel') // hanya ambil kombinasi unik kelas+mapel
                        ->distinct()
                        ->get();

        return view('siswa.lihat_materi_mapel', ['daftarMapel' => $daftarMapel]);
    }


    public function lihatDaftarMateri(Request $request, $id_mapel)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        $id_angkatan = $request->cookie('id_angkatan');
        $id_kelas = $request->cookie('id_kelas');


        // Validasi apakah siswa terdaftar di kelas ini

        $infoJadwal = Jadwal::where('id_kelas', $id_kelas)
                        ->where('id_sekolah', $id_sekolah)
                        ->where('id_mapel', $id_mapel)
                        ->whereHas('kelas.angkatan', function ($query) {
                            $query->whereColumn('angkatans.semester', 'jadwals.semester');
                        })
                        ->whereHas('kelas.angkatan', function ($query) {
                            $query->whereColumn('angkatans.id_tingkat', 'jadwals.tingkat');
                        })
                        ->with(['mapel'])
                        ->firstOrFail();

        $daftarMateri = DaftarMateri::where('id_kelas', $id_kelas)
                                    ->where('id_mapel', $id_mapel)
                                    ->where('tingkat', $infoJadwal->kelas->angkatan->id_tingkat)
                                    ->where('semester', $infoJadwal->kelas->angkatan->semester)
                                    ->where('id_sekolah', $id_sekolah)
                                    ->with('mapel')
                                    ->orderBy('created_at', 'desc')
                                    ->get();
                                    

        return view('siswa.lihat_materi', compact('daftarMateri', 'infoJadwal'));
        // return view ('debug',['tes' => $daftarMateri]);
    }

    public function lihatMateriS (Request $request, $namaFile)
    {
        $idSekolah = $request->cookie('id_sekolah');
        $idKelas = $request->cookie('id_kelas');
        $idAngkatan = $request->cookie('id_angkatan');

        $infoAngkatan = Angkatan::where('id_sekolah', $idSekolah)
                                ->where('id_angkatan', $idAngkatan)
                                ->first();


        DaftarMateri::where('nama_file', $namaFile)
                    ->where('id_sekolah', $idSekolah)
                    ->where('id_kelas', $idKelas)
                    ->where('tingkat', $infoAngkatan->id_tingkat)
                    ->where('semester', $infoAngkatan->semester)
                    ->firstOrFail();


        if (Storage::disk('local')->exists("materi/$namaFile")) {
            $path = Storage::disk('local')->path("materi/$namaFile");
            $headers = ['Content-Type' => 'application/pdf'];

            // Mengembalikan file sebagai respons inline
            return response()->file($path, $headers);
        }

        abort(404, 'File not found');

    }

    /**
     * Menampilkan halaman untuk memilih mata pelajaran sebelum melihat absensi.
     */
    public function pilihMapelAbsensi(Request $request)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        $id_kelas = $request->cookie('id_kelas');

        // Ambil semua mapel yang diajarkan di kelas siswa pada semester & tingkat aktif
        $daftarMapel = Jadwal::where('id_kelas', $id_kelas)
            ->where('id_sekolah', $id_sekolah)
            ->whereHas('kelas.angkatan', function ($query) {
                $query->whereColumn('angkatans.semester', 'jadwals.semester');
            })
            ->whereHas('kelas.angkatan', function ($query) {
                $query->whereColumn('angkatans.id_tingkat', 'jadwals.tingkat');
            })
            ->with('mapel.guru')
            ->select('id_mapel')
            ->distinct()
            ->get();

        return view('siswa.pilih_mapel_absensi', compact('daftarMapel'));
    }


    /////////////////////////////////lihat nilai///////////////////////////////////////////////////
    public function lihatNilaiMapel(Request $request)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        $id_kelas = $request->cookie('id_kelas');
        $id_angkatan = $request->cookie('id_angkatan');

        // Ambil info angkatan untuk mendapatkan semester & tingkat aktif
        // $infoAngkatan = Angkatan::where('id_angkatan', $id_angkatan)
        //                         ->where('id_sekolah', $id_sekolah)
        //                         ->first();

        // Mengambil daftar mapel yang unik untuk kelas siswa yang sedang login
        // berdasarkan jadwal yang ada.
        $daftarMapel = Jadwal::where('id_kelas', $id_kelas)
            ->where('id_sekolah', $id_sekolah)
            ->whereHas('kelas.angkatan', function ($query) {
                $query->whereColumn('angkatans.semester', 'jadwals.semester');
            })
            ->whereHas('kelas.angkatan', function ($query) {
                $query->whereColumn('angkatans.id_tingkat', 'jadwals.tingkat');
            })
            ->with('mapel.guru')
            ->select('id_mapel', 'id_kelas')
            ->distinct()
            ->get();

        return view('siswa.lihatmapelnilai', ['daftarMapel' => $daftarMapel]);
    }

    /**
     * Menampilkan riwayat absensi untuk satu mata pelajaran.
     */
    public function lihatAbsensiPerMapel(Request $request, $id_mapel)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        $id_siswa = $request->cookie('id_user');
        $id_kelas = $request->cookie('id_kelas');


        $infoJadwal = Jadwal::where('id_kelas', $id_kelas)
                        ->where('id_sekolah', $id_sekolah)
                        ->where('id_mapel', $id_mapel)
                        ->whereHas('kelas.angkatan', function ($query) {
                            $query->whereColumn('angkatans.semester', 'jadwals.semester');
                        })
                        ->whereHas('kelas.angkatan', function ($query) {
                            $query->whereColumn('angkatans.id_tingkat', 'jadwals.tingkat');
                        })
                        ->with(['mapel'])
                        ->firstOrFail();


        $daftarAbsensi = DaftarAbsensiSiswa::where('id_siswa', $id_siswa)
            ->where('id_sekolah', $id_sekolah)
            ->where('id_mapel', $id_mapel)
            ->where('tingkat', $infoJadwal->kelas->angkatan->id_tingkat)
            ->where('semester', $infoJadwal->kelas->angkatan->semester)
            ->where('id_kelas', $id_kelas)
            ->with(['mapel', 'daftarAbsensi'])
            ->latest('created_at')
            ->get();

        $infoMapel = Mapel::find($id_mapel);

        return view('siswa.lihat_absensi_per_mapel', compact('daftarAbsensi', 'infoMapel'));
    }
    //     return view('siswa.lihatmapelnilai', ['mapelList' => $mapelList]);
    // }

    /**
     * Menampilkan detail nilai untuk mata pelajaran tertentu.
     * Corresponds to: nilai_detail_mapel.blade.php
     *
     * @param int $id_mapel ID Mata Pelajaran yang dipilih.
     * @return \Illuminate\View\View
     */
    public function lihatNilaiDaftar(Request $request, $id_mapel)
    {
        $id_siswa = $request->cookie('id_user');
        $id_sekolah = $request->cookie('id_sekolah');
        $id_kelas = $request->cookie('id_kelas');

        $infoJadwal = Jadwal::where('id_kelas', $id_kelas)
                        ->where('id_sekolah', $id_sekolah)
                        ->where('id_mapel', $id_mapel)
                        ->whereHas('kelas.angkatan', function ($query) {
                            $query->whereColumn('angkatans.semester', 'jadwals.semester');
                        })
                        ->whereHas('kelas.angkatan', function ($query) {
                            $query->whereColumn('angkatans.id_tingkat', 'jadwals.tingkat');
                        })
                        ->with(['mapel'])
                        ->firstOrFail();

        // Menggunakan join untuk membandingkan kolom antar tabel
        $daftarNilai = DaftarNilaiSiswa::where('id_siswa', $id_siswa)
                    ->where('id_sekolah', $id_sekolah)
                    ->where('id_mapel', $id_mapel)
                    ->where('tingkat', $infoJadwal->kelas->angkatan->id_tingkat)
                    ->where('semester', $infoJadwal->kelas->angkatan->semester)
                    ->where('id_kelas', $id_kelas)
                    ->with(['mapel', 'daftarNilai'])
                    ->latest('created_at')
                    ->get();

        $nama_mapel = $daftarNilai->first()->mapel->nama_mapel ?? 'Belum ada Nilai';

        return view('siswa.lihatnilai', ['daftarNilai' => $daftarNilai, 'nama_mapel' => $nama_mapel]);
    }

    public function lihatAcara(Request $request)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        // Ambil acara hanya 1 minggu setelah acara selesai
        $daftarAcara = DaftarAcara::where('id_sekolah', $id_sekolah)
                        ->where('tanggal_selesai', '>=', Carbon::now()->subWeeks(1))
                        ->orderBy('tanggal_mulai', 'desc')
                        ->get();

        return view('siswa.lihat_acara_siswa', compact('daftarAcara'));
    }
////////////////////////////////lihat pengumuman/////////////////////////////////////////////
    public function lihatPengumuman(Request $request)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        $id_kelas = $request->cookie('id_kelas');

        // Ambil semua ID mapel yang diajarkan di kelas siswa
        $mapelIds = Jadwal::where('id_kelas', $id_kelas)
                          ->where('id_sekolah', $id_sekolah)
                          ->pluck('id_mapel')->unique();

        // Ambil pengumuman yang relevan (berdasarkan id_sekolah, id_kelas, dan id_mapel)
        $DaftarPengumuman = DaftarPengumuman::where('id_sekolah', $id_sekolah)
            ->where('id_kelas', $id_kelas)
            ->whereIn('id_mapel', $mapelIds)
            ->where('created_at', '>=', Carbon::now()->subWeeks(1))
            ->with('mapel') // Eager load relasi mapel untuk efisiensi
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.lihat_pengumuman', ['DaftarPengumuman' => $DaftarPengumuman]);
    }

    /**
     * Menampilkan halaman profil siswa.
     */
    public function showProfileS(Request $request)
    {
        $user = Auth::user();
        return view('siswa.profil', compact('user'));
    }

}