<?php

namespace App\Http\Controllers;

use App\Models\RiwayatKeuangan;
use App\Models\User; // Menggunakan model User untuk Siswa dan Guru
use App\Models\Angkatan;
use App\Models\DaftarAcara;
use App\Models\DaftarKurikulum;
use App\Models\DaftarNilai;
use App\Models\DaftarNilaiSiswa;
use App\Models\DaftarAbsensiSiswa;
use App\Models\Kelas;
use App\Models\PmabayaranSiswa;
use App\Models\DaftarTagihan;
use App\Models\Jadwal;
use App\Models\Mapel;
use App\Models\Tingkat;
use App\Models\Teacher; // Jika ini model terpisah untuk guru, mungkin tidak diperlukan jika semua dihandle User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    /**
     * Menampilkan halaman untuk menambah pengguna baru.
     *
     * @return \Illuminate\View\View
     */

    public function manajSiswa(Request $request)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        $search = $request->query('search');

        // Memulai query untuk model User
        $query = User::select('users.*') // Pilih semua kolom dari tabel users untuk menghindari konflik
            ->leftJoin('kelas', 'users.id_kelas', '=', 'kelas.id_kelas')
            ->leftJoin('angkatans', 'kelas.id_angkatan', '=', 'angkatans.id_angkatan')
            ->where('users.role', 'siswa')
            ->where('users.id_sekolah', $id_sekolah)
            ->with('kelas.angkatan') // Eager load tetap diperlukan untuk menampilkan data relasi di view
            ->orderBy('angkatans.is_alumni', 'asc') // Urutkan berdasarkan kolom is_alumni dari tabel angkatans
            ->orderBy('users.created_at', 'desc'); // Tambahkan urutan sekunder jika diperlukan

        // Jika ada input pencarian, tambahkan kondisi where
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', '%' . $search . '%')
                  ->orWhere('users.nisn_nik', 'like', '%' . $search . '%')
                  ->orWhereHas('kelas.angkatan', function ($subQuery) use ($search) {
                      $subQuery->where('angkatan', 'like', '%' . $search . '%');
                  });
            });
        }

        $students = $query->paginate(10)->appends(['search' => $search]);
        return view('admin.manajemen_siswa', ['students' => $students, 'search' => $search]);
    }

    public function tambahSiswa()
    {
        return view('admin.tambah_siswa');
    }



    
    public function manajGuru(Request $request)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        $search = $request->input('search');

        // Menggunakan whereIn untuk mengambil pengguna dengan role 'guru' atau 'staf'
        $query = User::whereIn('role', ['guru', 'staf'])
                     ->where('id_sekolah', $id_sekolah);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('no_telp', 'like', "%{$search}%");
            });
        }

        $teachers = $query->latest()->paginate(10)->appends(['search' => $search]);
        return view('admin.manajemen_guru', ['teachers' => $teachers, 'search' => $search]);
    }




    public function tambahGuru()
    {
        return view('admin.tambah_guru');
    }




    public function storeSiswa(Request $request)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        $validator = Validator::make($request->all(), [
            'students' => 'required|array|min:1',
            'students.*.nisn' => 'required|string|distinct|unique:users,nisn_nik',
            'students.*.username' => 'required|string|distinct|unique:users,username',
            'students.*.nama' => 'required|string|max:255',
            'students.*.gender' => 'required|in:Laki-laki,Perempuan',
            'students.*.password' => 'required|string|min:6',
            'students.*.address' => 'nullable|string|max:255',
            'students.*.birthplace' => 'nullable|string|max:100',
            'students.*.dob' => 'nullable|date',
            'students.*.entry_date' => 'nullable|date',
            'students.*.parent_name' => 'nullable|string|max:255',
            'students.*.parent_phone' => 'nullable|string|max:20',
            'students.*.siblings_count' => 'nullable|integer',
            'students.*.parent_salary' => 'nullable|string|max:50', // Menggunakan string untuk fleksibilitas format
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($request->input('students', []) as $studentData) {
            // Memastikan field wajib ada sebelum membuat user
            if (isset($studentData['nama'], $studentData['nisn'], $studentData['username'], $studentData['gender'], $studentData['password'])) {
                User::create([
                    'name'              => $studentData['nama'],
                    'email'             => $studentData['username'] . '@sekolah.sch.id', // Membuat email unik
                    'password'          => $studentData['password'], // Eloquent akan mengenkripsi ini secara otomatis
                    'nisn_nik'          => $studentData['nisn'],
                    'jenis_kelamin'     => $studentData['gender'],
                    'username'          => $studentData['username'],
                    'role'              => 'siswa', // Otomatis mengatur role sebagai siswa
                    'id_sekolah'        => $id_sekolah,
                    
                    // Menambahkan field baru
                    'alamat'            => $studentData['address'],
                    'tempat_lahir'      => $studentData['birthplace'],
                    'tanggal_lahir'     => $studentData['dob'],
                    'tanggal_masuk'     => $studentData['entry_date'] ,
                    'nama_orang_tua'         => $studentData['parent_name'],
                    'no_telp'      => $studentData['parent_phone'],
                    'jumlah_sodara'    => $studentData['siblings_count'],
                    'gaji_orang_tua'         => $studentData['parent_salary'],
                ]);
            }
        }

        return redirect()->route('manajemenSiswa')->with('success', 'Data siswa berhasil ditambahkan!');
    }





    public function storeGuru(Request $request)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        $validator = Validator::make($request->all(), [
            'teacher'          => 'required|array|min:1',
            'teacher.*.nik'    => 'required|string|distinct|unique:users,nisn_nik',
            'teacher.*.username' => 'required|string|distinct|unique:users,username',
            'teacher.*.nama'     => 'required|string|max:255',
            'teacher.*.password' => 'required|string|min:6',
            'teacher.*.alamat' => 'nullable|string|max:255',
            'teacher.*.tempat_lahir' => 'nullable|string|max:100',
            'teacher.*.tanggal_lahir' => 'nullable|date',
            'teacher.*.nomor_telp' => 'nullable|string|max:15',
            'teacher.*.jabatan' => 'required|string|in:guru,staf', // 'jabatan' dari form akan menjadi 'role'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($request->input('teacher', []) as $teacherData) {
            // Pastikan semua data yang diperlukan ada sebelum membuat user
            if (isset($teacherData['nama'], $teacherData['nik'], $teacherData['password'], $teacherData['username'])) {
                User::create([
                    'name'          => $teacherData['nama'],
                    'email'         => $teacherData['username'] . '@sekolah.sch.id', // Membuat email unik
                    'password'      => $teacherData['password'], // Eloquent akan mengenkripsi ini secara otomatis
                    'nisn_nik'      => $teacherData['nik'],
                    'username'      => $teacherData['username'],
                    'role'          => $teacherData['jabatan'], // Menggunakan 'jabatan' dari form sebagai 'role'
                    'id_sekolah'    => $id_sekolah,
                    'alamat'        => $teacherData['alamat'],
                    'tempat_lahir'  => $teacherData['tempat_lahir'],
                    'tanggal_lahir' => $teacherData['tanggal_lahir'],
                    'no_telp'       => $teacherData['nomor_telp'],
                ]);
            }
        }

        return redirect()->route('manajemenGuru')->with('success', 'Data guru/staf berhasil ditambahkan!');
    }




    public function manajAngkatan(Request $request)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        // Mengambil semua data dari tabel angkatan, diurutkan dari yang terbaru
        $angkatans = Angkatan::where('id_sekolah', $id_sekolah)->latest()->get();
        $tingkats = Tingkat::where('id_sekolah', $id_sekolah)->get();
        return view('admin.manajemen_angkatan', ['angkatans' => $angkatans, 'tingkats' => $tingkats]);
        // return view('admin.manajemen_angkatan');
    }

    public function storeAngkatan(Request $request)
    {   
        $id_sekolah = $request->cookie('id_sekolah');

        $request->validate([
            'angkatan' => [
                'required',
                'string',
                'max:255',
                Rule::unique('angkatans', 'angkatan')
                    ->where('id_sekolah', $request->cookie('id_sekolah'))
            ],
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date'
        ], [
            'angkatan.required' => 'Tahun ajaran tidak boleh kosong.',
            'angkatan.unique' => 'Tahun ajaran ini sudah ada di sekolah Anda.',
        ]);

        // Buat entri baru di tabel angkatan
        Angkatan::create([
            'angkatan' => $request->angkatan,
            'id_sekolah' => $id_sekolah,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'id_tingkat' => $request->id_tingkat,
            'tingkat' => Tingkat::where('id_tingkat', $request->id_tingkat)->value('tingkat'),
        ]);

        // Arahkan kembali ke halaman manajemen angkatan dengan pesan sukses
        return redirect()->route('manajemenAngkatan')->with('success', 'Angkatan berhasil ditambahkan!');
    }




    public function manajKelas()
    {
        $id_sekolah = request()->cookie('id_sekolah');

        $angkatans = Angkatan::where('id_sekolah', $id_sekolah)->where('id_sekolah', $id_sekolah)
                    ->whereNotNull('id_tingkat')
                    ->latest()->get();

        $kelas = Kelas::where('id_sekolah', $id_sekolah)
                    ->with('angkatan')
                    ->whereHas('angkatan', function ($query) {
                        $query->whereNotNull('id_tingkat');
                    })//filter alumni
                    ->get();

        return view('admin.manajemen_kelas', ['angkatans' => $angkatans, 'kelasList' => $kelas]);
    }

    public function storeKelas(Request $request)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'id_angkatan' => 'required|integer',
            'wali_kelas' => 'required|string|max:255',
            'jurusan' => 'nullable|string|max:20'
        ], [
            'nama_kelas.required' => 'Nama kelas tidak boleh kosong.',
            'id_angkatan.required' => 'Tahun ajaran tidak boleh kosong, buat angkatan terlebih dahulu',
            'wali_kelas.required' => 'Wali kelas tidak boleh kosong.',
            'jurusan.max' => 'Jurusan maksimal 20 karakter.'
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'id_angkatan' => $request->id_angkatan,
            'id_sekolah' => $id_sekolah,
            'wali_kelas' => $request->wali_kelas,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('manajemenKelas')->with('success', 'Kelas berhasil ditambahkan!');

    }



    // PERBAIKAN: Menerima $id_kelas langsung dari parameter route
    public function lihatKelas(Request $request, $id_kelas)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        
        $infoKelas = Kelas::where('id_kelas', $id_kelas)
                        ->where('id_sekolah', $id_sekolah)
                        ->with('angkatan')
                        ->whereHas('angkatan', function ($query) {
                            $query->whereNotNull('id_tingkat');
                        }) //filter alumni
                        ->firstOrFail();

        $daftarSiswa = User::where('id_kelas', $id_kelas)->where('id_sekolah', $id_sekolah)->get();
        $daftarSiswaBelumPunyaKelas = User::where('id_kelas', null)->where('id_sekolah', $id_sekolah)->where('role', 'siswa')->get();
        $jumlahSiswa = $daftarSiswa->count();
        
        return view('admin.lihat_kelas', ['id_kelas' => $id_kelas,'infoKelas' => $infoKelas, 'daftarSiswa' => $daftarSiswa, 'daftarSiswaBelumPunyaKelas' => $daftarSiswaBelumPunyaKelas, 'jumlahSiswa' => $jumlahSiswa]);
    }

    

    public function tambahSiswaKeKelas(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'id_kelas' => 'required|integer|exists:kelas,id_kelas',
            'siswa_ids' => 'required|array|min:1',
            'siswa_ids.*' => 'integer|exists:users,id', // Pastikan setiap ID siswa ada di tabel users
        ], [
            'id_kelas.required' => 'ID Kelas tidak valid.',
            'siswa_ids.required' => 'Anda harus memilih setidaknya satu siswa.',
        ]);

        $id_kelas = $request->input('id_kelas');
        $id_kelass = Kelas::where('id_kelas', $id_kelas)
                        ->where('id_sekolah', $request->cookie('id_sekolah'))
                        ->with('angkatan')
                        ->whereHas('angkatan', function ($query) {
                            $query->whereNotNull('id_tingkat');
                        }) //filter alumni
                        ->firstOrFail();
                        
        $siswa_ids = $request->input('siswa_ids');

        // 2. Update id_kelas untuk semua siswa yang dipilih
        User::whereIn('id', $siswa_ids)->update(['id_kelas' => $id_kelass->id_kelas, 'id_angkatan' => $id_kelass->id_angkatan]);

        // 3. Redirect kembali ke halaman sebelumnya dengan pesan sukses
        // return back()->with('success', 'Siswa berhasil ditambahkan ke kelas!');
        return redirect()->route('manajemenKelas')->with('success', 'Siswa berhasil ditambahkan ke kelas!');
    }

    public function manajKeuangan()
    {
        $id_sekolah = request()->cookie('id_sekolah');

        // Mengambil semua transaksi diurutkan berdasarkan tanggal terlama untuk grafik
        $transaksi = RiwayatKeuangan::where('id_sekolah', $id_sekolah)
            ->orderBy('tanggal', 'asc') // Diubah ke 'asc' untuk urutan grafik yang benar
            ->get();

        // Menghitung total pemasukan dan pengeluaran untuk sekolah terkait
        $totalPemasukan = RiwayatKeuangan::where('id_sekolah', $id_sekolah)->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = RiwayatKeuangan::where('id_sekolah', $id_sekolah)->where('jenis', 'pengeluaran')->sum('jumlah');
        
        // Mengambil saldo terakhir dari transaksi paling baru
        $saldo = $transaksi->last()->saldo ?? 0;

        // Mengambil data tanggal untuk label dan saldo untuk data grafik
        $labels = $transaksi->pluck('tanggal')->map(function ($tanggal) {
            return Carbon::parse($tanggal)->format('Y-m-d');
        });
        $saldoKumulatifData = $transaksi->pluck('saldo');

        return view('admin.keuangan', compact('transaksi', 'totalPemasukan', 'totalPengeluaran', 'saldo', 'labels', 'saldoKumulatifData'));
    }


    public function storePemasukan(Request $request)
    {
        $id_sekolah = request()->cookie('id_sekolah');

        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0.01',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'tanggal.required' => 'Tanggal tidak boleh kosong.',
            'jumlah.required' => 'Jumlah tidak boleh kosong.',
            'jumlah.numeric' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah harus lebih besar dari 0.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
        ]);

        // Ambil saldo terakhir
        $lastTransaction = RiwayatKeuangan::where('id_sekolah', $id_sekolah)->orderBy('tanggal', 'desc')->first();
        $lastSaldo = $lastTransaction ? $lastTransaction->saldo : 0;

        // Hitung saldo baru
        $newSaldo = $lastSaldo + $request->jumlah;

        // Simpan transaksi pemasukan baru
        RiwayatKeuangan::create([
            'id_sekolah' => $id_sekolah,
            'tanggal' => $request->tanggal,
            'jenis' => 'pemasukan',
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'saldo' => $newSaldo,
        ]);

        return redirect()->route('manajemenKeuangan')->with('success', 'Pemasukan berhasil ditambahkan!');
    }

    public function storePengeluaran(Request $request)
    {
        $id_sekolah = request()->cookie('id_sekolah');

        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0.01',
            'keterangan' => 'nullable|string|max:255',
        ], [
            'tanggal.required' => 'Tanggal tidak boleh kosong.',
            'jumlah.required' => 'Jumlah tidak boleh kosong.',
            'jumlah.numeric' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah harus lebih besar dari 0.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
        ]);

        // Ambil saldo terakhir
        $lastTransaction = RiwayatKeuangan::where('id_sekolah', $id_sekolah)->orderBy('tanggal', 'desc')->first();
        $lastSaldo = $lastTransaction ? $lastTransaction->saldo : 0;

        // Hitung saldo baru
        $newSaldo = $lastSaldo - $request->jumlah;

        // Simpan transaksi pengeluaran baru
        RiwayatKeuangan::create([
            'id_sekolah' => $id_sekolah,
            'tanggal' => $request->tanggal,
            'jenis' => 'pengeluaran',
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'saldo' => $newSaldo,
        ]);

        return redirect()->route('manajemenKeuangan')->with('success', 'Pengeluaran berhasil ditambahkan!');
    }

    public function tagihanSiswa()
    {
        $id_sekolah = request()->cookie('id_sekolah');
        $angkatans = Angkatan::where('id_sekolah', $id_sekolah)->latest()->get();
        $daftarTagihan = DaftarTagihan::where('id_sekolah', $id_sekolah)->latest()->get();
        return view('admin.tagihan_siswa', ['daftarTagihan' => $daftarTagihan, 'angkatans' => $angkatans]);
    }

    public function storeTagihan(Request $request)
    {
        $id_sekolah = request()->cookie('id_sekolah');

        $request->validate([
            'jumlah_tagihan' => 'required|numeric|min:0.01',
            'jatuh_tempo' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            // 'target_angkatan' => 'required|string|exists:angkatans,angkatan,id_sekolah,' . $id_sekolah,
        ], [
            'jumlah_tagihan.required' => 'Jumlah tagihan tidak boleh kosong.',
            'jumlah_tagihan.numeric' => 'Jumlah tagihan harus berupa angka.',
            'jumlah_tagihan.min' => 'Jumlah tagihan harus lebih besar dari 0.',
            'jatuh_tempo.required' => 'Jatuh tempo tidak boleh kosong.',
            'jatuh_tempo.date' => 'Jatuh tempo harus berupa tanggal yang valid.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
            // 'target_angkatan.required' => 'Target angkatan tidak boleh kosong.',
            // 'target_angkatan.exists' => 'Target angkatan tidak valid.',
        ]);

        // 1. Buat tagihan baru dan simpan hasilnya ke dalam variabel.
        // Ini lebih aman daripada menggunakan latest()->first() setelahnya.
        $daftarTagihan = DaftarTagihan::create([
            'id_sekolah' => $id_sekolah,
            'jumlah_tagihan' => $request->jumlah_tagihan,
            'jatuh_tempo' => $request->jatuh_tempo,
            'keterangan' => $request->keterangan,
            'target_angkatan' => $request->target_angkatan,
            'nama_angkatan' => Angkatan::where('id_angkatan', $request->target_angkatan)->where('id_sekolah', $id_sekolah)->value('angkatan'),
        ]);

        // 2. Ambil semua siswa yang menjadi target tagihan.
        // Menggunakan 'pluck('id')' lebih efisien jika hanya butuh ID, tapi di sini kita butuh objeknya.
        $targetSiswa = User::where('id_angkatan', $request->target_angkatan)
                            ->where('id_sekolah', $id_sekolah)
                            ->get();

        // 3. Lakukan perulangan untuk membuat entri pembayaran untuk setiap siswa.
        foreach($targetSiswa as $siswa){
            PmabayaranSiswa::create([
                'id_siswa' => $siswa->id,
                'id_sekolah' => $id_sekolah,
                'id_daftar_tagihan' => $daftarTagihan->id_daftar_tagihan, // Gunakan ID dari tagihan yang baru dibuat.
                'jumlah_tagihan' => $request->jumlah_tagihan,
                'status_pembayaran' => 'belum lunas', // Sesuai dengan ENUM di migrasi ('lunas', 'belum lunas').
            ]);
        }

        return redirect()->route('tagihanSiswa')->with('success', 'Tagihan berhasil ditambahkan!');
    }


    public function pembayaranTagihansiswa(Request $request)
    {
        $id_daftar_tagihan = $request->input('id_daftar_tagihan');
        $id_sekolah = request()->cookie('id_sekolah');

        // Mengambil data siswa yang belum membayar menggunakan join
        $belumMembayar = User::join('pmabayaran_siswas', 'users.id', '=', 'pmabayaran_siswas.id_siswa')
            ->where('pmabayaran_siswas.id_sekolah', $id_sekolah)
            ->where('pmabayaran_siswas.id_daftar_tagihan', $id_daftar_tagihan)
            ->where('pmabayaran_siswas.status_pembayaran', 'belum lunas')
            ->select('users.name', 'users.nisn_nik')
            ->get();

        // Mengambil data siswa yang sudah membayar menggunakan join
        $sudahMembayar = User::join('pmabayaran_siswas', 'users.id', '=', 'pmabayaran_siswas.id_siswa')
            ->where('pmabayaran_siswas.id_sekolah', $id_sekolah)
            ->where('pmabayaran_siswas.id_daftar_tagihan', $id_daftar_tagihan)
            ->where('pmabayaran_siswas.status_pembayaran', 'lunas')
            ->select('users.name', 'users.nisn_nik', 'pmabayaran_siswas.updated_at')
            ->get();

        return view('admin.pembayaran_tagihan', [
            'sudahMembayar' => $sudahMembayar, 
            'belumMembayar' => $belumMembayar
        ]);
    }

    public function manajMapel(Request $request)
    {
        $id_sekolah = request()->cookie('id_sekolah');
        $teachers = User::where('role', 'guru')
            ->where('id_sekolah', $id_sekolah)
            ->get();

        $search = $request->query('search');

        $query = Mapel::with('guru')
            ->where('id_sekolah', $id_sekolah)
            ->orderByRaw("CASE WHEN status = 'aktif' THEN 1 ELSE 2 END"); // urutkan status aktif duluan

        // Jika ada pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('guru', function ($g) use ($search) {
                    $g->where('name', 'like', "%{$search}%")
                    ->orWhere('nisn_nik', 'like', "%{$search}%");
                })
                ->orWhere('kode_mapel', 'like', "%{$search}%")
                ->orWhere('nama_mapel', 'like', "%{$search}%")
                ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        // Gunakan paginate di akhir
        // $mapels = $query->paginate(10);


        $mapels = $query->paginate(10)->appends(['search' => $search]);
        // return view('admin.manajemen_siswa', ['students' => $students, 'search' => $search]);
        
        return view('admin.manajemen_mapel', ['mapels' => $mapels, 'teachers' => $teachers, 'search' => $search]);

    }

    public function storeMapel(Request $request)
    {
        $id_sekolah = request()->cookie('id_sekolah');

        $request->validate([
            'kode_mapel' => 'required|string|max:20|unique:mapels,kode_mapel,NULL,id_mapel,id_sekolah,' . $id_sekolah,
            'nama_mapel' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'sks' => 'required|integer|min:1',
            'guru_pengampu' => 'nullable|exists:users,id',
        ], [
            'kode_mapel.required' => 'Kode mata pelajaran tidak boleh kosong.',
            'kode_mapel.unique' => 'Kode mata pelajaran ini sudah ada.',
            'nama_mapel.required' => 'Nama mata pelajaran tidak boleh kosong.',
            'kategori.required' => 'Kategori mata pelajaran tidak boleh kosong.',
            'sks.required' => 'SKS tidak boleh kosong.',
            'sks.integer' => 'SKS harus berupa angka.',
            'sks.min' => 'SKS harus minimal 1.',
            'guru_pengampu.exists' => 'Guru pengampu tidak valid.',
        ]);


        Mapel::create([
            'id_sekolah' => $id_sekolah,
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'kategori' => $request->kategori,
            'sks' => $request->sks,
            'id_guru' => $request->guru_id,
            'status' => 'aktif', // Tambahkan ini agar status defaultnya aktif
        ]);

        return redirect()->route('manajemenMapel')->with('success', 'Mata pelajaran berhasil ditambahkan!');    

    }


    public function manajJadwal(){
        $id_sekolah = request()->cookie('id_sekolah');

        // Menggunakan whereHas untuk memfilter Kelas berdasarkan kondisi pada relasi angkatan.
        // Di sini, kita mengambil kelas yang angkatannya memiliki id_tingkat bukan alumni(bukan null).
        $kelaslist = Kelas::where('id_sekolah', $id_sekolah)
                        ->with('angkatan')
                        ->whereHas('angkatan', function ($query) {
                            $query->whereNotNull('id_tingkat');
                        }) //filter alumni
                        ->get();

        return view('admin.manajemen_jadwal', ['kelasList' => $kelaslist]);
    }

    public function tambahJadwal(Request $request ,int $id_kelas){
        $id_sekolah = $request->cookie('id_sekolah');

        // Menggunakan firstOrFail untuk menangani kasus jika kelas tidak ditemukan
        // dan with('angkatan') untuk eager loading, mengurangi jumlah query.
        $kelas = Kelas::with('angkatan')
                      ->where('id_kelas', $id_kelas)
                      ->where('id_sekolah', $id_sekolah)
                      ->whereHas('angkatan', function ($query) {
                        $query->whereNotNull('id_tingkat');
                         })//filter alumni
                      ->firstOrFail(); // Akan melempar 404 Not Found jika kelas tidak ada

        // Mengambil semester dari relasi angkatan yang sudah di-load, bukan query baru.
        $semesterAktif = $kelas->angkatan->semester ?? null;
        $tingkatAktif = $kelas->angkatan->id_tingkat ?? null;

        // Mengambil semua mapel yang tersedia untuk sekolah ini untuk form tambah jadwal.
        $mapels = Mapel::with('guru')
                    ->where('id_sekolah', $id_sekolah)
                    ->where('status', 'aktif')
                    ->get();

        $jadwals = Jadwal::with('mapel.guru') // Memuat relasi mapel, dan relasi guru di dalam mapel
                        ->where('id_kelas', $id_kelas)
                        ->where('id_sekolah', $id_sekolah)
                        ->where('semester', $semesterAktif) // Hanya jadwal untuk semester aktif
                        ->where('tingkat', $tingkatAktif) // Hanya jadwal untuk tingkat aktif
                        ->orderBy('hari') // Mengurutkan berdasarkan hari
                        ->orderBy('jam_mulai') // Kemudian berdasarkan jam mulai
                        ->get();

        // Mengirimkan data yang diperlukan ke view.
        return view('admin.tambah_jadwal', ['kelas' => $kelas, 'jadwals' => $jadwals, 'mapels' => $mapels,]);
    }

    public function storeJadwal(Request $request, int $id_kelas)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        $request->validate([
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'id_mapel' => 'required|exists:mapels,id_mapel',
            'ruangan' => 'required|string|nullable|string|max:100',
        ], [
            'hari.required' => 'Hari tidak boleh kosong.',
            'hari.in' => 'Hari tidak valid.',
            'jam_mulai.required' => 'Jam mulai tidak boleh kosong.',
            'jam_mulai.date_format' => 'Format jam mulai tidak valid. Gunakan format HH:MM.',
            'jam_selesai.required' => 'Jam selesai tidak boleh kosong.',
            'jam_selesai.date_format' => 'Format jam selesai tidak valid. Gunakan format HH:MM.',
            'id_mapel.required' => 'Mata pelajaran tidak boleh kosong.',
            'id_mapel.exists' => 'Mata pelajaran tidak valid.',
            'ruangan.max' => 'ruangan maksimal 100 karakter.',
            'ruangan.required' => 'ruangan tidak boleh kosong.',
        ]);

        $infoAngkatan = Kelas::with('angkatan')
                      ->where('id_kelas', $id_kelas)
                      ->where('id_sekolah', $id_sekolah)
                      ->whereHas('angkatan', function ($query) {
                        $query->whereNotNull('id_tingkat');
                         })//filter alumni
                      ->firstOrFail(); // Akan melempar 404 Not Found jika kelas tidak ada

        Jadwal::create([
            'id_sekolah' => $id_sekolah,
            'id_kelas' => $id_kelas,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'id_mapel' => $request->id_mapel,
            'semester' => $infoAngkatan->angkatan->semester,
            'tingkat' => $infoAngkatan->angkatan->id_tingkat,
            'ruangan' => $request->ruangan,
        ]);
        return redirect()->route('tambahJadwal', ['id_kelas' => $id_kelas])->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function updateJadwal(Request $request, int $id_jadwal)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        $request->validate([
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'id_mapel' => 'required|exists:mapels,id_mapel',
            'ruangan' => 'required|string|nullable|string|max:100',
        ], [
            'hari.required' => 'Hari tidak boleh kosong.',
            'jam_mulai.required' => 'Jam mulai tidak boleh kosong.',
            'jam_selesai.required' => 'Jam selesai tidak boleh kosong.',
            'id_mapel.required' => 'Mata pelajaran tidak boleh kosong.',
            'ruangan.required' => 'Ruangan tidak boleh kosong.',
        ]);

        // Cari jadwal yang akan diupdate
        $jadwal = Jadwal::where('id_jadwal', $id_jadwal)
                      ->where('id_sekolah', $id_sekolah)
                      ->firstOrFail();

        // Update data jadwal
        $jadwal->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'id_mapel' => $request->id_mapel,
            'ruangan' => $request->ruangan,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('tambahJadwal', ['id_kelas' => $jadwal->id_kelas])->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function manajTingkat()
    {
        $id_sekolah = request()->cookie('id_sekolah');
        $tingkats = Tingkat::where('id_sekolah', $id_sekolah)->orderBy('tingkat', 'asc')->get();
        return view('admin.manajemen_tingkat', compact('tingkats'));
    }

    public function storeTingkat(Request $request)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        
        // Tambahkan validasi sederhana untuk memastikan cookie ada
        if (!$id_sekolah) {
            return redirect()->back()->with('error', 'Gagal menambahkan tingkat. Sesi sekolah tidak ditemukan.');
        }
        
        $jumlahTingkat = Tingkat::where('id_sekolah', $id_sekolah)->count() ?? 0;

        // Simpan tingkat baru ke database
        Tingkat::create([
            'id_sekolah' => $id_sekolah,
            'tingkat' => $jumlahTingkat + 1,
        ]);

        return redirect()->route('manajemenTingkat')->with('success', 'Tingkat berhasil ditambahkan!');
    }

    public function updateTingkat(Request $request, $id_tingkat)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        $request->validate([
            'tingkat' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tingkats', 'tingkat')
                    ->where('id_sekolah', $id_sekolah)
                    ->ignore($id_tingkat, 'id_tingkat')
            ],
        ], [
            'tingkat.required' => 'Nama tingkat tidak boleh kosong.',
            'tingkat.unique' => 'Nama tingkat ini sudah ada.',
        ]);

        $tingkat = Tingkat::where('id_tingkat', $id_tingkat)
                         ->where('id_sekolah', $id_sekolah)
                         ->firstOrFail();

        $tingkat->update([
            'tingkat' => $request->tingkat,
        ]);

        return redirect()->route('manajemenTingkat')->with('success', 'Tingkat berhasil diperbarui!');
    }

    public function destroyTingkat(Request $request, $id_tingkat)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        
        // 1. Cari tingkat tertinggi yang ada di database untuk sekolah ini.
        // Parameter $id_tingkat dari URL akan diabaikan.
        // Menggunakan orderByRaw untuk memastikan pengurutan numerik yang benar pada kolom string.
        $tingkatTertinggi = Tingkat::where('id_sekolah', $id_sekolah)
                                   ->orderByRaw('CAST(tingkat AS UNSIGNED) DESC, tingkat DESC')
                                   ->first();
        
        // 2. Jika tingkat tertinggi ditemukan, hapus. Jika tidak, kembali dengan pesan error.
        if ($tingkatTertinggi) {
            $tingkatTertinggi->delete();
            return redirect()->route('manajemenTingkat')->with('success', 'Tingkat tertinggi berhasil dihapus!');
        }
        
        return redirect()->route('manajemenTingkat')->withErrors(['error' => 'Tidak ada tingkat yang bisa dihapus.']);
    }

    public function manajKurikulum (Request $request) 
    {
        $id_sekolah = request()->cookie('id_sekolah');

        $angkatans = Angkatan::where('id_sekolah', $id_sekolah)->latest()->get();

        $kurikulums = DaftarKurikulum::where('id_sekolah', $id_sekolah)
                    ->with('angkatan')
                    ->get();

        return view('admin.manajemen_kurikulum', ['kurikulums' => $kurikulums, 'angkatans' => $angkatans]);
    }

    public function storeKurikulum(Request $request)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        $request->validate([
            'id_angkatan' => 'required|exists:angkatans,id_angkatan', //cek apakah id_angkatan ada di tabel angkatans
            'nama' => 'required|string|max:255',
            'jenjang' => 'required|string|in:SMA,SMK,SD,SMP',
            'jumlah_matpel' => 'required|integer|min:1',
        ], [
            'angkatan.required' => 'Angkatan tidak boleh kosong.',
            'angkatan.exists' => 'Angkatan tidak valid.',
            'nama.required' => 'Nama kurikulum tidak boleh kosong.',
            'jenjang.required' => 'Jenjang kurikulum tidak boleh kosong.',
            'jenjang.in' => 'Jenjang kurikulum tidak valid.',
            'jumlah_matpel.required' => 'Jumlah mata pelajaran tidak boleh kosong.',
            'jumlah_matpel.integer' => 'Jumlah mata pelajaran harus berupa angka.',
            'jumlah_matpel.min' => 'Jumlah mata pelajaran harus minimal 1.', 
        ]);

        DaftarKurikulum::create([
            'id_sekolah' => $id_sekolah,
            'id_angkatan' => $request->id_angkatan,
            'nama_kurikulum' => $request->nama,
            'jenjang' => $request->jenjang,
            'jumlah_matpel' => $request->jumlah_matpel,
        ]);

        return redirect()->route('manajemenKurikulum')->with('success', 'Kurikulum berhasil ditambahkan!');

    }

    public function manajRapor ()
    {
        $id_sekolah = request()->cookie('id_sekolah');

        $kelaslist = Kelas::where('id_sekolah', $id_sekolah)
                        ->with('angkatan')
                        ->whereHas('angkatan', function ($query) {
                        $query->whereNotNull('id_tingkat');
                         })//filter alumni
                        ->get();

        return view('admin.manajemen_rapor', ['kelasList' => $kelaslist]);
    }

    public function Rapors(Request $request, int $id_kelas)
    {
        $id_sekolah = $request->cookie('id_sekolah');
    
        // Ambil info kelas dan angkatan untuk data umum di rapor
        $kelasInfo = Kelas::with('angkatan.sekolah')
                        ->whereHas('angkatan', function ($query) {
                        $query->whereNotNull('id_tingkat');
                         })//filter alumni
                        ->findOrFail($id_kelas);
    
        // Ambil semua siswa dalam kelas beserta relasi nilai mereka
        $students = User::where('id_kelas', $id_kelas)
                        ->where('id_sekolah', $id_sekolah)
                        ->with([
                            // Filter relasi saat eager loading
                            'daftarNilaiSiswa' => function($query) use ($kelasInfo) {
                                $query->where('tingkat', $kelasInfo->angkatan->id_tingkat)
                                      ->where('semester', $kelasInfo->angkatan->semester);
                            },
                            'daftarNilaiSiswa.mapel', 
                            'daftarNilaiSiswa.daftarNilai',
                            'daftarNilaiSiswa.idTingkat',
                            'daftarAbsensiSiswa' => function($query) use ($kelasInfo) {
                                $query->where('tingkat', $kelasInfo->angkatan->id_tingkat)
                                      ->where('semester', $kelasInfo->angkatan->semester);
                            }
                        ])
                        ->get();

        $infoTS = $students->first()?->daftarNilaiSiswa?->first() ?? [];
    
        // Proses data untuk setiap siswa
        $processedRapors = $students->map(function ($student) {
            // Kelompokkan nilai berdasarkan mapel
            $nilaiByMapel = $student->daftarNilaiSiswa->groupBy('id_mapel');
    
            $raporData = $nilaiByMapel->map(function ($nilaiGroup) {
                $scores = [
                    'Tugas' => [],
                    'PR'    => [],
                    'UTS'   => [],
                    'UAS'   => [],
                    'Hafalan' => [],
                ];
    
                // 1. Kumpulkan semua nilai untuk setiap tipe ke dalam array
                foreach ($nilaiGroup as $nilai) {
                    if ($nilai->daftarNilai && is_numeric($nilai->nilai)) {
                        $tipe = $nilai->daftarNilai->tipe_nilai;
                        if (array_key_exists($tipe, $scores)) {
                            $scores[$tipe][] = $nilai->nilai; // Tambahkan nilai ke array
                        }
                    }
                }
    
                // Helper function untuk menghitung rata-rata
                $calculateAverage = function (array $numbers) {
                    if (empty($numbers)) {
                        return null;
                    }
                    return array_sum($numbers) / count($numbers);
                };
    
                // 2. Hitung rata-rata untuk setiap tipe nilai
                $avgTugas = $calculateAverage($scores['Tugas']);
                $avgPR = $calculateAverage($scores['PR']);
                $avgUTS = $calculateAverage($scores['UTS']);
                $avgUAS = $calculateAverage($scores['UAS']);
                $avgHafalan = $calculateAverage($scores['Hafalan']);
    
                // RUMUS NILAI TUGAS AKHIR
                $nilaiTugasAkhir = $avgTugas;
                if (is_numeric($avgTugas) && is_numeric($avgPR) && !is_numeric($avgHafalan)) {
                    // Jika ada nilai PR dan tugas, hitung dengan bobot
                    $nilaiTugasAkhir = round(($avgTugas * 0.7) + ($avgPR * 0.3));
                } elseif (is_numeric($avgTugas) && is_numeric($avgPR) && is_numeric($avgHafalan)) {
                    //jika ada nilai tugas, pr, dan hafalan, hitung dengan bobot
                    $nilaiTugasAkhir = round(($avgTugas * 0.4) + ($avgPR * 0.2) + ($avgHafalan * 0.4));
                }
                elseif (is_numeric($avgTugas) && is_numeric($avgHafalan) && !is_numeric($avgPR)) {
                    // Jika hanya ada Tugas dan Hafalan, hitung dengan bobot
                    $nilaiTugasAkhir = round(($avgTugas * 0.5) + ($avgHafalan * 0.5));
                }
                elseif (is_numeric($avgPR) && !is_numeric($avgTugas) && !is_numeric($avgHafalan)) {
                    // Jika hanya ada PR, nilai PR menjadi nilai Tugas
                    $nilaiTugasAkhir = $avgPR;
                } elseif (is_numeric($avgHafalan) && !is_numeric($avgTugas) && !is_numeric($avgPR)) {
                    // Jika hanya ada Hafalan, nilai Hafalan menjadi nilai Tugas
                    $nilaiTugasAkhir = $avgHafalan;
                }
    
                // 4. Siapkan skor akhir untuk ditampilkan di rapor
                $finalScores = [
                    'Tugas' => $nilaiTugasAkhir !== null ? round($nilaiTugasAkhir) : null,
                    'UTS'   => $avgUTS !== null ? round($avgUTS) : null,
                    'UAS'   => $avgUAS !== null ? round($avgUAS) : null,
                    'Nilai Akhir' => 0,
                ];
    
                // 5. Hitung Nilai Akhir Rapor dari rata-rata (Tugas Akhir, UTS, UAS)
                $validScores = array_filter([$finalScores['Tugas'], $finalScores['UTS'], $finalScores['UAS']], 'is_numeric');
                if (count($validScores) > 0) {
                    $finalScores['Nilai Akhir'] = round(array_sum($validScores) / count($validScores));
                }
    
                return [
                    'mapel' => $nilaiGroup->first()->mapel,
                    'scores' => $finalScores,
                ];
            });
    
            // --- LOGIKA PENGHITUNGAN ABSENSI (data sudah terfilter oleh query) ---
            // Hitung jumlah untuk setiap status
            $attendanceCounts = [
                'Sakit' => $student->daftarAbsensiSiswa->where('status', 'Sakit')->count(),
                'Izin'  => $student->daftarAbsensiSiswa->where('status', 'Izin')->count(),
                'Alfa' => $student->daftarAbsensiSiswa->where('status', 'Alfa')->count(),
            ];

            // Kembalikan data siswa bersama dengan data rapor yang sudah diproses
            return [
                'siswa' => $student,
                'rapor' => $raporData,
                'absensi' => $attendanceCounts, // Tambahkan data absensi ke hasil
            ];
        });

        // return view('debug', ['tes' => $students, 'tess' => $processedRapors]);
        return view('admin.rapors', ['processedRapors' => $processedRapors, 'kelasInfo' => $kelasInfo, 'infoTS' => $infoTS]);
    }



    /**
     * Memperbarui data kelas yang ada di database.
     */
    
    
    /**
     * Menghapus data kelas dari database.
     */


    ##############################YOGA##############################
    ##############################YOGA##############################
    ##############################YOGA##############################
    ##############################YOGA##############################
    ##############################YOGA##############################
    ##############################YOGA##############################
    ##############################YOGA##############################
    ##############################YOGA##############################
    ##############################YOGA##############################
    ##############################YOGA##############################
    ##############################YOGA##############################
    ##############################YOGA##############################

        public function destroyAngkatan(Request $request, $id)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        $angkatan = Angkatan::where('id_angkatan', $id)
                            ->where('id_sekolah', $id_sekolah)
                            ->firstOrFail();

        $angkatan->delete();

        return redirect()->route('manajemenAngkatan')->with('success', 'Angkatan berhasil dihapus!');
    }


        public function hapusGuru(Request $request, $id)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        $guru = User::where('id', $id)
            ->where('id_sekolah', $id_sekolah)
            ->whereIn('role', ['guru', 'staf'])
            ->firstOrFail();

        $guru->delete();

        return redirect()->route('manajemenGuru')->with('success', 'Data guru/staf berhasil dihapus!');
    }


        public function hapusSiswa(Request $request, User $siswa)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        // Pastikan siswa yang akan dihapus adalah role 'siswa' dan milik sekolah yang sama
        if ($siswa->role !== 'siswa' || $siswa->id_sekolah != $id_sekolah) {
            abort(403, 'Akses ditolak atau siswa tidak ditemukan.');
        }

        $siswa->delete();
        return redirect()->route('manajemenSiswa')->with('success', 'Data siswa berhasil dihapus!');
    }

    public function lihatDetailSiswa(Request $request, $idsiswa)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        
        // $siswa = User::where('id', $siswa) // $siswa di sini adalah ID dari URL
        //             ->where('id_sekolah', $id_sekolah)
        //             ->where('role', 'siswa')
        //             ->with('kelas.angkatan.idtingkat')
        //             ->with('daftarNilaiSiswa.kelas.angkatan')
        //             ->with('daftarAbsensiSiswa.kelas.angkatan')
        //             ->select('daftarNilaiSiswa.semester', 'daftarNilaiSiswa.tingkat', 'daftarAbsensiSiswa.semester', 'daftarAbsensiSiswa.tingkat')
        //             ->distinct()
        //             ->firstOrFail();

        // Ambil data siswa
        $siswa = User::where('id', $idsiswa)
                ->where('id_sekolah', $id_sekolah)
                ->where('role', 'siswa')
                ->with([
                    'daftarNilaiSiswa' => function ($query) {
                        $query->select('id_daftar_nilai_siswa', 'id_siswa', 'id_kelas', 'tingkat', 'semester')
                            ->whereNotNull('tingkat')
                            ->whereNotNull('semester')
                            ->distinct('tingkat', 'semester')
                            ->with('idTingkat')
                            ->with('kelas.angkatan');
                    },
                    'daftarAbsensiSiswa' => function ($query) {
                        $query->select('id_daftar_absensi_siswa', 'id_siswa', 'id_kelas', 'tingkat', 'semester')
                            ->whereNotNull('tingkat')
                            ->whereNotNull('semester')
                            ->distinct('tingkat', 'semester')
                            ->with('idTingkat')
                            ->with('kelas.angkatan');
                    },
                    'kelas.angkatan'
                ])
                ->firstOrFail();


        $historiKBMs = collect($siswa->daftarNilaiSiswa)
                ->merge($siswa->daftarAbsensiSiswa)
                ->map(fn($item) => [
                    'tingkat' => $item->idTingkat->tingkat,
                    'semester' => $item->semester,
                    'id_tingkat' => $item->tingkat,
                    'angkatan' => $item->kelas->angkatan->angkatan,
                ])
                ->unique(fn($item) => $item['id_tingkat'].'-'.$item['semester'])
                ->values();


        return view('admin.lihat_detail_siswa',['siswa' => $siswa, 'historiKBMs' => $historiKBMs]);
        // return view('debug', ['tes' => $siswa, 'tess' => $historiKBMs]);
    }

    public function historyKBM (Request $request, $idsiswa, $idTingkat, $semester)
    {
        if ($semester != 'ganjil' && $semester != 'genap') {
            abort(404);
        }
        $id_sekolah = $request->cookie('id_sekolah');

        $historyNilai = DaftarNilaiSiswa::where('id_siswa', $idsiswa)
                            ->where('tingkat', $idTingkat)
                            ->where('semester', $semester)
                            ->with('siswa')
                            ->with('mapel')
                            ->with('idTingkat')
                            ->with('daftarNilai')
                            ->get();

        $historyAbsensi = DaftarAbsensiSiswa::where('id_siswa', $idsiswa)
                            ->where('tingkat', $idTingkat)
                            ->where('semester', $semester)
                            ->with('daftarAbsensi')
                            ->with('mapel')
                            ->get();

        $infoSiswa = $historyNilai->first();

        $idSekolahSiswa = $historyNilai->first()->siswa->id_sekolah ?? $id_sekolah;

        if ($idSekolahSiswa != $id_sekolah) {
            abort(404, );
        }

        return view('admin.lihat_histori_kbm', ['historyNilai' => $historyNilai, 'historyAbsensi' => $historyAbsensi, 'infoSiswa' => $infoSiswa]);
        // return view('debug', ['tes' => $infoSiswa, 'tess' => $idTingkat, 'tesss' => $historyNilai]);
    }

    public function rapor(Request $request, $id_siswa, $id_tingkat, $semester)
    {
        $id_sekolah = $request->cookie('id_sekolah');
    
        // Ambil semua siswa dalam kelas beserta relasi nilai mereka
        $students = User::where('id', $id_siswa)
                        ->where('id_sekolah', $id_sekolah)
                        ->with([
                            // Filter relasi saat eager loading
                            'daftarNilaiSiswa' => function($query) use ($id_tingkat, $semester) {
                                $query->where('tingkat', $id_tingkat)
                                      ->where('semester', $semester);
                            },
                            'daftarNilaiSiswa.mapel', 
                            'daftarNilaiSiswa.daftarNilai',
                            'daftarNilaiSiswa.idTingkat',
                            'daftarAbsensiSiswa' => function($query) use ($id_tingkat, $semester) {
                                $query->where('tingkat', $id_tingkat)
                                      ->where('semester', $semester);
                            }
                        ])
                        ->with('kelas')
                        ->get();
        
        $infoTS = $students->first()?->daftarNilaiSiswa?->first() ?? [];
        
        // Jika siswa tidak ditemukan atau tidak punya kelas, hentikan proses.
        if ($students->isEmpty() || !$students->first()->kelas) {
            abort(404, 'Siswa atau data kelas tidak ditemukan.');
        }

         $kelasInfo = Kelas::with('angkatan.sekolah')
                        ->whereHas('angkatan', function ($query) {
                        // $query->whereNotNull('id_tingkat');
                         })//filter alumni
                        ->findOrFail($students->first()->kelas->id_kelas);
    
        // Proses data untuk setiap siswa
        $processedRapors = $students->map(function ($student) {
            // Kelompokkan nilai berdasarkan mapel
            $nilaiByMapel = $student->daftarNilaiSiswa->groupBy('id_mapel');
    
            $raporData = $nilaiByMapel->map(function ($nilaiGroup) {
                $scores = [
                    'Tugas' => [],
                    'PR'    => [],
                    'UTS'   => [],
                    'UAS'   => [],
                    'Hafalan' => [], // Tambahkan tipe nilai Hafalan
                ];
    
                // 1. Kumpulkan semua nilai untuk setiap tipe ke dalam array
                foreach ($nilaiGroup as $nilai) {
                    if ($nilai->daftarNilai && is_numeric($nilai->nilai)) {
                        $tipe = $nilai->daftarNilai->tipe_nilai;
                        if (array_key_exists($tipe, $scores)) {
                            $scores[$tipe][] = $nilai->nilai; // Tambahkan nilai ke array
                        }
                    }
                }
    
                // Helper function untuk menghitung rata-rata
                $calculateAverage = function (array $numbers) {
                    if (empty($numbers)) {
                        return null;
                    }
                    return array_sum($numbers) / count($numbers);
                };
    
                // 2. Hitung rata-rata untuk setiap tipe nilai
                $avgTugas = $calculateAverage($scores['Tugas']);
                $avgPR = $calculateAverage($scores['PR']);
                $avgUTS = $calculateAverage($scores['UTS']);
                $avgUAS = $calculateAverage($scores['UAS']);
                $avgHafalan = $calculateAverage($scores['Hafalan']); // Hitung rata-rata Hafalan
    
                // RUMUS NILAI TUGAS AKHIR
                $nilaiTugasAkhir = $avgTugas;
                if (is_numeric($avgTugas) && is_numeric($avgPR) && !is_numeric($avgHafalan)) {
                    // Jika ada nilai PR dan tugas, hitung dengan bobot
                    $nilaiTugasAkhir = round(($avgTugas * 0.7) + ($avgPR * 0.3));
                } elseif (is_numeric($avgTugas) && is_numeric($avgPR) && is_numeric($avgHafalan)) {
                    //jika ada nilai tugas, pr, dan hafalan, hitung dengan bobot
                    $nilaiTugasAkhir = round(($avgTugas * 0.4) + ($avgPR * 0.2) + ($avgHafalan * 0.4));
                }
                elseif (is_numeric($avgTugas) && is_numeric($avgHafalan) && !is_numeric($avgPR)) {
                    // Jika hanya ada Tugas dan Hafalan, hitung dengan bobot
                    $nilaiTugasAkhir = round(($avgTugas * 0.5) + ($avgHafalan * 0.5));
                }
                elseif (is_numeric($avgPR) && !is_numeric($avgTugas) && !is_numeric($avgHafalan)) {
                    // Jika hanya ada PR, nilai PR menjadi nilai Tugas
                    $nilaiTugasAkhir = $avgPR;
                } elseif (is_numeric($avgHafalan) && !is_numeric($avgTugas) && !is_numeric($avgPR)) {
                    // Jika hanya ada Hafalan, nilai Hafalan menjadi nilai Tugas
                    $nilaiTugasAkhir = $avgHafalan;
                }
    
                // 4. Siapkan skor akhir untuk ditampilkan di rapor
                $finalScores = [
                    'Tugas' => $nilaiTugasAkhir !== null ? round($nilaiTugasAkhir) : null,
                    'UTS'   => $avgUTS !== null ? round($avgUTS) : null,
                    'UAS'   => $avgUAS !== null ? round($avgUAS) : null,
                    'Nilai Akhir' => 0,
                ];
    
                // 5. Hitung Nilai Akhir Rapor dari rata-rata (Tugas Akhir, UTS, UAS)
                $validScores = array_filter([$finalScores['Tugas'], $finalScores['UTS'], $finalScores['UAS']], 'is_numeric');
                if (count($validScores) > 0) {
                    $finalScores['Nilai Akhir'] = round(array_sum($validScores) / count($validScores)); // merata-rata nilai Tugas, UTS, dan UAS
                }
    
                return [
                    'mapel' => $nilaiGroup->first()->mapel,
                    'scores' => $finalScores,
                ];
            });
    
            // --- LOGIKA PENGHITUNGAN ABSENSI (data sudah terfilter oleh query) ---
            // Hitung jumlah untuk setiap status
            $attendanceCounts = [
                'Sakit' => $student->daftarAbsensiSiswa->where('status', 'Sakit')->count(),
                'Izin'  => $student->daftarAbsensiSiswa->where('status', 'Izin')->count(),
                'Alfa' => $student->daftarAbsensiSiswa->where('status', 'Alfa')->count(),
            ];

            // Kembalikan data siswa bersama dengan data rapor yang sudah diproses
            return [
                'siswa' => $student,
                'rapor' => $raporData,
                'absensi' => $attendanceCounts, // Tambahkan data absensi ke hasil
            ];
        });

        // return view('debug', ['tes' => $students, 'tess' => $processedRapors]);
        return view('admin.rapors', ['processedRapors' => $processedRapors, 'kelasInfo' => $kelasInfo, 'infoTS' => $infoTS]);
    }


    public function destroyKelas(Request $request, $id_kelas) // Should be destroy() for KelasController
    {
        $id_sekolah = $request->cookie('id_sekolah');
        $kelas = Kelas::where('id_kelas', $id_kelas)->where('id_sekolah', $id_sekolah)->firstOrFail();
        $kelas->delete();

        return redirect()->route('manajemenKelas')->with('success', 'Data kelas berhasil dihapus!'); // PERBAIKAN: Menggunakan nama route yang benar
    }

        public function editGuru($id)
    {
        $id_sekolah = request()->cookie('id_sekolah');
        $teacher = User::where('id', $id)
                        ->where('id_sekolah', $id_sekolah) // Tambahkan filter id_sekolah
                        ->whereIn('role', ['guru', 'staf'])->firstOrFail();
        return view('admin.edit_guru', compact('teacher')); // Sesuaikan path view
    }

        public function editSiswa(Request $request, User $siswa) // Menggunakan Route Model Binding untuk User (sebagai siswa)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        // Pastikan siswa yang akan diedit adalah role 'siswa' dan milik sekolah yang sama
        if ($siswa->role !== 'siswa' || $siswa->id_sekolah != $id_sekolah) {
            abort(403, 'Akses ditolak atau siswa tidak ditemukan.'); // Atau redirect dengan pesan error
        }

        $kelases = Kelas::where('id_sekolah', $id_sekolah)->get(); // Ambil semua data kelas untuk dropdown
        return view('admin.edit-siswa', compact('siswa', 'kelases')); // Sesuaikan path view Anda
    }
    

    public function editKelas(Request $request, $id_kelas) // Should be edit() for KelasController
    {
        $id_sekolah = $request->cookie('id_sekolah');
        // Temukan kelas spesifik dari database berdasarkan ID dan id_sekolah
        $kelas = Kelas::where('id_kelas', $id_kelas)
                      ->where('id_sekolah', $id_sekolah)
                      ->with('angkatan')
                      ->whereHas('angkatan', function ($query) {
                        $query->whereNotNull('id_tingkat');
                         })//filter alumni
                      ->firstOrFail();

        // Ambil data angkatan yang tersedia untuk sekolah ini saja
        $angkatans = Angkatan::where('id_sekolah', $id_sekolah)->latest()->get();

        // Kembalikan view edit, berikan data kelas yang spesifik dan angkatan yang relevan
        return view('admin.edit-kelas', compact('kelas', 'angkatans'));
    }

    public function updateGuru(Request $request, $id)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|unique:users,nisn_nik,' . $id,
            'name' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:15',
            'username' => 'required|string|unique:users,username,' . $id,
            'jabatan' => 'required|string|in:guru,staf',
            'password' => 'nullable|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $guru = User::where('id', $id)
            ->where('id_sekolah', $id_sekolah)
            ->where('role', 'guru')
            ->firstOrFail();

        $updateData = [
            'name' => $request->name,
            'nisn_nik' => $request->nik, // Sesuaikan dengan nama kolom yang benar
            'username' => $request->username,
            'role' => $request->jabatan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            // 'usia' tidak ada di form update, jika perlu ditambahkan
        ];

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $updateData['password'] =$request->password;
        }
        
        // Hanya update email jika username berubah (karena email dibuat dari username)
        if ($request->username !== $guru->username) {
             $updateData['email'] = $request->username . '@sekolah.sch.id';
        }

        $guru->update($updateData);

        return redirect()->route('manajemenGuru')->with('success', 'Data guru berhasil diperbarui!');
    }

    public function updateAngkatan(Request $request, $id)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        $request->validate([
            'angkatan' => 'required|string|max:255|unique:angkatans,angkatan,' . $id . ',id_angkatan,id_sekolah,' . $id_sekolah, // Tambahkan id_sekolah ke unique rule
            'id_tingkat' => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'semester' => 'required|in:ganjil,genap', // Tambahkan validasi untuk semester
        ], [
            'angkatan.required' => 'Tahun ajaran tidak boleh kosong.',
            'angkatan.unique' => 'Tahun ajaran ini sudah ada.',
            'id_tingkat.required' => 'Tingkat tidak boleh kosong.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
            'semester.required' => 'Semester tidak boleh kosong.',
            'semester.in' => 'Semester tidak valid.',
        ]);

        $angkatan = Angkatan::where('id_angkatan', $id)
                            ->where('id_sekolah', $id_sekolah)
                            ->firstOrFail();
                            

    if ($request->id_tingkat == 2147483646){
        $angkatan->update([
        'angkatan' => $request->angkatan,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
        'semester' => $request->semester, // Tambahkan ini
        'tingkat' => null,
        'id_tingkat' => null,
        'is_alumni' => true
    ]);
    } else {
        $angkatan->update([
            'angkatan' => $request->angkatan,
            'id_tingkat' => $request->id_tingkat,
            'tingkat' => Tingkat::where('id_tingkat', $request->id_tingkat)->value('tingkat'),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'semester' => $request->semester, // Tambahkan ini
            'is_alumni' => false
        ]);
    }
                            
        return redirect()->route('manajemenAngkatan')->with('success', 'Angkatan berhasil diperbarui!');
    }

    public function updateSiswa(Request $request, User $siswa) // Menggunakan Route Model Binding untuk User (sebagai siswa)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        // Pastikan siswa yang akan diupdate adalah role 'siswa' dan milik sekolah yang sama
        if ($siswa->role !== 'siswa' || $siswa->id_sekolah != $id_sekolah) {
            abort(403, 'Akses ditolak atau siswa tidak ditemukan.'); // Atau redirect dengan pesan error
        }

        $request->validate([
            'nisn_nik' => 'required|string|max:255|unique:users,nisn_nik,' . $siswa->id, // unique kecuali untuk siswa ini
            'name' => 'required|string|max:255',
            'id_kelas' => 'nullable|exists:kelas,id_kelas', // Sesuaikan dengan nama kolom ID di tabel kelas Anda
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'username' => 'required|string|max:255|unique:users,username,' . $siswa->id,
            'password' => 'nullable|string|min:6', // Password bisa kosong jika tidak ingin diubah
            'tempat_lahir' => 'nullable|string|max:100', // Tambahkan validasi lain jika diperlukan
            'no_telp' => 'nullable|string|max:20', // Tambahkan validasi lain jika diperlukan
            'jumlah_saudara' => 'nullable|integer|min:0',
            'gaji_orang_tua' => 'nullable|integer|min:0',

        ]);

        $updateData = [
            'nisn_nik' => $request->nisn_nik,
            'name' => $request->name,
            'username' => $request->username,
            'id_kelas' => $request->id_kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_angkatan' => Kelas::where('id_kelas', $request->id_kelas)->value('id_angkatan'),
            'jumlah_sodara' => $request->jumlah_saudara,
            'gaji_orang_tua' => $request->gaji_orang_tua,
        ];

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $updateData['password'] = $request->password;
        }

        // Hanya update email jika username berubah (karena email dibuat dari username)
        if ($request->username !== $siswa->username) {
             $updateData['email'] = $request->username . '@sekolah.sch.id';
        }


        $siswa->update($updateData);

        return redirect()->route('manajemenSiswa')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function updateKelas(Request $request, $id_kelas) // Should be update() for KelasController
    {
        $id_sekolah = $request->cookie('id_sekolah');

        // Aturan validasi
        $request->validate([
            'nama_kelas' => [
                'required',
                'string',
                'max:255',
                // Pastikan nama kelas unik untuk angkatan dan sekolah yang sama, kecuali untuk ID kelas ini sendiri
                'unique:kelas,nama_kelas,' . $id_kelas . ',id_kelas,id_angkatan,' . $request->id_angkatan . ',id_sekolah,' . $id_sekolah,
            ],
            'wali_kelas' => 'required|string|max:255',
            'id_angkatan' => 'required|exists:angkatans,id_angkatan', // 'exists' memeriksa apakah id_angkatan ada di tabel angkatans
            'jurusan' => 'nullable|string|max:20',
        ]);

        // Cari kelas berdasarkan ID dan id_sekolah untuk keamanan
        $kelas = Kelas::where('id_kelas', $id_kelas)
                      ->where('id_sekolah', $id_sekolah)
                      ->firstOrFail();

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'wali_kelas' => $request->wali_kelas,
            'id_angkatan' => $request->id_angkatan,
            'jurusan' => $request->jurusan,
        ]);

        // Arahkan kembali ke daftar kelas utama dengan pesan sukses
        return redirect()->route('manajemenKelas')->with('success', 'Data kelas berhasil diperbarui!');
    }


    public function updateMapel(Request $request, $id)
    {
        $id_sekolah = request()->cookie('id_sekolah');

        $request->validate([
            'kode_mapel' => 'required|string|max:20|unique:mapels,kode_mapel,' . $id . ',id_mapel,id_sekolah,' . $id_sekolah,
            'nama_mapel' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'sks' => 'required|integer|min:1',
            'guru_id' => 'nullable|exists:users,id',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            'kode_mapel.required' => 'Kode mata pelajaran tidak boleh kosong.',
            'kode_mapel.unique' => 'Kode mata pelajaran ini sudah ada.',
            'nama_mapel.required' => 'Nama mata pelajaran tidak boleh kosong.',
            'kategori.required' => 'Kategori mata pelajaran tidak boleh kosong.',
            'sks.required' => 'SKS tidak boleh kosong.',
            'sks.integer' => 'SKS harus berupa angka.',
            'sks.min' => 'SKS harus minimal 1.',
            'guru_id.exists' => 'Guru pengampu tidak valid.',
            'status.required' => 'Status tidak boleh kosong.',
        ]);

        // Cari mapel yang akan diupdate
        $mapel = Mapel::where('id_mapel', $id)
                      ->where('id_sekolah', $id_sekolah)
                      ->firstOrFail();

        // Ambil nama guru jika ada
        $namaGuru = User::where('id', $request->guru_id)->where('id_sekolah', $id_sekolah)->value('name');

        // Update data mapel
        $mapel->update([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'kategori' => $request->kategori,
            'sks' => $request->sks,
            'id_guru' => $request->guru_id,
            'nama_guru' => $namaGuru,
            'status' => $request->status,
        ]);

        return redirect()->route('manajemenMapel')->with('success', 'Mata pelajaran berhasil diperbarui!');
    }

    public function destroyMapel(Request $request, $id)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        $mapel = Mapel::where('id_mapel', $id)
                      ->where('id_sekolah', $id_sekolah)
                      ->firstOrFail();

        $mapel->delete();

        return redirect()->route('manajemenMapel')->with('success', 'Mata pelajaran berhasil dihapus!');
    }

    public function destroyJadwal(Request $request, $id_jadwal)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        $jadwal = Jadwal::where('id_jadwal',$id_jadwal)
                        ->where('id_sekolah', $id_sekolah)
                        ->firstOrFail();

        $jadwal->delete();

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }

    public function keluarkanSiswaDariKelas(Request $request, $id_siswa, $id_kelas)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        // 1. Cari siswa berdasarkan id, id_sekolah, dan role
        $siswa = User::where('id', $id_siswa)
                     ->where('id_sekolah', $id_sekolah)
                     ->where('role', 'siswa')
                     ->firstOrFail(); // Akan gagal jika siswa tidak ditemukan

        // 2. Verifikasi apakah siswa benar-benar ada di kelas yang dimaksud
        if ($siswa->id_kelas != $id_kelas) {
            // Jika tidak, kembalikan dengan pesan error
            return back()->with('error', 'Siswa tidak ditemukan di kelas ini.');
        }

        // 3. Set id_kelas menjadi null untuk mengeluarkan siswa dari kelas
        $siswa->id_kelas = null;
        $siswa->id_angkatan = null;
        $siswa->save();

        // 4. Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('manajemenKelas')->with('success', 'Siswa berhasil dikeluarkan!');


    }


    public function manajAcara(Request $request)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        // Ambil acara yang masih berlangsung atau akan datang (belum lewat tanggal_selesai)
        $daftarAcara = DaftarAcara::where('id_sekolah', $id_sekolah)
                        ->where('tanggal_selesai', '>=', Carbon::now()->subWeeks(1))
                        ->orderBy('tanggal_mulai', 'desc')
                        ->get();


        return View('admin.acara-sekolah', ['daftarAcara' => $daftarAcara]);
    }

    /**
     * Menyimpan acara baru yang ditambahkan melalui form modal.
     * Corresponds to POST /admin/acara-sekolah
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
public function storeAcara(Request $request)
{
    $validatedData = $request->validate([
        'judul_acara'     => 'required|string|max:255',
        'waktu_mulai'     => 'required|date',
        'waktu_berakhir'  => 'required|date',
        'lokasi'          => 'required|string|max:255',
        'peserta_target'  => 'required|string|max:255',
        'deskripsi'       => 'nullable|string|max:500',
    ]);

    DaftarAcara::create([
        'id_sekolah'      => $request->cookie('id_sekolah'),
        'judul_acara'     => $validatedData['judul_acara'],
        'tanggal_mulai'   => $validatedData['waktu_mulai'],
        'tanggal_selesai' => $validatedData['waktu_berakhir'],
        'lokasi'          => $validatedData['lokasi'],
        'peserta'         => $validatedData['peserta_target'],
        'deskripsi'       => $validatedData['deskripsi'],
    ]);

    return redirect()->route('manajAcara')->with('success', 'Acara baru berhasil ditambahkan!');
}


public function updateAcara(Request $request, $id)
{
    $id_sekolah = $request->cookie('id_sekolah');

    $validatedData = $request->validate([
        'judul_acara'     => 'required|string|max:255',
        'waktu_mulai'     => 'required|date',
        'waktu_berakhir'  => 'required|date',
        'lokasi'          => 'required|string|max:255',
        'peserta_target'  => 'required|string|max:255',
        'deskripsi'       => 'nullable|string|max:500',
    ]);

    DB::table('daftar_acaras')
        ->where('id_daftar_acara', $id)
        ->where('id_sekolah', $id_sekolah)
        ->update([
            'judul_acara'     => $validatedData['judul_acara'],
            'tanggal_mulai'   => $validatedData['waktu_mulai'],
            'tanggal_selesai' => $validatedData['waktu_berakhir'],
            'lokasi'          => $validatedData['lokasi'],
            'peserta'         => $validatedData['peserta_target'],
            'deskripsi'       => $validatedData['deskripsi'],
            'updated_at'      => now(),
        ]);

    return redirect()->route('manajAcara')->with('success', 'Acara berhasil diperbarui!');
}


    
public function destroyAcara(Request $request, $id)
{
    $id_sekolah = $request->cookie('id_sekolah');

    DB::table('daftar_acaras')
        ->where('id_sekolah', $id_sekolah)
        ->where('id_daftar_acara', $id)
        ->delete();

    return redirect()->route('manajAcara')->with('success', 'Acara berhasil dihapus.');
}

public function destroyKurikulum(Request $request, $id)
{
    $id_sekolah = $request->cookie('id_sekolah');

    $kurikulum = DaftarKurikulum::where('id_kurikulum', $id)
                                ->where('id_sekolah', $id_sekolah)
                                ->firstOrFail();

    $kurikulum->delete();

    return redirect()->route('manajemenKurikulum')->with('success', 'Kurikulum berhasil dihapus!');
}

public function updateKurikulum(Request $request, $id)
{
    $id_sekolah = $request->cookie('id_sekolah');

    $request->validate([
        'id_angkatan' => 'required|exists:angkatans,id_angkatan,id_sekolah,' . $id_sekolah,
        'nama' => 'required|string|max:255',
        'jenjang' => 'required|string|in:SMA,SMK,SD,SMP',
        'jumlah_matpel' => 'required|integer|min:1',
        'status' => 'required|in:aktif,non-aktif',
    ]);

    $kurikulum = DaftarKurikulum::where('id_kurikulum', $id)
                                ->where('id_sekolah', $id_sekolah)
                                ->firstOrFail();

    $kurikulum->update([
        'id_angkatan' => $request->id_angkatan,
        'nama_kurikulum' => $request->nama,
        'jenjang' => $request->jenjang,
        'jumlah_matpel' => $request->jumlah_matpel,
        'status' => $request->status,
    ]);

    return redirect()->route('manajemenKurikulum')->with('success', 'Kurikulum berhasil diperbarui!');
}

public function showProfileA(Request $request)
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
        // return view('debug');
    }
    // Metode untuk Manajemen Alumni
    public function manajAlumni(Request $request)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        // Mengambil semua data dari tabel angkatan yang is_alumni = true
        $angkatans = Angkatan::where('id_sekolah', $id_sekolah)
                            ->where('is_alumni', true)
                            ->latest()
                            ->get();

        return view('admin.manajemen_alumni', ['angkatans' => $angkatans]);
    }


    public function siswaAlumni(Request $request, $id_angkatan)
    {
        $id_sekolah = $request->cookie('id_sekolah');
        $search = $request->query('search');

        // Query untuk mencari siswa (user dengan role siswa) berdasarkan angkatan
        $query = User::where('role', 'siswa')
                     ->where('id_sekolah', $id_sekolah)
                     ->where('id_angkatan', $id_angkatan)
                     ->with('kelas.angkatan') // Eager load relasi
                     ->whereHas('kelas.angkatan', function ($query) {
                        $query->where('is_alumni', true);
            });

        // Jika ada input pencarian, tambahkan kondisi where
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('nisn_nik', 'like', '%' . $search . '%');
            });
        }

        $alumni = $query->latest()->paginate(10);
        // $id_angkatan = optional($query->first()->kelas)->angkatan->id_angkatan;

        return view('admin.siswa_alumni', ['alumni' => $alumni, 'search' => $search, 'id_angkatan' => $id_angkatan]);
        // return view('debug', ['tes' => $alumni, 'tess' => $query, 'tesss' => $id_angkatan]);
    }

    #############################################################################################################################
    #############################################################################################################################


        public function storeAlumni(Request $request)
    {   
        $id_sekolah = $request->cookie('id_sekolah');

        $request->validate([
            'angkatan' => 'required|string|max:255',
            'id_tingkat' => 'required|integer|exists:tingkats,id_tingkat',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'semester' => 'required|in:ganjil,genap',
        ], [
            'angkatan.required' => 'Tahun lulus tidak boleh kosong.',
            'id_tingkat.required' => 'Tingkat kelulusan tidak boleh kosong.',
            'tanggal_selesai.after_or_equal' => 'Tanggal kelulusan harus setelah atau sama dengan tanggal masuk.',
        ]);

        Angkatan::create([
            'angkatan' => $request->angkatan,
            'id_sekolah' => $id_sekolah,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'id_tingkat' => $request->id_tingkat,
            'tingkat' => Tingkat::where('id_tingkat', $request->id_tingkat)->value('tingkat'),
            'semester' => $request->semester,
            'is_alumni' => true, // Selalu set true untuk data alumni
        ]);

        return redirect()->route('manajemenAlumni')->with('success', 'Data Alumni berhasil ditambahkan!');
    }

    public function updateAlumni(Request $request, $id)
    {
        // Menggunakan kembali logic dari updateAngkatan karena strukturnya sama
        // Cukup panggil method updateAngkatan yang sudah ada
        return $this->updateAngkatan($request, $id);
    }

    public function destroyAlumni(Request $request, $id)
    {
        $id_sekolah = $request->cookie('id_sekolah');

        $alumni = Angkatan::where('id_angkatan', $id)
                            ->where('id_sekolah', $id_sekolah)
                            ->where('is_alumni', true)
                            ->firstOrFail();
        $alumni->delete();

        return redirect()->route('manajemenAlumni')->with('success', 'Data Alumni berhasil dihapus!');
    }


}
