<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siswa - {{ $siswa->name }}</title>
    <!-- Tailwind CSS CDN -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('asset/school-solid-full.png') }}">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar { transition: transform 0.3s ease-in-out; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar bg-white w-64 min-h-screen flex-shrink-0 shadow-lg fixed lg:relative z-50 transform -translate-x-full lg:translate-x-0">
        <div class="p-6">
            <a href="#" class="flex items-center space-x-3">
                <i class="fa-solid fa-school text-3xl text-indigo-600"></i>
                <span class="text-2xl font-bold text-gray-800">EduSys</span>
            </a>
        </div>
        <nav class="mt-6">
            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-tachometer-alt w-6 mr-3"></i>
                <span>Dashboard</span>
            </a>

            @can('view-admin')
            <a href="{{ route('admin.profile') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('admin.profile')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-user-circle mr-3"></i>
                <span>Profil</span>
            </a>
            <a href="{{ route('manajemenSiswa') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatDetailSiswa')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-user-graduate w-6 mr-3"></i>
                <span>Manajemen Siswa</span>
            </a>
            <a href="{{ route('manajemenGuru') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-chalkboard-user w-6 mr-3"></i>
                <span>Manajemen Guru</span>
            </a>
            <a href="{{ route('manajemenMapel') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-book w-6 mr-3"></i>
                <span>Manajemen Mapel</span>
            </a>
            <a href="{{ route('manajemenKelas') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-door-closed w-6 mr-3"></i>
                <span>Manajemen Kelas</span>
            </a>
            <a href="{{ route('manajemenJadwal')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-calendar-alt w-6 mr-3"></i>
                <span>Manajemen Jadwal</span>
            </a>
            <a href="{{ route('manajAcara') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-calendar-check w-6 h-6 mr-3"></i>
                <span>Acara</span>
            </a>
            <a href="{{ route('manajemenAngkatan') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-bookmark w-6 mr-3"></i>
                <span>Angkatan</span>
            </a>
            <a href="{{ route('manajemenRapor') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-book-open w-6 mr-3"></i>
                <span>Rapor</span>
            </a>
            <a href="{{ route('manajemenKurikulum') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-book-open-reader w-6 mr-3"></i>
                <span>Kurikulum</span>
            </a>
            <a href="{{ route('manajemenTingkat') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-layer-group w-6 mr-3"></i>
                <span>Tingkat</span>
            </a>
            <a href="{{ route('manajemenAlumni')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('detailSiswaAlumni')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-user-friends w-6 mr-3"></i>
                <span>Manajemen Alumni</span>
            </a>
            @endcan

            @can('view-guru')
            <a href="{{ route('manajemenNilai') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-pen w-6 mr-3"></i>
                <span>Input Nilai</span>
            </a>
            <a href="{{ route('lihatjadwalG') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-calendar-days w-6 mr-3"></i>
                <span>Jadwal Mengajar</span>
            </a>
            <a href="{{ route('manajAbsensi') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-list-check w-6 mr-3"></i>
                <span>Input Absensi</span>
            </a>
            @endcan

            @can('view-siswa')
            <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-pen w-6 mr-3"></i>
                <span>Lihat Nilai</span>
            </a>
            <a href="{{ route('lihatAbsensi') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-list-check w-6 mr-3"></i>
                <span>Lihat Absensi</span>
            </a>
            @endcan

            @can('view-adminDev')
            <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-users w-6 mr-3"></i>
                <span>Manajemen Klien</span>
            </a>
            @endcan
        </nav>
        <div class="p-6 border-t border-gray-200 flex-shrink-0">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); this.closest('form').submit();"
                class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 hover:font-semibold rounded-lg w-full transition duration-200">
                <i class="fa-solid fa-sign-out-alt w-6 mr-3"></i>
                <span>Logout</span>
            </a>
        </form>
    </div>
    </aside>

    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <!-- Header -->
        <header class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-30">
            <button id="menu-button" class="lg:hidden text-gray-600 focus:outline-none">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Detail Siswa</h1>
        </header>

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1">
            <!-- Header Section -->
            <header class="mb-8 bg-indigo-600 p-6 rounded-2xl shadow-lg text-white flex flex-col md:flex-row justify-between items-start gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">{{ $siswa->name }}</h1>
                    <p class="text-indigo-200 mt-1">NISN: {{ $siswa->nisn_nik }}</p>
                </div>
                <a href="{{ url()->previous() }}" class="flex-shrink-0 inline-flex items-center bg-white text-indigo-600 hover:bg-gray-100 transition duration-300 px-4 py-2 rounded-lg shadow-md font-semibold">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    <span>Kembali</span>
                </a>
            </header>

            <!-- Student Details Layout -->
            <div class="space-y-8">
                <!-- Top Grid Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column: Profile & Academic Info -->
                    <div class="lg:col-span-1 space-y-8 flex flex-col justify-center">
                        <!-- Profile Card -->
                        <div class="bg-white p-6 rounded-xl shadow-md">
                            <div class="flex flex-col items-center">
                                <img class="h-24 w-24 rounded-full object-cover mb-4 border-4 border-indigo-200" src="https://ui-avatars.com/api/?name={{ urlencode($siswa->name) }}&background=667eea&color=fff&size=128" alt="Foto Siswa">
                                <h2 class="text-xl font-bold text-gray-800">{{ $siswa->name }}</h2>
                                <p class="text-sm text-gray-500">{{ $siswa->username }}</p>
                                {{-- <span class="mt-2 text-xs font-semibold px-3 py-1 rounded-full {{ $siswa->kelas && !$siswa->kelas->angkatan->is_alumni ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $siswa->kelas && !$siswa->kelas->angkatan->is_alumni ? 'Siswa Aktif' : 'Tidak Aktif/Alumni' }}
                                </span> --}}
                                @if ($siswa->kelas && $siswa->kelas->angkatan && $siswa->kelas->angkatan->is_alumni)
                                    <span class="mt-2 text-xs font-semibold px-3 py-1 rounded-full bg-gray-100 text-gray-800">
                                        Alumni
                                    </span>
                                @elseif ($siswa->kelas)
                                    <span class="mt-2 text-xs font-semibold px-3 py-1 rounded-full bg-green-100 text-green-800">
                                        Siswa Aktif
                                    </span>
                                @else
                                    <span></span>
                                @endif
                            </div>
                        </div>

                        <!-- Academic Info Card -->
                        <div class="bg-white p-6 rounded-xl shadow-md">
                            <h3 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-4">Informasi Akademik</h3>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Kelas</span>
                                    <span class="font-medium text-gray-800">{{ $siswa->kelas->nama_kelas ?? 'Belum ada kelas' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Angkatan</span>
                                    <span class="font-medium text-gray-800">{{ $siswa->kelas->angkatan->angkatan ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Tanggal Masuk</span>
                                    <span class="font-medium text-gray-800">{{ $siswa->tanggal_masuk ? \Carbon\Carbon::parse($siswa->tanggal_masuk)->isoFormat('D MMMM YYYY') : '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Detailed Info & School Year -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Detailed Info Card -->
                        <div class="bg-white p-6 rounded-xl shadow-md">
                            <h3 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-4">Data Lengkap Siswa</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                                <div>
                                    <label class="block text-gray-500">NISN/NIK</label>
                                    <p class="font-medium text-gray-800">{{ $siswa->nisn_nik ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-gray-500">Jenis Kelamin</label>
                                    <p class="font-medium text-gray-800">{{ $siswa->jenis_kelamin ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-gray-500">Tempat Lahir</label>
                                    <p class="font-medium text-gray-800">{{ $siswa->tempat_lahir ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-gray-500">Tanggal Lahir</label>
                                    <p class="font-medium text-gray-800">{{ $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM YYYY') : '-' }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-gray-500">Alamat</label>
                                    <p class="font-medium text-gray-800">{{ $siswa->alamat ?? '-' }}</p>
                                </div>
                                <div class="md:col-span-2 pt-4 mt-4 border-t">
                                    <h4 class="text-md font-semibold text-gray-700 mb-2">Informasi Wali</h4>
                                </div>
                                <div>
                                    <label class="block text-gray-500">Nama Orang Tua/Wali</label>
                                    <p class="font-medium text-gray-800">{{ $siswa->nama_orang_tua ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-gray-500">No. Telepon Wali</label>
                                    <p class="font-medium text-gray-800">{{ $siswa->no_telp ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-gray-500">Gaji Orang Tua</label>
                                    <p class="font-medium text-gray-800">{{ $siswa->gaji_orang_tua ? 'Rp ' . number_format(str_replace('.', '', $siswa->gaji_orang_tua), 0, ',', '.') : '-' }}</p>
                                </div>
                                <div>
                                    <label class="block text-gray-500">Jumlah Saudara</label>
                                    <p class="font-medium text-gray-800">{{ $siswa->jumlah_sodara ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="mt-8 flex justify-end">
                                <a href="{{ route('editSiswa', $siswa->id) }}" class="bg-indigo-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-indigo-700 transition duration-300 flex items-center shadow-md hover:shadow-lg">
                                    <i class="fa-solid fa-pencil mr-2"></i>
                                    Edit Data Siswa
                                </a>
                            </div>
                        </div>

                        <!-- School Year Info Card -->
                        <div class="bg-white p-6 rounded-xl shadow-md">
                            <h3 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-4">Informasi Tahun Ajaran</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                                <div>
                                    <label class="block text-gray-500">Tahun Ajaran</label>
                                    <p class="font-medium text-gray-800">{{ $siswa->angkatan->angkatan ?? '-'}}</p>
                                </div>
                                 <div>
                                    <label class="block text-gray-500">Tingkat</label>
                                    <p class="font-medium text-gray-800">
                                        <span class="bg-blue-100 text-blue-800 font-medium py-1 px-3 rounded-full text-xs">Tingkat {{ $siswa->kelas->angkatan->idtingkat->tingkat ?? '-'}}</span>
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-gray-500">Tanggal Mulai</label>
                                    <p class="font-medium text-gray-800">{{ $siswa->angkatan?->tanggal_mulai ? \Carbon\Carbon::parse($siswa->angkatan->tanggal_mulai)->isoFormat('D MMMM YYYY') : '-'}}</p>
                                </div>
                                <div>
                                    <label class="block text-gray-500">Tanggal Selesai</label>
                                    <p class="font-medium text-gray-800">{{ $siswa->angkatan?->tanggal_selesai ? \Carbon\Carbon::parse($siswa->angkatan->tanggal_selesai)->isoFormat('D MMMM YYYY') : '-'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section: KBM History Table -->
                <div class="bg-white rounded-xl shadow-md max-h-[70vh] flex flex-col">
                    <h3 class="text-lg font-semibold text-gray-800 border-b p-6 mb-0 flex-shrink-0">
                        Histori KBM Semester
                    </h3>
                    
                    <!-- Scrollable content -->
                    <div class="overflow-y-auto flex-1">
                        <table class="w-full min-w-full text-left text-sm">
                            <thead class="bg-gray-50 sticky top-0 z-10">
                                <tr>
                                    <th class="px-6 py-3 font-medium text-gray-500 uppercase">Tahun Ajaran</th>
                                    <th class="px-6 py-3 font-medium text-gray-500 uppercase">Semester</th>
                                    <th class="px-6 py-3 font-medium text-gray-500 uppercase">Tingkat</th>
                                    <th class="px-6 py-3 font-medium text-gray-500 uppercase text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse ($historiKBMs ?? [] as $historiKBM)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $historiKBM['angkatan'] }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $historiKBM['semester'] }}</td>
                                    <td class="px-6 py-4 text-gray-600">Tingkat {{ $historiKBM['tingkat'] }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @if (request()->routeIs('lihatDetailSiswa'))
                                        <a href="{{ route('historyKBM', [$siswa->id, $historiKBM['id_tingkat'], $historiKBM['semester']])}}"
                                        class="bg-indigo-100 text-indigo-700 font-semibold py-1.5 px-4 rounded-lg hover:bg-indigo-200 transition duration-300">
                                            Masuk
                                        </a>
                                        @elseif (request()->routeIs('detailSiswaAlumni'))
                                        <a href="{{ route('historyKBMAlumni', [$siswa->id, $historiKBM['id_tingkat'], $historiKBM['semester']])}}"
                                        class="bg-indigo-100 text-indigo-700 font-semibold py-1.5 px-4 rounded-lg hover:bg-indigo-200 transition duration-300">
                                            Masuk
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-500">Tidak ada data histori KBM.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- Sidebar Toggle ---
        const menuButton = document.getElementById('menu-button');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        if(menuButton && sidebar && overlay) {
            const toggleSidebar = () => {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            };
            menuButton.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);
        }
    });
</script>

</body>
</html>