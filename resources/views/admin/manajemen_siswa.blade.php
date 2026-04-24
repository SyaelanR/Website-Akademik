<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Siswa - Sistem Manajemen Sekolah</title>
    <!-- Tailwind CSS CDN -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- SweetAlert2 for notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        /* Custom Pagination Styles */
        .pagination-container nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .pagination-container .pagination-links > a,
        .pagination-container .pagination-links > span {
             padding: 0.5rem 1rem;
             margin: 0 0.25rem;
             border-radius: 0.5rem;
             transition: all 0.2s ease-in-out;
        }
        .pagination-container .pagination-links > a {
            background-color: white;
            color: #4a5568;
            border: 1px solid #e2e8f0;
        }
         .pagination-container .pagination-links > a:hover {
            background-color: #f7fafc;
            border-color: #cbd5e0;
        }
        .pagination-container .pagination-links > .active {
            background-color: #4f46e5;
            color: white;
            border: 1px solid #4f46e5;
            font-weight: bold;
        }
        .pagination-container .pagination-links > .disabled {
            background-color: #f7fafc;
            color: #a0aec0;
            cursor: not-allowed;
            border: 1px solid #e2e8f0;
        }

            /* Pagination container */
        .pagination-wrapper nav {
            @apply inline-flex items-center space-x-1;
        }

        /* Pagination links */
        .pagination-wrapper nav .page-link {
            @apply px-3 py-1.5 rounded-lg text-gray-700 bg-white border border-gray-300 hover:bg-blue-500 hover:text-white transition-all duration-200;
        }

        /* Active page */
        .pagination-wrapper nav .active .page-link {
            @apply bg-blue-600 text-white border-blue-600;
        }

        /* Disabled page */
        .pagination-wrapper nav .disabled .page-link {
            @apply opacity-50 cursor-not-allowed;
        }

        /* Arrow icons (prev/next) */
        .pagination-wrapper nav svg {
            @apply w-4 h-4;
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
            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-tachometer-alt w-6 mr-3"></i>
                <span>Dashboard</span>
            </a>

            @can('view-admin')
            <a href="{{ route('admin.profile') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('admin.profile')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-user-circle mr-3"></i>
                <span>Profil</span>
            </a>
            <a href="{{ route('manajemenSiswa') }}" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 transition duration-200">
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
            <button id="menu-button" class="lg:hidden text-gray-600 focus:outline-none">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Manajemen Data Siswa</h1>
            <div class="flex items-center space-x-4">
                
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1">
            <!-- Session Messages Handling -->
            @if(session('success'))
                <div id="session-success" data-message="{{ session('success') }}" class="hidden"></div>
            @endif

             <header class="mb-8 bg-indigo-600 p-6 rounded-2xl shadow-lg text-white">
                <h2 class="text-2xl md:text-3xl font-bold mb-1">Manajemen Siswa</h2>
                <p class="text-indigo-200">Kelola semua data siswa yang terdaftar di sekolah.</p>
            </header>

            <div class="bg-white p-6 rounded-xl shadow-md">
                <!-- Action Bar -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Siswa</h2>
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <form action="{{ route('manajemenSiswa') }}" method="GET" class="relative w-full md:w-64">
                            <input type="text" name="search" placeholder="Cari siswa..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ $search ?? '' }}">
                            <button type="submit" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fa-solid fa-search"></i>
                            </button>
                        </form>
                        <a href="{{ route('tambahSiswa') }}" class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 flex items-center whitespace-nowrap shadow-md hover:shadow-lg">
                            <i class="fa-solid fa-plus mr-2"></i>
                            Tambah Siswa
                        </a>
                    </div>
                </div>

                <!-- Students Table -->
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[800px] text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">NISN</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Nama Siswa</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Angkatan</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Status</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Detail</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="student-table-body" class="divide-y">
                            {{-- Contoh data dummy dengan loop --}}
                            @forelse ($students ?? [] as $student)
                            <tr class="student-row hover:bg-gray-50">
                                <td class="p-3 text-gray-700">{{ $student->nisn_nik }}</td>
                                <td class="p-3 text-gray-800 font-medium">{{ $student->name }}</td>
                                <td class="p-3 text-gray-700">{{ $student->kelas->angkatan->angkatan ?? '-' }}</td>
                                {{-- <td class="p-3 text-gray-700">{{ $student->kelas->angkatan->id_tingkat ?? '-' }}</td> --}}
                                <td class="p-3 text-gray-700">
                                    @if ($student->kelas == null)
                                        <span class="bg-green-100 text-green-800 font-medium py-1 px-3 rounded-full text-xs">-</span>
                                    @elseif ($student->kelas->angkatan->is_alumni == true)
                                        <span class="bg-gray-200 text-gray-800 font-medium py-1 px-3 rounded-full text-xs">Alumni</span>
                                    @elseif ($student->kelas->angkatan->is_alumni == false)
                                        <span class="bg-green-100 text-green-800 font-medium py-1 px-3 rounded-full text-xs">Aktif</span>
                                    @endif
                                </td>
                                <td class="p-3">
                                    <a href="{{ route('lihatDetailSiswa', $student->id) }}" class="bg-indigo-100 text-indigo-700 text-sm font-medium py-1.5 px-3 rounded-lg hover:bg-indigo-200 transition duration-300 whitespace-nowrap">Lihat Detail</a>
                                </td>
                                <td class="p-3 text-center">
                                    <div class="flex justify-center space-x-4">
                                        <a href="{{ route('editSiswa', $student->id) }}" class="text-blue-600 hover:text-blue-800" title="Edit"><i class="fa-solid fa-pencil"></i></a>
                                        <form action="{{ route('hapusSiswa', $student->id) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-3 text-center text-gray-500">
                                    <div class="text-center py-12">
                                        @if ($search)
                                            <i class="fa-solid fa-magnifying-glass text-5xl text-gray-400 mb-4"></i>
                                            <p class="text-gray-600 font-semibold text-lg">Siswa tidak ditemukan.</p>
                                            <p class="text-gray-500 mt-2">Tidak ada siswa yang cocok dengan kata kunci "{{ request('search') }}".</p>
                                        @else
                                            <i class="fa-solid fa-users-slash text-5xl text-gray-400 mb-4"></i>
                                            <p class="text-gray-600 font-semibold text-lg">Belum ada data Siswa.</p>
                                            <p class="text-gray-500 mt-2">Silakan tambahkan Siswa baru.</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                 <div class="mt-6 color">
                    {{-- Pastikan Anda sudah mem-publish view paginasi Tailwind --}}
                    {{-- Menambahkan query string pencarian ke link paginasi --}}
                    {!! $students->appends(request()->query())->links('vendor.pagination.custom') !!}
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

        // --- SweetAlert2 Notifications ---
        const successMessage = document.getElementById('session-success');
        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: successMessage.dataset.message,
                timer: 2500,
                showConfirmButton: false
            });
        }

        // --- Delete Confirmation ---
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data siswa yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });

        // JavaScript untuk pencarian telah dihapus karena sekarang ditangani oleh controller.
    });
</script>

</body>
</html>

