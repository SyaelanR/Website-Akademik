<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru</title>
    
    <!-- Tailwind CSS CDN -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- SweetAlert2 for notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Style Dasar dan Scrollbar seperti pada file Siswa */
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f9; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }
        .sidebar { transition: transform 0.3s ease-in-out; }
        .sticky-header thead th {
            position: sticky;
            top: 0;
            z-index: 10;
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
        <nav class="mt-6 space-y-1">
            <!-- Navigasi disesuaikan untuk peran Guru -->
            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-tachometer-alt w-6 mr-3"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('guru.profile') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-user-tie w-6 mr-3"></i>
                <span>Profil Saya</span>
            </a>
            <a href="{{ route('lihatjadwalG') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-calendar-days w-6 mr-3"></i>
                <span>Jadwal Mengajar</span>
            </a>
            <a href="{{ route('manajAbsensi') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-list-check w-6 mr-3"></i>
                <span>Input Absensi</span>
            </a>
            <a href="{{ route('manajMateri') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-book-open-reader mr-3"></i>
                <span>Input Materi</span>
            </a>
            <a href="{{ route('manajTugas') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-file-pen w-6 mr-3"></i>
                <span>Input Tugas</span>
            </a>
            <a href="{{ route('manajemenNilai') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-pen w-6 mr-3"></i>
                <span>Input Nilai</span>
            </a>
            <a href="{{ route('manajPengumuman') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-bullhorn w-6 mr-3"></i>
                <span>Pengumuman</span>
            </a>
        </nav>
        <div class="p-6 border-t border-gray-200 flex-shrink-0 mt-auto">
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
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Profil Saya (Guru)</h1>
        </header>

        <!-- Page Content -->
        <main id="guru-profile-content" class="p-6 md:p-8 flex-1">
            @if(isset($guru))
                <header class="mb-8 bg-indigo-700 p-6 rounded-2xl shadow-xl text-white flex flex-col md:flex-row justify-between items-start gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold">{{ $guru->name }}</h1>
                        <p class="text-indigo-200 mt-1">NIP/NIK: {{ $guru->nisn_nik }}</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="flex-shrink-0 inline-flex items-center bg-white text-indigo-700 hover:bg-gray-100 transition duration-300 px-4 py-2 rounded-lg shadow-md font-semibold">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        <span>Kembali ke Dashboard</span>
                    </a>
                </header>

                <div class="space-y-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left Column: Profile, Account, Education -->
                        <div class="lg:col-span-1 space-y-8 flex flex-col">
                            <!-- 1. Profile Card -->
                            <section class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-indigo-500">
                                <div class="flex flex-col items-center">
                                    <img class="h-24 w-24 rounded-full object-cover mb-4 border-4 border-indigo-200" 
                                        src="https://ui-avatars.com/api/?name={{ urlencode($guru->name) }}&background=4f46e5&color=fff&size=128&font-size=0.33" alt="Foto Guru">
                                    <h2 class="text-xl font-bold text-gray-800">{{ $guru->name }}</h2>
                                    <p class="text-sm text-gray-500">{{ $guru->username }}</p>
                                    {{-- <span class="mt-2 text-xs font-semibold px-3 py-1 rounded-full bg-indigo-100 text-indigo-800">
                                        Spesialisasi
                                    </span> --}}
                                </div>
                            </section>

                            <!-- 2. Account Management Card -->
                            <section class="bg-white p-6 rounded-xl shadow-lg border-2 border-yellow-200">
                                <h3 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-4 flex items-center">
                                    <i class="fa-solid fa-lock text-yellow-500 mr-3"></i>
                                    Kelola Keamanan Akun
                                </h3>
                                <p class="text-sm text-gray-600 mb-4">Anda dapat mengubah username dan kata sandi akun Anda di sini.</p>
                                
                                <form action="#" method="POST">
                                    <div class="space-y-4">
                                        <div>
                                            <label for="username" class="block text-xs font-medium text-gray-700 mb-1">Username</label>
                                            <input type="text" name="username" id="username" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ $guru->username }}" required>
                                        </div>
                                        <div>
                                            <label for="new_password" class="block text-xs font-medium text-gray-700 mb-1">Password Baru (Opsional)</label>
                                            <input type="password" name="new_password" id="new_password" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Isi jika ingin ganti password">
                                        </div>
                                        <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-lg hover:bg-indigo-700 transition duration-300 flex items-center justify-center shadow-md">
                                            <i class="fa-solid fa-save mr-2"></i>
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </section>
                        </div>

                        <!-- Right Column: Detailed Info -->
                        <div class="lg:col-span-2 space-y-8">
                            <!-- 3. Detailed Info Card (Data Pribadi) -->
                            <section class="bg-white p-6 rounded-xl shadow-lg">
                                <h3 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-4 flex items-center">
                                    <i class="fa-solid fa-address-card text-indigo-500 mr-3"></i> Data Pribadi Guru
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                                    <div><label class="block text-gray-500">NIP/NIK</label><p class="font-medium text-gray-800">{{ $guru->nisn_nik }}</p></div>
                                    <div><label class="block text-gray-500">Jenis Kelamin</label><p class="font-medium text-gray-800">{{ $guru->jenis_kelamin ?? '-' }}</p></div>
                                    <div><label class="block text-gray-500">Tempat Lahir</label><p class="font-medium text-gray-800">{{ $guru->tempat_lahir ?? '-' }}</p></div>
                                    <div><label class="block text-gray-500">Tanggal Lahir</label><p class="font-medium text-gray-800">{{ $guru->tanggal_lahir ? \Carbon\Carbon::parse($guru->tanggal_lahir)->isoFormat('D MMMM YYYY') : '-' }}</p></div>
                                    <div class="md:col-span-2"><label class="block text-gray-500">Alamat Lengkap</label><p class="font-medium text-gray-800">{{ $guru->alamat ?? '-' }}</p></div>
                                </div>
                            </section>
                            
                            <!-- 4. Beban Mengajar Card -->
                            <section class="bg-white p-6 rounded-xl shadow-lg">
                                <h3 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-4 flex items-center">
                                    <i class="fa-solid fa-chalkboard-user text-indigo-500 mr-3"></i> Beban Mengajar (Tahun Ini)
                                </h3>
                                <div class="space-y-4">
                                    @if($beban_mengajar->isNotEmpty())
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            @foreach($beban_mengajar as $beban)
                                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 flex flex-col">
                                                    <p class="font-semibold text-gray-800">{{ $beban['mapel'] }}</p>
                                                    <p class="text-xs text-gray-500 mt-1">Mengajar Kelas:</p>
                                                    <p class="text-sm font-medium text-indigo-600 flex-grow">{{ $beban['kelas'] }}</p>
                                                    <div class="mt-2 pt-2 border-t border-gray-200">
                                                        <span class="text-xl font-extrabold text-indigo-600 block">{{ $beban['jam'] }} JP</span>
                                                        <span class="text-xs text-gray-500">Total Jam/Minggu</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="mt-4 pt-4 border-t border-gray-200 text-sm text-gray-700 font-medium">
                                            <i class="fas fa-clock mr-2 text-indigo-500"></i> Total Keseluruhan Jam Mengajar: <span class="text-indigo-600 font-bold">{{ $total_jam_mengajar }} JP/Minggu</span>
                                        </div>
                                    @else
                                        <p class="text-gray-500 bg-gray-50 p-4 rounded-lg">Data beban mengajar (mata pelajaran dan kelas) belum ditambahkan.</p>
                                    @endif
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center p-10 bg-white rounded-xl shadow-lg">
                    <i class="fas fa-exclamation-triangle text-red-500 text-3xl"></i>
                    <p class="mt-4 text-gray-600">Gagal memuat data profil guru.</p>
                </div>
            @endif
        </main>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Sidebar Toggle Script (Reused from Siswa file) ---
    const menuButton = document.getElementById('menu-button');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    if (menuButton && sidebar && overlay) {
        const toggleSidebar = () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        };
        menuButton.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // Hide sidebar on large screens if resized
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                 sidebar.classList.remove('-translate-x-full');
                 overlay.classList.add('hidden');
            }
        });
    }
});
</script>

</body>
</html>
