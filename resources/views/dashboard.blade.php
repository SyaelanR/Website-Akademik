<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Manajemen Sekolah</title>
    <!-- Tailwind CSS CDN -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('asset/school-solid-full.png') }}">
    <style>
        /* Custom styles */
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        /* Sidebar transition */
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
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
            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('dashboard')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-tachometer-alt w-6 mr-3"></i>
                <span>Dashboard</span>
            </a>

            @can('view-admin')
            <a href="{{ route('admin.profile') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('admin.profile')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-user-circle mr-3"></i>
                <span>Profil</span>
            </a>
            <a href="{{ route('manajemenSiswa') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajemenSiswa')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-user-graduate w-6 mr-3"></i>
                <span>Manajemen Siswa</span>
            </a>
            <a href="{{ route('manajemenGuru') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajemenGuru')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-chalkboard-user w-6 mr-3"></i>
                <span>Manajemen Guru</span>
            </a>
            <a href="{{ route('manajemenMapel') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajemenMapel')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-book w-6 mr-3"></i>
                <span>Manajemen Mapel</span>
            </a>
            <a href="{{ route('manajemenKelas') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajemenKelas')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-door-closed w-6 mr-3"></i>
                <span>Manajemen Kelas</span>
            </a>
            <a href="{{ route('manajemenJadwal')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajemenJadwal')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-calendar-alt w-6 mr-3"></i>
                <span>Manajemen Jadwal</span>
            </a>
            <a href="{{ route('manajAcara')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajAcara')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-calendar-check mr-3"></i>
                <span>Acara</span>
            </a>
            <a href="{{ route('manajemenAngkatan') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajemenAngkatan')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-bookmark w-6 mr-3"></i>
                <span>Angkatan</span>
            </a>
            <a href="{{ route('manajemenRapor') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajemenRapor')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-book-open w-6 mr-3"></i>
                <span>Rapor</span>
            </a>
            <a href="{{ route('manajemenKurikulum') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajemenKurikulum')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-book-open-reader w-6 mr-3"></i>
                <span>Kurikulum</span>
            </a>
            <a href="{{ route('manajemenTingkat') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajemenTingkat')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-layer-group w-6 mr-3"></i>
                <span>Tingkat</span>
            </a>
            <a href="{{ route('manajemenAlumni') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('historyKBMAlumni')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-user-friends w-6 mr-3"></i>
                <span>Manajemen Alumni</span>
            </a>
            @endcan

            @can('view-guru')
            <a href="{{ route('guru.profile') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('guru.profile')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-user-circle mr-3"></i>
                <span>Profil</span>
            </a>
            <a href="{{ route('lihatjadwalG') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatjadwalG')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-calendar-days w-6 mr-3"></i>
                <span>Jadwal Mengajar</span>
            </a>
            <a href="{{ route('manajAbsensi') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajAbsensi')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-list-check w-6 mr-3"></i>
                <span>Input Absensi</span>
            </a>
            <a href="{{ route('manajMateri') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajMateri')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-book-open-reader mr-3"></i>
                <span>Input Materi</span>
            </a>
            <a href="{{ route('manajTugas') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajTugas')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-file-pen w-6 mr-3"></i>
                <span>Input Tugas</span>
            </a>
            <a href="{{ route('manajemenNilai') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajemenNilai')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-pen w-6 mr-3"></i>
                <span>Input Nilai</span>
            </a>
            <a href="{{ route('manajPengumuman') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('manajPengumuman')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-bullhorn w-6 mr-3"></i>
                <span>Pengumuman</span>
            </a>
            @endcan

            @can('view-siswa')
            <a href="{{ route('siswa.profile')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('siswa.profile')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-user-circle mr-3"></i>
                <span>Profil</span>
            </a>
            <a href="{{ route('lihatJadwalS') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatJadwalS')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-calendar-days w-6 mr-3"></i>
                <span>Lihat Jadwal</span>
            </a>
            <a href="{{ route('lihatMateriMapel') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatMateriMapel') || request()->routeIs('lihatDaftarMateri')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-book-open w-6 mr-3"></i>
                <span>Lihat Materi</span>
            </a>
            <a href="{{ route('lihatTugasMapel') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatTugasMapel') || request()->routeIs('lihatTugasDaftar')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-upload w-6 mr-3"></i>
                <span>Lihat Tugas</span>
            </a>
             <a href="{{ route('lihatAbsensi') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatAbsensi') || request()->routeIs('lihatAbsensi.perMapel')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-list-check w-6 mr-3"></i>
                <span>Lihat Absensi</span>
            </a>
            <a href="{{ route('lihatNilaiMapel')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatNilaiMapel') || request()->routeIs('lihatNilaiDaftar')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-pen w-6 mr-3"></i>
                <span>Lihat Nilai</span>
            </a>
            <a href="{{ route('lihatPengumumanSiswa')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatPengumumanSiswa')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-bullhorn w-6 mr-3"></i>
                <span>Pengumuman</span>
            </a>
            <a href="{{ route('lihatAcaraSiswa')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatAcaraSiswa')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif" >
                <i class="fa-solid fa-calendar-check mr-3"></i>
                <span>Acara</span>
            </a>
            <a href="{{ route('KRS')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatAcaraSiswa')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-id-card mr-3"></i>
                <span>KRS</span>
            </a>
            @endcan

            @can('view-adminDev')
            <a href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-users mr-3"></i>
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
    </aside>

    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <!-- Header -->
        <header class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-30">
            <!-- Mobile Menu Button -->
            <button id="menu-button" class="lg:hidden text-gray-600 focus:outline-none">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Selamat Datang</h1>
            <div class="flex items-center space-x-4">
                
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1">
            <!-- Welcome Banner -->
            <div class="bg-indigo-600 rounded-xl shadow-lg p-8 mb-8 text-white">
                <h2 class="text-3xl font-bold mb-2">{{$username ?? 'Pengguna'}}</h2>
                <p class="text-indigo-200">{{$time ?? ''}}</p>
            </div>

            @can('view-admin')
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Total Siswa</p>
                        <p class="text-3xl font-bold text-gray-800">{{$jumlahSiswa ?? 0}}</p>
                    </div>
                    <div class="bg-indigo-100 text-indigo-600 p-4 rounded-full">
                        <i class="fa-solid fa-user-graduate text-2xl"></i>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Total Guru</p>
                        <p class="text-3xl font-bold text-gray-800">{{$jumlahGuru ?? 0}}</p>
                    </div>
                    <div class="bg-teal-100 text-teal-600 p-4 rounded-full">
                        <i class="fa-solid fa-chalkboard-user text-2xl"></i>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Kelas</p>
                        <p class="text-3xl font-bold text-gray-800">{{$jumlahKelas ?? 0}}</p>
                    </div>
                    <div class="bg-orange-100 text-orange-600 p-4 rounded-full">
                        <i class="fa-solid fa-school-flag text-2xl"></i>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Acara Mendatang</p>
                        <p class="text-3xl font-bold text-gray-800">{{$jumlahAcara ?? 0}}</p>
                    </div>
                    <div class="bg-pink-100 text-pink-600 p-4 rounded-full">
                        <i class="fa-solid fa-calendar-check text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Main Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Students Overview -->
                <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Ringkasan Kehadiran Siswa</h3>
                    <p class="text-gray-500 mb-6">Data kehadiran untuk minggu ini.</p>
                    <div class="h-64 rounded-lg">
                        <canvas id="attendanceChartAdmin"></canvas>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Akses Cepat</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('tambahSiswa')}}" class="flex items-center p-3 bg-indigo-50 hover:bg-indigo-100 rounded-lg text-indigo-700 font-medium transition duration-300"><i class="fa-solid fa-plus-circle mr-3"></i> Tambah Siswa Baru</a></li>
                        <li><a href="{{ route('tambahGuru')}}" class="flex items-center p-3 bg-teal-50 hover:bg-teal-100 rounded-lg text-teal-700 font-medium transition duration-300"><i class="fa-solid fa-chalkboard-user mr-3"></i> Tambah Guru Baru </a></li>
                        <li><a href="{{ route('manajAcara')}}" class="flex items-center p-3 bg-pink-50 hover:bg-pink-100 rounded-lg text-pink-700 font-medium transition duration-300"><i class="fa-solid fa-calendar-plus mr-3"></i> Tambah Acara Sekolah</a></li>
                    </ul>
                </div>
            </div>
            @endcan

            @can('view-guru')
                {{-- GURU --}}
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-md flex items-center space-x-4">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fa-solid fa-calendar-day text-2xl text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-500">Jadwal Hari Ini</p>
                            <p class="text-2xl font-bold text-gray-800">{{$jumlahSesi ?? 0}} Sesi</p>
                        </div>
                    </div>
                </div>

                <!-- Main Grid Layout -->
                <div class="grid grid-cols-1 gap-8">
                    <!-- Left Column: Schedule --> 
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Jadwal Mengajar Hari Ini</h3>
                        <div class="space-y-4">
                            <!-- Schedule Item -->
                            @forelse ($jadwalHariIni ?? [] as $jadwal)
                            <div class="flex items-center bg-gray-50 p-4 rounded-lg">
                                <div class="w-20 text-center mr-4">
                                    <p class="font-bold text-green-600 text-lg">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}</p>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</p>
                                </div>
                                <div class="border-l-4 border-green-500 pl-4 flex-1">
                                    <p class="font-semibold text-gray-800">{{$jadwal->mapel->nama_mapel}}</p>
                                    <p class="text-sm text-gray-600"><i class="fa-solid fa-users mr-2"></i>{{$jadwal->kelas->nama_kelas}}&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-house mr-1"></i> {{$jadwal->ruangan}}</p>
                                </div>
                            </div>
                             @empty
                            <div class="text-center text-gray-500 py-10">
                                <i class="fa-solid fa-calendar-xmark text-4xl mb-4"></i>
                                <p class="text-lg">Tidak ada jadwal mengajar hari ini.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Shortcuts -->
                     <div class="bg-white p-6 rounded-xl shadow-md">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Pintasan</h3>
                        <div class="space-y-3">
                           <a href="{{ route('lihatjadwalG') }}" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                               <i class="fa-solid fa-calendar-alt text-xl text-indigo-600 mr-4"></i>
                               <span class="font-medium text-gray-700">Lihat Semua Jadwal</span>
                           </a>
                           <a href="{{ route('manajemenNilai') }}" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                               <i class="fa-solid fa-pen-to-square text-xl text-green-600 mr-4"></i>
                               <span class="font-medium text-gray-700">Input Nilai Siswa</span>
                           </a>
                           <a href="{{ route('manajAbsensi') }}" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                               <i class="fa-solid fa-calendar-check text-xl text-yellow-600 mr-4"></i>
                               <span class="font-medium text-gray-700">Input Absensi Kelas</span>
                           </a>
                        </div>
                    </div>
                </div>
                @endcan


            @can('view-siswa')
            {{-- SISWA --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Kolom Kiri: Jadwal & Keuangan -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Jadwal Pelajaran -->
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Jadwal Pelajaran Hari Ini</h3>
                        <div class="h-[500px] overflow-y-auto pr-2">
                            {{-- Ganti dengan @forelse ($jadwals as $jadwal) di aplikasi Laravel Anda --}}

                            {{-- Tampilan jika jadwal kosong --}}
                            @forelse ($jadwalHariIni ?? [] as $jadwal)
                            <div class="flex items-center bg-gray-50 p-4 rounded-lg">
                                <div class="w-20 text-center mr-4">
                                    <p class="font-bold text-green-600 text-lg">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}</p>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</p>
                                </div>
                                <div class="border-l-4 border-green-500 pl-4 flex-1">
                                    <p class="font-semibold text-gray-800">{{$jadwal->mapel->nama_mapel}}</p>
                                    <p class="text-sm text-gray-600"><i class="fa-solid fa-user mr-2"></i>{{$jadwal->mapel->guru->name}}&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-house mr-1"></i> {{$jadwal->ruangan}}</p>
                                </div>
                            </div>
                             @empty
                            <div class="flex items-center justify-center h-full">
                                <div class="text-center text-gray-400">
                                    <i class="fa-solid fa-calendar-check text-4xl mb-2"></i>
                                    <p class="font-medium">Tidak ada jadwal pelajaran hari ini.</p>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- Kolom Kanan: Kehadiran & Tagihan -->
                <div class="space-y-8">
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Persentase Kehadiran</h3>
                        <div class="w-full h-48 flex items-center justify-center">
                            <canvas id="attendanceChart"></canvas>
                        </div>
                    </div>
                     <div class="bg-white p-6 rounded-xl shadow-md">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Daftar Tagihan</h3>
                        <div class="h-[180px] overflow-y-auto ">
                            <table class="w-full text-sm">
                                <tbody>
                                    <div class="bg-white p-6 rounded-xl shadow-md">
                                        <!-- Konten "Coming Soon" -->
                                        <div class="w-full h-48 flex items-center justify-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                            <div class="text-center text-gray-500">
                                                <!-- Ikon jam (opsional, menggunakan SVG) -->
                                                <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <p class="mt-3 text-lg font-semibold">Coming soon</p>
                                                <p class="text-sm">Fitur Segera Hadir!!</p>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <tr class="border-b">
                                        <td class="py-3 pr-2">SPP Bulan September</td>
                                        <td class="py-3 text-right"><span class="bg-red-100 text-red-700 font-medium py-1 px-3 rounded-full text-xs">Belum Lunas</span></td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3 pr-2">Uang Buku Paket</td>
                                        <td class="py-3 text-right"><span class="bg-green-100 text-green-700 font-medium py-1 px-3 rounded-full text-xs">Lunas</span></td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3 pr-2">Uang Buku Paket</td>
                                        <td class="py-3 text-right"><span class="bg-green-100 text-green-700 font-medium py-1 px-3 rounded-full text-xs">Lunas</span></td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3 pr-2">Uang Buku Paket</td>
                                        <td class="py-3 text-right"><span class="bg-green-100 text-green-700 font-medium py-1 px-3 rounded-full text-xs">Lunas</span></td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3 pr-2">Uang Buku Paket</td>
                                        <td class="py-3 text-right"><span class="bg-green-100 text-green-700 font-medium py-1 px-3 rounded-full text-xs">Lunas</span></td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- === KARTU PENGUMUMAN DAN ACARA DIMULAI DI SINI === -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card Pengumuman -->
                <div class="bg-white p-6 rounded-xl shadow-md h-96 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Pengumuman Terbaru</h3>
                        <a href="{{ route('lihatPengumumanSiswa')}}" class="text-sm font-medium text-indigo-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="space-y-4 overflow-y-auto pr-2">
                        <!-- Item Pengumuman 1 -->
                        @forelse ($DaftarPengumuman ?? [] as $pengumuman) {{-- Variabel ini mungkin tidak ada lagi, tambahkan pengecekan jika perlu --}}
                        <div class="border-l-4 border-orange-400 pl-4 py-2">
                            <h4 class="font-semibold text-gray-900">{{$pengumuman->judul}}</h4>
                            <p class="text-sm text-gray-600 line-clamp-2">{{$pengumuman->isi}}</p>
                            <span class="text-xs text-gray-400">Tgl: {{ \Carbon\Carbon::parse($pengumuman->created_at)->format('d M Y') }}</span>
                        </div>
                        @empty
                        <!-- Card Kosong -->
                            <div class="flex flex-col items-center justify-center p-8 bg-white rounded-xl shadow-sm border border-dashed border-gray-300 text-center">
                                <!-- Ikon -->
                                <div class="bg-orange-100 text-orange-500 p-3 rounded-full mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M12 18a9 9 0 110-18 9 9 0 010 18z" />
                                    </svg>
                                </div>
                                <!-- Pesan -->
                                <h3 class="text-gray-800 font-semibold text-lg mb-1">Belum Ada Pengumuman</h3>
                            </div>
                        @endforelse
                        
                    </div>
                </div>

                <!-- Card Acara Sekolah -->
                <div class="bg-white p-6 rounded-xl shadow-md h-96 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Acara Sekolah</h3>
                        <a href="{{ route('lihatAcaraSiswa')}}" class="text-sm font-medium text-indigo-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="space-y-4 overflow-y-auto pr-2">
                        @forelse ($daftarAcara ?? [] as $acara)
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-red-100 text-red-600 flex flex-col items-center justify-center rounded-lg font-bold flex-shrink-0">
                                <span class="text-2xl leading-none">{{ \Carbon\Carbon::parse($acara->tanggal_mulai)->format('d') }}</span>
                                <span class="text-xs uppercase">{{ \Carbon\Carbon::parse($acara->tanggal_mulai)->format('M') }}</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-base">{{ $acara->judul_acara ?? 'Tanpa Judul' }}</h4>

                                @if(\Carbon\Carbon::parse($acara->tanggal_mulai)->isSameDay($acara->tanggal_selesai))
                                    <p class="text-sm text-gray-600 flex items-center mt-1">
                                        <i class="fa-solid fa-calendar-day w-4 mr-2 text-gray-500"></i>
                                        {{ \Carbon\Carbon::parse($acara->tanggal_mulai)->format('d M Y') }}
                                    </p>
                                @else
                                    <p class="text-sm text-gray-600 flex items-center mt-1">
                                        <i class="fa-solid fa-calendar-day w-4 mr-2 text-gray-500"></i>
                                        {{ \Carbon\Carbon::parse($acara->tanggal_mulai)->format('d M Y') }}
                                        <span class="mx-1">–</span>
                                        {{ \Carbon\Carbon::parse($acara->tanggal_selesai)->format('d M Y') }}
                                    </p>
                                @endif

                                <p class="text-sm text-gray-600 flex items-center mt-0.5">
                                    <i class="fa-solid fa-clock w-4 mr-2 text-gray-500"></i>
                                    {{ \Carbon\Carbon::parse($acara->tanggal_mulai)->format('H:i') }} –
                                    {{ \Carbon\Carbon::parse($acara->tanggal_selesai)->format('H:i') }}
                                </p>

                                <p class="text-sm text-gray-600 flex items-center mt-0.5">
                                    <i class="fa-solid fa-location-dot w-4 mr-2 text-gray-500"></i>
                                    {{ $acara->lokasi }}
                                </p>
                            </div>
                        </div>
                        @empty
                        <!-- Card kosong (tidak ada acara) -->
                            <div class="flex flex-col items-center justify-center p-8 bg-white rounded-xl shadow-sm border border-dashed border-gray-300 text-center">
                                <!-- Ikon -->
                                <div class="bg-red-100 text-red-500 p-3 rounded-full mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10m-9 8h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <!-- Pesan -->
                                <h3 class="text-gray-800 font-semibold text-lg mb-1">Belum Ada Acara</h3>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- === KARTU PENGUMUMAN DAN ACARA BERAKHIR DI SINI === -->

            @endcan

            @can('view-adminDev')
            {{-- ADMINDEV --}}
            <div class="flex flex-col md:flex-row items-center justify-between mb-8">
                <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between w-full md:w-auto mb-4 md:mb-0">
                    <div>
                        <p class="text-gray-500">Total Klien</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $jumlahClien ?? 0}}</p>
                    </div>
                    <div class="bg-indigo-100 text-indigo-600 p-4 rounded-full">
                        <i class="fa-solid fa-users text-2xl"></i>
                    </div>
                </div>
                <a href="{{ route('tambahKlien') }}">
                    <button class="bg-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-indigo-700 transition duration-300 w-full md:w-auto">
                        <i class="fa-solid fa-plus-circle mr-2"></i> Tambah Klien
                    </button>
                </a>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-xl font-semibold mb-6 text-gray-800">Daftar Klien</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Klien</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Sekolah</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200"> 
                            @forelse ($cliens as $clien)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$clien->id_sekolah}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$clien->nama_sekolah}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$clien->email}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($clien->status == 'Aktif')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                    @elseif ($clien->status == 'Pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    @elseif ($clien->status == 'Non-Aktif')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Non Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('infoKlien', ['id_sekolah' => $clien->id_sekolah]) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Info</a>
                                    <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-3 text-center text-gray-500">
                                    <div class="text-center py-12">
                                        <i class="fa-solid fa-exclamation-circle text-5xl text-gray-400 mb-4"></i>
                                        <p class="text-gray-600 font-semibold text-lg">Belum ada data Klien.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endcan

        </main>
    </div>
</div>

<script>
    const menuButton = document.getElementById('menu-button');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    const toggleSidebar = () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    };

    menuButton.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);

    document.addEventListener('DOMContentLoaded', () => {
        // Chart for Siswa
    const totalAbsensi = @json($totalAbsensi ?? []);

    // Hitung total kehadiran
    const total = Object.values(totalAbsensi).reduce((a, b) => a + b, 0);

    // Hitung persentase masing-masing status
    const persentaseAbsensi = Object.fromEntries(
        Object.entries(totalAbsensi).map(([key, val]) => [key, total ? ((val / total) * 100).toFixed(1) : 0])
    );

    if (document.getElementById('attendanceChart')) {
        const ctx = document.getElementById('attendanceChart').getContext('2d');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(persentaseAbsensi), // ['Hadir', 'Izin', 'Sakit', 'Alfa']
                datasets: [{
                    label: 'Persentase Kehadiran (%)',
                    data: Object.values(persentaseAbsensi), // [persen Hadir, Izin, Sakit, Alfa]
                    backgroundColor: [
                        'rgba(79, 70, 229, 0.8)',   // Hadir
                        'rgba(251, 191, 36, 0.8)',  // Izin
                        'rgba(59, 130, 246, 0.8)',  // Sakit
                        'rgba(239, 68, 68, 0.8)'    // Alfa
                    ],
                    borderColor: [
                        '#4f46e5',
                        '#fbbf24',
                        '#3b82f6',
                        '#ef4444'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed.toFixed(1) + '%';
                            }
                        }
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
});

// Chart for Admin
if (document.getElementById('attendanceChartAdmin')) {
     const ctxAdmin = document.getElementById('attendanceChartAdmin').getContext('2d');
    new Chart(ctxAdmin, {
        type: 'bar', // Bar chart for admin
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            datasets: [{
                label: 'Kehadiran (%)',
                // data: [95, 92, 98, 96, 94, 90], // Sample data
                data: @json($totalAbsensiHarianHadir ?? []),
                backgroundColor: 'rgba(79, 70, 229, 0.8)',
                borderColor: '#4f46e5',
                borderWidth: 1
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
}
</script>

</body>
</html>
