<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas - Sistem Manajemen Sekolah</title>
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
        /* Modal transition */
        .modal {
            transition: opacity 0.3s ease-in-out;
        }
        .modal-content {
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
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
                <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Daftar Kelas</h1>
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
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <h2 class="text-xl sm:text-2xl font-semibold text-gray-800">Daftar Kelas Tersedia</h2>
                        <a href="{{ route('createKelas') }}" class="w-full md:w-auto bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 flex items-center justify-center whitespace-nowrap">
                            <i class="fa-solid fa-plus mr-2"></i>
                            Tambah Kelas
                        </a>
                    </div>
                    <div class="flex flex-col md:flex-row items-center gap-4 mb-6">
                        <input type="text" placeholder="Cari nama kelas..." class="w-full md:flex-1 p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <select class="w-full md:w-auto p-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                            <option value="">Semua Angkatan</option>
                            @forelse ($angkatans as $angkatan)
                                <option value="{{$angkatan->angkatan}}">{{$angkatan->angkatan}}</option>
                            @empty
                                <option value="" disabled selected>Belum ada</option>
                            @endforelse
                        </select>
                    </div>
                    @if (count($kelasList) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($kelasList as $kelas)
                        <!-- Class Card -->
                        <div class="bg-gray-50 rounded-xl shadow-md p-6 relative hover:shadow-lg transition duration-300 group">
                             <!-- Edit Link -->
                             <a href="{{ route('editKelas', $kelas->id_kelas) }}" class="absolute top-4 right-12 text-gray-400 hover:text-blue-600 transition z-10 opacity-0 group-hover:opacity-100">
                                 <i class="fa-solid fa-pencil-alt"></i>
                             </a>
                             <!-- Delete Button -->
                            <button type="button" class="delete-btn absolute top-4 right-4 text-gray-400 hover:text-red-600 transition z-10 opacity-0 group-hover:opacity-100" data-id="{{$kelas->id_kelas}}" data-name="{{$kelas->nama_kelas}}">
                                <i class="fa-solid fa-trash-alt"></i>
                            </button>

                            <!-- Clickable Area -->
                            <a href="{{ route('lihatKelas', ['id_kelas' => $kelas->id_kelas]) }}" class="block">
                                <div class="flex items-center mb-4">
                                    <div class="bg-blue-100 text-blue-600 p-4 rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-school text-2xl"></i>
                                    </div>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800">{{$kelas->nama_kelas}}</h3>
                                <div class="flex items-center text-gray-600 mt-4">
                                    <i class="fa-solid fa-magnifying-glass text-sm mr-2"></i>
                                    <span class="text-sm">{{$kelas->jurusan}}</span>
                                </div>
                                <div class="flex items-center text-gray-600 mt-2">
                                    <i class="fa-solid fa-user-tie text-sm mr-2"></i>
                                    <span class="text-sm">{{$kelas->wali_kelas}}</span>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-12">
                        <i class="fa-solid fa-box-open text-5xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600 font-semibold text-lg">Belum ada data kelas.</p>
                        <p class="text-gray-500 mt-2">Silakan tambahkan kelas baru untuk memulai</p>
                    </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="modal fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center hidden opacity-0">
        <div class="modal-content bg-white rounded-xl shadow-2xl p-6 md:p-8 w-11/12 md:max-w-md transform transition-transform duration-300 scale-95">
            <div class="text-center">
                <i class="fa-solid fa-triangle-exclamation text-5xl text-red-500 mb-4"></i>
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-2">Konfirmasi Hapus</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus kelas <strong id="delete-class-name" class="font-bold"></strong>?</p>
            </div>
            <!-- NOTE: The action URL will be set dynamically by JavaScript -->
            <form id="delete-form" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <button type="button" id="cancel-delete-btn" class="bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 transition duration-300">Batal</button>
                    <button type="submit" class="bg-red-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-700 transition duration-300">Ya, Hapus</button>
                </div>
            </form>
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

            // --- Generic Modal Open/Close Functionality ---
            const openModal = (modalEl) => {
                if (!modalEl) return;
                const modalContent = modalEl.querySelector('.modal-content');
                modalEl.classList.remove('hidden');
                setTimeout(() => {
                    modalEl.classList.remove('opacity-0');
                    if (modalContent) modalContent.classList.remove('scale-95');
                }, 10);
            };

            const closeModal = (modalEl) => {
                if (!modalEl) return;
                const modalContent = modalEl.querySelector('.modal-content');
                modalEl.classList.add('opacity-0');
                if (modalContent) modalContent.classList.add('scale-95');
                setTimeout(() => {
                    modalEl.classList.add('hidden');
                }, 300);
            };

            // --- Delete Modal Functionality ---
            const deleteModal = document.getElementById('delete-modal');
            const deleteForm = document.getElementById('delete-form');
            const deleteClassName = document.getElementById('delete-class-name');
            const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
            
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', (event) => {
                    event.stopPropagation(); // Stop click from triggering card's link
                    
                    const classId = btn.dataset.id;
                    const className = btn.dataset.name;
                    
                    if(deleteClassName) deleteClassName.textContent = className;
                    if(deleteForm) deleteForm.action = `{{ url('manajemen-kelas') }}/${classId}`;
                    
                    openModal(deleteModal);
                });
            });

            if (cancelDeleteBtn) cancelDeleteBtn.addEventListener('click', () => closeModal(deleteModal));
            if (deleteModal) deleteModal.addEventListener('click', (event) => {
                if (event.target === deleteModal) closeModal(deleteModal);
            });
            
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

