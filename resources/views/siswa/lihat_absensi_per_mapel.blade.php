<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi {{ $infoMapel->nama_mapel ?? 'Mapel' }} - Sistem Manajemen Sekolah</title>
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
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }
        .sidebar { transition: transform 0.3s ease-in-out; }
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
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <!-- Header -->
        <header class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-30">
            <button id="menu-button" class="lg:hidden text-gray-600 focus:outline-none">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Riwayat Absensi</h1>
        </header>

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1">
            <header class="mb-8 bg-indigo-600 p-8 rounded-2xl shadow-lg text-white">
                <h2 class="text-3xl font-bold mb-2">Riwayat Kehadiran: {{ $infoMapel->nama_mapel ?? 'Mata Pelajaran' }}</h2>
                <p class="text-indigo-200">Berikut adalah catatan kehadiran Anda pada mata pelajaran ini.</p>
            </header>
            
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('lihatAbsensi') }}" class="inline-flex items-center bg-gray-200 text-gray-700 hover:bg-gray-300 transition duration-300 px-4 py-2 rounded-lg shadow-sm font-semibold">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        <span>Pilih Mapel Lain</span>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[700px] text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Tanggal</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Status</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Keterangan Pertemuan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($daftarAbsensi as $absensi)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 text-gray-700 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($absensi->daftarAbsensi->tanggal ?? $absensi->created_at)->isoFormat('dddd, D MMMM YYYY') }}
                                </td>
                                <td class="p-3">
                                    @if ($absensi->status == 'Hadir')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Hadir
                                        </span>
                                    @elseif ($absensi->status == 'Sakit')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Sakit
                                        </span>
                                    @elseif ($absensi->status == 'Izin')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Izin
                                        </span>
                                    @elseif ($absensi->status == 'Alfa')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Alfa
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Belum Diisi
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3 text-gray-600">
                                    {{ $absensi->daftarAbsensi->keterangan ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-12">
                                    <i class="fa-solid fa-folder-open text-5xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-600 font-semibold text-lg">Belum ada data absensi untuk mata pelajaran ini.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
