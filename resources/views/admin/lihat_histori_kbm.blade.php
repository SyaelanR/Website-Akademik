<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori KBM Siswa - EduSys</title>
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
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }
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
            <a href="{{ route('manajemenSiswa') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('historyKBM')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
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
            <a href="{{ route('manajemenAlumni') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('historyKBMAlumni')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
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
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Histori KBM Siswa</h1>
            <div class="flex items-center space-x-4">
                <img class="h-10 w-10 rounded-full object-cover" src="https://placehold.co/100x100/667eea/ffffff?text=A" alt="User avatar">
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1">
            <!-- Header Section -->
            <header class="mb-8 bg-indigo-600 p-6 rounded-2xl shadow-lg text-white flex flex-col md:flex-row justify-between items-start gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">{{ $infoSiswa->siswa->name ?? '-'}}</h1>
                    <p class="text-indigo-200 mt-1">Histori KBM Tingkat {{ $infoSiswa->idTingkat->tingkat ?? '-'}}  - Semester {{ $infoSiswa->semester ?? '-'}}</p>
                </div>
                <div class="flex-shrink-0 flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <a href="{{ route('rapor', [$infoSiswa->siswa->id ?? 0, $infoSiswa->idTingkat->id_tingkat ?? 0, $infoSiswa->semester ?? '-']) }}" class="inline-flex items-center justify-center bg-white text-indigo-600 hover:bg-gray-100 transition duration-300 px-4 py-2 rounded-lg shadow-md font-semibold">
                        <i class="fa-solid fa-print mr-2"></i>
                        <span>Lihat Rapor</span>
                    </a>
                    <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center bg-indigo-500 text-white hover:bg-indigo-400 transition duration-300 px-4 py-2 rounded-lg shadow-md font-semibold">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </header>

            <!-- Main Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Daftar Nilai Card -->
                <div class="bg-white rounded-xl shadow-md flex flex-col">
                    <h3 class="text-lg font-semibold text-gray-800 border-b p-6">Daftar Nilai Semester Ini</h3>
                    <div class="overflow-y-auto h-[500px] flex-shrink-0">
                        <table class="w-full min-w-full text-left text-sm">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr>
                                    <th class="px-6 py-3 font-medium text-gray-500 uppercase">Mata Pelajaran</th>
                                    <th class="px-6 py-3 font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 font-medium text-gray-500 uppercase">Tipe Nilai</th>
                                    <th class="px-6 py-3 font-medium text-gray-500 uppercase text-center">Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <!-- Dummy Data Nilai -->
                                @forelse ($historyNilai ?? [] as $nilai)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $nilai->mapel->nama_mapel}}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $nilai->created_at ? \Carbon\Carbon::parse($nilai->created_at)->isoFormat('D MMM YYYY') : '-'}}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-blue-100 text-blue-800 font-medium py-1 px-3 rounded-full text-xs">{{ $nilai->daftarnilai->tipe_nilai}}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center font-semibold text-lg text-gray-700">{{ $nilai->nilai }}</td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Daftar Absensi Card -->
                <div class="bg-white rounded-xl shadow-md flex flex-col">
                    <h3 class="text-lg font-semibold text-gray-800 border-b p-6">Daftar Absensi Semester Ini</h3>
                    <div class="overflow-y-auto h-[500px] flex-shrink-0">
                        <table class="w-full min-w-full text-left text-sm">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr>
                                    <th class="px-6 py-3 font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 font-medium text-gray-500 uppercase">Mata Pelajaran</th>
                                    <th class="px-6 py-3 font-medium text-gray-500 uppercase">Kategori</th>
                                    <th class="px-6 py-3 font-medium text-gray-500 uppercase text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <!-- Dummy Data Absensi -->
                                @forelse ($historyAbsensi ?? [] as $absensi)
                                @if ($absensi->status == 'Hadir')
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-600">{{ $absensi->daftarAbsensi->tanggal ? \Carbon\Carbon::parse($absensi->daftarAbsensi->tanggal)->isoFormat('D MMM YYYY') : '-'}}</td>
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $absensi->mapel->nama_mapel }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $absensi->daftarAbsensi->kategori }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="bg-green-100 text-green-800 font-semibold py-1 px-3 rounded-full text-xs">{{ $absensi->status }}</span>
                                    </td>
                                </tr>
                                @elseif ($absensi->status == 'Sakit')
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-600">{{ $absensi->daftarAbsensi->tanggal ? \Carbon\Carbon::parse($absensi->daftarAbsensi->tanggal)->isoFormat('D MMM YYYY') : '-'}}</td>
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $absensi->mapel->nama_mapel }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $absensi->daftarAbsensi->kategori }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="bg-blue-100 text-blue-800 font-semibold py-1 px-3 rounded-full text-xs">Sakit</span>
                                    </td>
                                </tr>
                                @elseif ($absensi->status == 'Alfa')
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-600">{{ $absensi->daftarAbsensi->tanggal ? \Carbon\Carbon::parse($absensi->daftarAbsensi->tanggal)->isoFormat('D MMM YYYY') : '-'}}</td>
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $absensi->mapel->nama_mapel }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $absensi->daftarAbsensi->kategori }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="bg-red-100 text-red-800 font-semibold py-1 px-3 rounded-full text-xs">Alfa</span>
                                    </td>
                                </tr>
                                @elseif ($absensi->status == 'Izin')
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-600">{{ $absensi->daftarAbsensi->tanggal ? \Carbon\Carbon::parse($absensi->daftarAbsensi->tanggal)->isoFormat('D MMM YYYY') : '-'}}</td>
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $absensi->mapel->nama_mapel }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $absensi->daftarAbsensi->kategori }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="bg-yellow-100 text-yellow-800 font-semibold py-1 px-3 rounded-full text-xs">Izin</span>
                                    </td>
                                </tr>
                                @else
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-600">{{ $absensi->daftarAbsensi->tanggal ? \Carbon\Carbon::parse($absensi->daftarAbsensi->tanggal)->isoFormat('D MMM YYYY') : '-'}}</td>
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $absensi->mapel->nama_mapel }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $absensi->daftarAbsensi->kategori }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span>-</span>
                                    </td>
                                </tr>
                                @endif
                                @empty
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

