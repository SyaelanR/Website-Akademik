<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas - Sistem Manajemen Sekolah</title>
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
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen overflow-hidden">
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
            <a href="{{ route('manajemenSiswa') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
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
            <a href="{{ route('manajemenKelas') }}" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 transition duration-200">
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
            <a href="{{ route('manajemenAlumni') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
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
                <!-- Mobile Menu Button -->
                <button id="menu-button" class="lg:hidden text-gray-600 focus:outline-none">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>
                <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Edit Kelas</h1>
                <div class="flex items-center space-x-4">
                    
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-4 md:p-8 flex-1">
                @if (session('success'))
                    <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md flex justify-between items-center" role="alert">
                        <div>
                            <p class="font-bold">Berhasil!</p>
                            <p>{{ session('success') }}</p>
                        </div>
                        <button onclick="document.getElementById('success-alert').style.display='none'">&times;</button>
                    </div>
                @endif

                 {{-- Menampilkan error validasi --}}
                 @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                        <p class="font-bold">Gagal!</p>
                        <ul class="list-disc list-inside">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                 @endif

                <div class="bg-white rounded-xl shadow-md p-6 md:p-8 max-w-2xl mx-auto">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl sm:text-2xl font-semibold text-gray-800">Formulir Edit Kelas</h3>
                    </div>
                    <form action="{{ route('editKelas', $kelas->id_kelas) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="class-name" class="block text-gray-700 font-medium mb-2">Nama Kelas</label>
                            <input type="text" id="class-name" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" placeholder="Contoh: 10 IPA 1" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="wali-kelas" class="block text-gray-700 font-medium mb-2">Wali Kelas</label>
                            <input type="text" id="wali-kelas" name="wali_kelas" value="{{ old('wali_kelas', $kelas->wali_kelas) }}" placeholder="Contoh: Budi Setiawan, S.Pd." class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="jurusan" class="block text-gray-700 font-medium mb-2">Jurusan</label>
                            <input type="text" id="jurusan" name="jurusan" value="{{ old('jurusan', $kelas->jurusan) }}" placeholder="Contoh: Ilmu Pengetahuan Alam" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="mb-6">
                            <label for="class-year" class="block text-gray-700 font-medium mb-2">Angkatan</label>
                            <select name="id_angkatan" id="class-year" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-white" required>
                                <option value="" disabled>Pilih Angkatan</option>
                                @forelse ($angkatans as $angkatan)
                                    <option value="{{$angkatan->id_angkatan}}" {{ $kelas->id_angkatan == $angkatan->id_angkatan ? 'selected' : '' }}>
                                        {{$angkatan->angkatan}}
                                    </option>
                                @empty
                                    <option value="" disabled>Belum ada angkatan</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="flex flex-col sm:flex-row justify-end gap-4 mt-8">
                            <a href="{{ url()->previous() }}" class="text-center bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 transition duration-300">Batal</a>
                            <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Sidebar Toggle Functionality ---
            const menuButton = document.getElementById('menu-button');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            const toggleSidebar = () => {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            };

            if (menuButton) menuButton.addEventListener('click', toggleSidebar);
            if (overlay) overlay.addEventListener('click', toggleSidebar);

            // --- Auto-hide success alert ---
            const successAlert = document.getElementById('success-alert');
            if(successAlert) {
                setTimeout(() => {
                    successAlert.style.transition = 'opacity 0.5s ease';
                    successAlert.style.opacity = '0';
                    setTimeout(() => successAlert.style.display = 'none', 500);
                }, 5000); // Hide after 5 seconds
            }
        });
    </script>
</body>
</html>