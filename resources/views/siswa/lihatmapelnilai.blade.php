<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Pelajaran - Sistem Manajemen Sekolah</title>
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
        /* Custom styles */
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
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
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar bg-white w-64 min-h-screen flex-shrink-0 shadow-lg fixed lg:relative z-50 transform -translate-x-full lg:translate-x-0">
        <div class="p-6">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                <i class="fa-solid fa-school text-3xl text-indigo-600"></i>
                <span class="text-2xl font-bold text-gray-800">EduSys</span>
            </a>
        </div>
        <nav class="mt-6">
            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('dashboard')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-tachometer-alt w-6 mr-3"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('siswa.profile') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('siswa.profile')) bg-indigo-50 text-indigo-600 @endif">
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
            <a href="{{ route('lihatAcaraSiswa')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatAcaraSiswa')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-calendar-check mr-3"></i>
                <span>Acara</span>
            </a>
            <a href="{{ route('KRS')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatAcaraSiswa')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-id-card mr-3"></i>
                <span>KRS</span>
            </a>
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
    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <!-- Header -->
        <header class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-30">
            <button id="menu-button" class="lg:hidden text-gray-600 focus:outline-none">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Pilih Mata Pelajaran</h1>
            <div class="flex items-center space-x-4">
                 
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1">
            <header class="mb-8 bg-indigo-600 p-8 rounded-2xl shadow-lg text-white">
                <h2 class="text-3xl font-bold mb-2">Nilai Pelajaran</h2>
                <p class="text-indigo-200">Pilih mata pelajaran untuk melihat nilai.</p>
            </header>

            <!-- Search Input -->
            <div class="mb-6">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari mapel atau guru..." class="w-full pl-10 pr-4 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <i class="fa-solid fa-search text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                </div>
            </div>

            <!-- Subjects Grid -->
            <div id="mapel-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                
                @forelse ($daftarMapel ?? [] as $mapel)
                <a href="{{ route('lihatNilaiDaftar', $mapel->mapel->id_mapel)}}" class="mapel-item block">
                    <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between h-full hover:shadow-lg hover:-translate-y-1 transform transition-all duration-300">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full">
                                    <i class="fa-solid fa-book-open text-xl"></i>
                                </div>
                            </div>
                            <h3 class="mapel-title text-xl font-bold text-gray-800 mb-2">{{$mapel->mapel->nama_mapel}}</h3>
                            <p class="guru-name text-gray-600 text-sm flex items-center"><i class="fa-solid fa-chalkboard-user w-4 mr-2 text-gray-400"></i>{{$mapel->mapel->guru->name}}</p>
                        </div>
                        <div class="border-t mt-4 pt-4">
                            <p class="text-sm font-semibold text-gray-700">SKS: <span class="font-bold text-indigo-600">{{$mapel->mapel->sks}}</span></p>
                        </div>
                    </div>
                </a>
                @empty
                <div id="empty-message" class="col-span-full text-center py-10 bg-white rounded-xl shadow-md">
                    <i class="fa-solid fa-folder-open text-5xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600 font-semibold text-lg">Belum ada mata pelajaran yang tersedia.</p>
                </div>
                @endforelse
            </div>
            <!-- No Results Message -->
            <div id="no-results" class="text-center py-12 hidden col-span-full bg-white rounded-xl shadow-md">
                <i class="fa-solid fa-magnifying-glass text-5xl text-gray-400 mb-4"></i>
                <p class="text-gray-600 font-semibold text-lg">Mata pelajaran tidak ditemukan.</p>
                <p class="text-gray-500 mt-2">Coba gunakan kata kunci yang berbeda.</p>
            </div>
        </main>
    </div>
</div>
    
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Sidebar Toggle ---
    const menuButton = document.getElementById('menu-button');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    const toggleSidebar = () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    };

    menuButton.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);

    // --- Search Functionality ---
    const searchInput = document.getElementById('searchInput');
    const mapelList = document.getElementById('mapel-list');
    const mapelItems = mapelList.querySelectorAll('.mapel-item');
    const noResults = document.getElementById('no-results');
    const emptyMessage = document.getElementById('empty-message');

    // Hanya jalankan script jika ada item mapel
    if (mapelItems.length > 0) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            let found = false;

            mapelItems.forEach(item => {
                const title = item.querySelector('.mapel-title').textContent.toLowerCase();
                const guru = item.querySelector('.guru-name').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || guru.includes(searchTerm)) {
                    item.style.display = 'block';
                    found = true;
                } else {
                    item.style.display = 'none';
                }
            });

            // Tampilkan atau sembunyikan pesan "tidak ditemukan"
            noResults.style.display = found ? 'none' : 'block';
        });
    }
});
</script>
</body>
</html>
