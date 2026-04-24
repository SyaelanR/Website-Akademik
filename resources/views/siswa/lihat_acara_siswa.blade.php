<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acara Sekolah - EduSys</title>
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
        .event-card > div { width: 100%; }
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
            <a href="{{ route('KRS')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('KRS')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
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
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Acara Sekolah</h1> 
            <div class="flex items-center space-x-4">
                
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1">
            <!-- Content Header -->
            <header class="mb-8 bg-indigo-600 p-8 rounded-2xl shadow-lg text-white">
                <h2 class="text-3xl font-bold mb-2">Kalender Acara Sekolah</h2>
                <p class="text-indigo-200">Lihat semua kegiatan, jadwal, dan acara penting sekolah yang akan datang.</p>
            </header>

            <div class="bg-white p-6 rounded-xl shadow-md">
                <!-- Action Bar -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Acara</h2>
                </div>
                
                <!-- Card View Acara -->
                <div class="grid grid-cols-1 gap-6" id="event-list-container">
                    @forelse($daftarAcara ?? [] as $acara)
                        @php
                            $isPast = \Carbon\Carbon::parse($acara->tanggal_selesai)->lt(\Carbon\Carbon::now());
                        @endphp

                        <div class="event-card" 
                             data-judul="{{ e($acara->judul_acara) }}"
                             data-deskripsi="{{ e($acara->deskripsi) }}"
                             data-lokasi="{{ e($acara->lokasi) }}"
                             data-peserta="{{ e($acara->peserta) }}">
                            <div class="{{ $isPast ? 'bg-white rounded-xl shadow-lg overflow-hidden opacity-80 border-t-4 border-gray-400 w-full' : 'bg-white rounded-xl shadow-2xl overflow-hidden transform hover:scale-[1.01] transition duration-300 border-t-4 border-indigo-500 w-full' }}">
                                <div class="p-5">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-xl font-bold text-gray-800 leading-snug">{{ $acara->judul_acara }}</h3>
                                        @if($isPast)
                                            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-gray-100 text-gray-600 whitespace-nowrap">
                                                <i class="fa-solid fa-check mr-1"></i> Selesai
                                            </span>
                                        @else
                                            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-blue-100 text-blue-800 whitespace-nowrap">
                                                <i class="fa-solid fa-user-tie mr-1"></i> Mendatang
                                            </span>
                                        @endif
                                    </div>

                                    <p class="text-sm text-gray-600 mb-4">{{ $acara->deskripsi }}</p>

                                    <div class="space-y-2 text-sm text-gray-700 mb-5">
                                        @if(\Carbon\Carbon::parse($acara->tanggal_mulai)->isSameDay($acara->tanggal_selesai))
                                            <p><i class="fa-solid fa-calendar-day w-5 mr-2 {{ $isPast ? 'text-gray-500' : 'text-indigo-500' }}"></i> {{ \Carbon\Carbon::parse($acara->tanggal_mulai)->isoFormat('D MMMM YYYY') }}</p>
                                        @else
                                            <p><i class="fa-solid fa-calendar-day w-5 mr-2 {{ $isPast ? 'text-gray-500' : 'text-indigo-500' }}"></i> {{ \Carbon\Carbon::parse($acara->tanggal_mulai)->isoFormat('D MMMM YYYY') }} - {{ \Carbon\Carbon::parse($acara->tanggal_selesai)->isoFormat('D MMMM YYYY') }}</p>
                                        @endif
                                        <p><i class="fa-solid fa-clock w-5 mr-2 {{ $isPast ? 'text-gray-500' : 'text-indigo-500' }}"></i> {{ \Carbon\Carbon::parse($acara->tanggal_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($acara->tanggal_selesai)->format('H:i') }}</p>
                                        <p><i class="fa-solid fa-location-dot w-5 mr-2 {{ $isPast ? 'text-gray-500' : 'text-indigo-500' }}"></i> {{ $acara->lokasi }}</p>
                                    </div>
                                    
                                    <div class="flex justify-between items-center border-t pt-4">
                                        <span class="text-xs font-medium text-gray-500">
                                            <i class="fa-solid fa-user-group mr-1"></i> {{ $acara->peserta }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div id="empty-state" class="w-full flex flex-col items-center justify-center text-center p-10 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                            <i class="fa-solid fa-calendar-xmark text-5xl text-gray-400 mb-3"></i>
                            <h3 class="text-lg font-semibold text-gray-600">Belum ada acara</h3>
                            <p class="text-sm text-gray-500 mt-1">Saat ini belum ada acara sekolah yang dijadwalkan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Sidebar ---
        const menuButton = document.getElementById('menu-button');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        menuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        // --- Search ---
        const searchInput = document.getElementById('search-input');
        const emptyState = document.getElementById('empty-state');
        searchInput.addEventListener('keyup', () => {
            const term = searchInput.value.toLowerCase().trim();
            const eventCards = document.querySelectorAll('.event-card');
            let visibleCount = 0;

            eventCards.forEach(card => {
                const title = (card.getAttribute('data-judul') || '').toLowerCase();
                const desc = (card.getAttribute('data-deskripsi') || '').toLowerCase();
                const lokasi = (card.getAttribute('data-lokasi') || '').toLowerCase();
                const peserta = (card.getAttribute('data-peserta') || '').toLowerCase();

                const isVisible = title.includes(term) || desc.includes(term) || lokasi.includes(term) || peserta.includes(term);
                card.style.display = isVisible ? '' : 'none';
                if (isVisible) visibleCount++;
            });

            if (emptyState) {
                emptyState.style.display = (visibleCount === 0 && eventCards.length > 0) ? 'flex' : 'none';
            }
        });
    });
</script>
</body>
</html>
