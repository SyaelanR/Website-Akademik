<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\User;
use App\Models\Clien;
use App\Models\DaftarAbsensiSiswa;
use App\Models\DaftarAcara;
use App\Models\Jadwal;
use App\Models\DaftarPengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman form login.
     *
     * @return \Illuminate\View\View
     */

    public function dashboard(Request $request)
    {
        $username = $request->cookie('name');
        $time = Carbon::now()->isoFormat('dddd, D MMMM YYYY');
        // return view('admin.add_users'); //gunakan titik untuk masuk kedalam folder
        
        $role = $request->cookie('role');
        // dd($role);
        if ($role == 'adminDev'){
            $cliens = Clien::all();
            $jumlahClien = $cliens->count();

            return view('dashboard', ['username' => $username, 'time' => $time, 'cliens' => $cliens, 'jumlahClien' => $jumlahClien]);
        }else if ($role == 'admin'){
            $idSekolah = $request->cookie('id_sekolah');

            
            $dataAbsensi = DaftarAbsensiSiswa::with('daftarAbsensi') // penting: eager load relasi
                ->where('id_sekolah', $idSekolah)
                ->whereHas('daftarAbsensi', function ($query) {
                    $query->whereBetween('tanggal', [
                        Carbon::now()->startOfWeek()->toDateString(),
                        Carbon::now()->endOfWeek()->toDateString(),
                    ]);
                })
                ->get();

            $totalAbsensiHarian = [];

            $hariList = [
                'senin' => 0,
                'selasa' => 1,
                'rabu' => 2,
                'kamis' => 3,
                'jumat' => 4,
                'sabtu' => 5,
            ];

            foreach ($hariList as $namaHari => $offset) {
                $tanggal = Carbon::now()->startOfWeek()->addDays($offset);

                // Ambil data absensi pada hari tersebut
                $absensiHariIni = $dataAbsensi->filter(function ($item) use ($tanggal) {
                    return optional($item->daftarAbsensi)->tanggal === $tanggal->toDateString();
                });

                $total = $absensiHariIni->count();
                $hadir = $absensiHariIni->where('status', 'Hadir')->count();

                // Hitung persentase kehadiran (hindari pembagian nol)
                $persentase = $total > 0 ? round(($hadir / $total) * 100, 2) : 0;

                $totalAbsensiHarianHadir[] = $persentase;
            }

            $infoJumlahSGKA = Clien::where('id_sekolah', $idSekolah)
                                ->with('users')
                                ->with('acara')
                                ->with('kelas')
                                ->first();
            
            $jumlahSiswa = $infoJumlahSGKA->users->where('role', 'siswa')->count();
            $jumlahGuru = $infoJumlahSGKA->users->where('role', 'guru')->count();
            $jumlahAcara = $infoJumlahSGKA->acara->count();
            $jumlahKelas = $infoJumlahSGKA->kelas->count();


            return view('dashboard', [
                                'username' => $username, 
                                'time' => $time, 
                                'totalAbsensiHarianHadir' => $totalAbsensiHarianHadir,
                                'jumlahSiswa' => $jumlahSiswa,
                                'jumlahGuru' => $jumlahGuru,
                                'jumlahAcara' => $jumlahAcara,
                                'jumlahKelas' => $jumlahKelas
                            ]);

            // return view('debug', ['tes' => $jumlahAcara, 'tess' => $jumlahSiswa, 'tesss'=> $infoJumlahSGKA]);
        }elseif ($role == 'guru'){
            $idUser = $request->cookie('id_user');

            // Set lokal Carbon ke Indonesia untuk mendapatkan nama hari yang benar
            $hariIni = Carbon::now()->locale('id')->isoFormat('dddd');

            $jadwalHariIni = Jadwal::where('hari', $hariIni)
                ->with(['kelas.angkatan', 'mapel']) 
                ->whereHas('mapel', function ($query) use ($idUser) {
                    $query->where('id_guru', $idUser);
                })
                ->whereHas('kelas.angkatan', function ($query) {
                    $query->whereColumn('angkatans.semester', 'jadwals.semester');
                })
                ->whereHas('kelas.angkatan', function ($query) {
                    $query->whereColumn('angkatans.id_tingkat', 'jadwals.tingkat');
                })
                ->get();
                
            $jumlahSesi = $jadwalHariIni->count();
            return view('dashboard', ['username' => $username, 'time' => $time, 'jadwalHariIni' => $jadwalHariIni, 'jumlahSesi' => $jumlahSesi]);
        
        }elseif ($role == 'siswa'){
            $idKelas = $request->cookie('id_kelas');
            $idSekolah = $request->cookie('id_sekolah');
            $idUser = $request->cookie('id_user');



            $jadwalHariIni = Jadwal::where('hari', Carbon::now()->isoFormat('dddd'))
                ->where('id_kelas', $idKelas)
                ->where('id_sekolah', $idSekolah)
                ->with('mapel.guru')
                ->with('kelas.angkatan')
                ->whereHas('kelas.angkatan', function ($query) {
                    $query->whereColumn('angkatans.semester', 'jadwals.semester');
                })
                ->whereHas('kelas.angkatan', function ($query) {
                    // Filter Jadwal berdasarkan tingkat yang ada di relasi angkatan
                    $query->whereColumn('angkatans.id_tingkat', 'jadwals.tingkat');
                })
                ->get();

            $absensi = DaftarAbsensiSiswa::where('id_siswa', $idUser)
                ->where('id_sekolah', $idSekolah)
                ->with('daftarAbsensi.kelas.angkatan')
                ->whereHas('daftarAbsensi.kelas.angkatan', function ($query) {
                    $query->whereColumn('angkatans.semester', 'daftar_absensi_siswas.semester');
                })
                ->whereHas('daftarAbsensi.kelas.angkatan', function ($query) {
                    // Filter Jadwal berdasarkan tingkat yang ada di relasi angkatan
                    $query->whereColumn('angkatans.id_tingkat', 'daftar_absensi_siswas.tingkat');
                })
                ->get();

            $totalAbsensi = [];

            $totalAbsensi['Hadir'] = $absensi->where('status', 'Hadir')->count();
            $totalAbsensi['Izin'] = $absensi->where('status', 'Izin')->count();
            $totalAbsensi['Sakit'] = $absensi->where('status', 'Sakit')->count();
            $totalAbsensi['Alfa'] = $absensi->where('status', 'Alfa')->count();

            // Ambil semua ID mapel yang diajarkan di kelas siswa
            $mapelIds = Jadwal::where('id_kelas', $idKelas)
                            ->where('id_sekolah', $idSekolah)
                            ->pluck('id_mapel')->unique();

            // Ambil pengumuman yang relevan (berdasarkan id_sekolah, id_kelas, dan id_mapel)
            $DaftarPengumuman = DaftarPengumuman::where('id_sekolah', $idSekolah)
                ->where('id_kelas', $idKelas)
                ->whereIn('id_mapel', $mapelIds)
                ->where('created_at', '>=', Carbon::now()->subWeeks(1))
                ->with('mapel') // Eager load relasi mapel untuk efisiensi
                ->get();

            $daftarAcara = DaftarAcara::where('id_sekolah', $idSekolah)
                        ->where('tanggal_selesai', '>=', Carbon::now()->subWeeks(1))
                        ->orderBy('tanggal_mulai', 'desc')
                        ->get();

            return view('dashboard', ['username' => $username, 
                                                    'time' => $time, 
                                                    'jadwalHariIni' => $jadwalHariIni, 
                                                    'totalAbsensi' => $totalAbsensi,
                                                    'DaftarPengumuman' => $DaftarPengumuman,
                                                    'daftarAcara' => $daftarAcara
                                                ]);

        }elseif ($role == 'staf'){
            return view('dashboard', ['username' => $username, 'time' => $time]);
        }else{
            return view('dashboard', ['username' => $username, 'time' => $time]);
        }
    }

    public function welcome()
    {
        // Mengarahkan ke view yang berisi form login
        return view('welcome');
    }

    /**
     * Menangani permintaan autentikasi yang masuk.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        // 1. Validasi data input dari form
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // PERINGATAN KEAMANAN: Menggunakan enkripsi AES untuk password sangat tidak aman.
        // Sebaiknya gunakan Hashing (Bcrypt) yang merupakan standar industri.
 
        // Langkah 1: Mencari email dari tabel user.
        $user = User::where('username', $credentials['username'])->first();
 
        // Langkah 2, 3, & 4: Mengambil, mendekripsi, dan membandingkan password.
        // - $user->password secara otomatis mengambil dan mendekripsi password dari database
        //   karena ada 'password' => 'encrypted' pada Model User.
        // - Kemudian dibandingkan dengan password dari input form ($credentials['password']).
        if ($user && $credentials['password'] === $user->password) {
            // Langkah 5 (Sukses): Jika password sama, login dan redirect ke dashboard.
            // (Bagian ini menangani session dan redirect, sesuai standar Laravel)
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            // Membuat cookie dengan data pengguna
            $cookieLifetime = 60 * 24 * 30 * 12; // 1 tahun
            $response = redirect()->intended('dashboard');

            // Menambahkan cookie ke response
            $response->withCookie(cookie('name', $user->name, $cookieLifetime));
            $response->withCookie(cookie('username', $user->username, $cookieLifetime));
            $response->withCookie(cookie('nisn_nik', $user->nisn_nik, $cookieLifetime));
            $response->withCookie(cookie('role', $user->role, $cookieLifetime));
            $response->withCookie(cookie('mapel', $user->mapel, $cookieLifetime));
            $response->withCookie(cookie('id_kelas', $user->id_kelas, $cookieLifetime));
            $response->withCookie(cookie('angkatan', $user->id_angkatan, $cookieLifetime)); // Menggunakan id_angkatan sesuai migrasi
            $response->withCookie(cookie('id_sekolah', $user->id_sekolah, $cookieLifetime));
            $response->withCookie(cookie('id_user', $user->id, $cookieLifetime));
            $response->withCookie(cookie('id_angkatan', $user->id_angkatan, $cookieLifetime));
            


            return $response;
        }

        // Langkah 5 (Gagal): Jika user tidak ada atau password salah,
        // kembali ke halaman login dengan pesan error.
        throw ValidationException::withMessages([
            'username' => __('auth.failed'),
        ]);
    }

    /**
     * Menghancurkan sesi autentikasi (logout).
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

        public function pengaturanAkun (Request $request)
    {
        $user = Auth::user();
        
        return view('pengaturan_akun', compact('user'));
    }


    public function updateAkun(Request $request)
    {
        $user = User::where('id', $request->cookie('id_user'))->first();
        $updateData = [];

        // Handle username update
        if ($request->has('username')) {
            $request->validate([
                'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            ], [
                'username.required' => 'Username baru tidak boleh kosong.',
                'username.unique' => 'Username ini sudah digunakan oleh pengguna lain.',
            ]);

            $updateData['username'] = $request->username;
            // Asumsi email dibuat dari username, seperti di controller lain
            $updateData['email'] = $request->username . '@sekolah.sch.id';

            $user->update($updateData);

            return back()->with('success', 'Username berhasil diperbarui!');
        }

        // Handle password update
        if ($request->has('current_password') || $request->has('password')) {
             $request->validate([
                'current_password' => 'required|string',
                'password' => 'required|string|min:6|confirmed',
            ], [
                'current_password.required' => 'Password saat ini tidak boleh kosong.',
                'password.required' => 'Password baru tidak boleh kosong.',
                'password.min' => 'Password baru minimal harus 6 karakter.',
                'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            ]);

            // Verifikasi password saat ini (karena menggunakan AES, kita bandingkan langsung)
            if ($request->current_password !== $user->password) {
                return back()->withErrors(['current_password' => 'Password saat ini yang Anda masukkan salah.']);
            }

            // Update password (model akan mengenkripsi secara otomatis)
            $user->password = $request->password;
            $user->save();

            return back()->with('success', 'Password berhasil diperbarui!');
        }

        return back()->with('error', 'Tidak ada data yang dikirim untuk diperbarui.');
    }
}