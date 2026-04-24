<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengumuman - Sistem Manajemen Sekolah</title>
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
        .modal {
            transition: opacity 0.3s ease, visibility 0.3s ease;
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
            <a href="{{ route('manajemenKelas') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-door-closed w-6 mr-3"></i>
                <span>Manajemen Kelas</span>
            </a>
            <a href="{{ route('manajemenJadwal')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-calendar-alt w-6 mr-3"></i>
                <span>Manajemen Jadwal</span>
            </a>
            <a href="{{ route('manajAcara')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-calendar-check mr-3"></i>
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
            @endcan

            @can('view-guru')
            <a href="{{ route('guru.profile') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('admin.profile')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-user-circle mr-3"></i>
                <span>Profil</span>
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
            <a href="{{ route('manajPengumuman') }}" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 transition duration-200">
                <i class="fa-solid fa-bullhorn w-6 mr-3"></i>
                <span>Pengumuman</span>
            </a>
            @endcan

            @can('view-siswa')
            <a href="{{ route('pilihMapel')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-pen w-6 mr-3"></i>
                <span>Lihat Nilai</span>
            </a>
            <a href="{{ route('lihatAbsensi') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-list-check w-6 mr-3"></i>
                <span>Lihat Absensi</span>
            </a>
            <a href="{{ route('lihatAcaraSiswa')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-calendar-check mr-3"></i>
                <span>Acara</span>
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
            <div>
                <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Manajemen Pengumuman</h1>
                @if(isset($infoJKA))
                <p class="text-sm text-gray-500">Kelas: {{ $infoJKA->kelas->nama_kelas ?? 'N/A' }} - {{ $infoJKA->mapel->nama_mapel ?? 'N/A' }}</p>
                @endif
            </div>
            <div class="flex items-center space-x-4">
                
            </div>
        </header>

        <!-- Hidden divs for session messages to be picked up by JavaScript -->
        @if (session('success'))
            <div id="session-success" data-message="{{ session('success') }}" class="hidden"></div>
        @endif
        @if (session('error'))
            <div id="session-error" data-message="{{ session('error') }}" class="hidden"></div>
        @endif
        @if ($errors->any())
            <div id="validation-errors" data-errors='@json($errors->all())' class="hidden"></div>
        @endif

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1">
            <!-- UPDATED: Welcome Header ala manajemen_pengumuman_kelas.blade.php -->
            <header class="mb-8 bg-indigo-600 p-8 rounded-2xl shadow-lg text-white">
                <h2 class="text-3xl font-bold mb-2">Kelola Pengumuman</h2>
                @if(isset($infoJKA))
                    <p class="text-indigo-200">
                        Membuat dan mengelola pengumuman untuk kelas 
                        {{ $infoJKA->kelas->nama_kelas ?? 'N/A' }} - 
                        Mata Pelajaran: {{ $infoJKA->mapel->nama_mapel ?? 'N/A' }}
                    </p>
                @else
                    <p class="text-indigo-200">Membuat dan mengelola pengumuman.</p>
                @endif
            </header>
            
            <div class="flex justify-end mb-6">
                <button id="add-announcement-btn" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md hover:bg-indigo-700 transition duration-300 flex items-center">
                    <i class="fa-solid fa-plus-circle mr-2"></i> Tambah Pengumuman
                </button>
            </div>

            <!-- Announcement List (UPDATED DESIGN) -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 flex-shrink-0">Daftar Pengumuman</h2>
                </div>
                    <!-- Iterasi Daftar Pengumuman -->
                    @forelse ($daftarPengumuman ?? [] as $Pengumuman)
                    <!-- Menggunakan data attribute untuk menyimpan detail pengumuman untuk fungsionalitas Edit -->
                    <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-indigo-500 hover:shadow-xl hover:-translate-y-1 transform transition-all duration-300" 
                         data-id="{{ $Pengumuman->id_pengumuman }}" data-judul="{{ $Pengumuman->judul }}" data-isi="{{ $Pengumuman->isi }}">
                        
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <i class="fa-solid fa-bullhorn text-indigo-500 text-xl flex-shrink-0"></i>
                                <h4 class="text-lg font-bold text-gray-900 leading-tight">{{ $Pengumuman->judul }}</h4>
                            </div>
                            <div class="flex space-x-3 flex-shrink-0 ml-4 pt-1">
                                <!-- Tombol Edit -->
                                <button class="edit-btn text-gray-500 hover:text-blue-600 transition duration-200" title="Edit"
                                        data-id="{{ $Pengumuman->id_pengumuman }}"
                                        data-judul="{{ $Pengumuman->judul }}"
                                        data-isi="{{ $Pengumuman->isi }}">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                
                                <!-- Tombol Hapus -->
                                <form class="delete-form" action="{{ route('deletePengumuman', $Pengumuman->id_pengumuman) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-500 hover:text-red-600 transition duration-200" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <p class="mt-3 text-gray-700 text-sm line-clamp-3">{{ Str::limit($Pengumuman->isi, 100) }}</p>

                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <p class="text-xs text-gray-500">
                                Dibuat: {{ \Carbon\Carbon::parse($Pengumuman->created_at)->format('d M Y') }}
                            </p>
                            <p class="text-xs text-red-500 font-medium mt-1">
                                Akan terhapus dalam 7 hari.
                            </p>
                        </div>
                    </div>
                    @empty
                    <!-- Placeholder untuk saat tidak ada pengumuman -->
                    <div class="col-span-full bg-white p-10 rounded-xl shadow-lg text-center border-2 border-dashed border-gray-300">
                        <i class="fa-solid fa-bell-slash text-5xl text-gray-400 mb-4"></i>
                        <p class="text-lg text-gray-600 font-semibold">Belum ada pengumuman untuk kelas ini.</p>
                        <p class="text-sm text-gray-500 mt-1">Silakan tambahkan pengumuman baru menggunakan tombol di atas.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

    <!-- Modal for Add/Edit Announcement -->
    <!-- Form action di sini akan diubah oleh JavaScript untuk aksi Edit atau Tambah -->
    <div id="announcement-modal" class="modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 invisible opacity-0">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 md:p-8 transform transition-transform duration-300 scale-95">
            <div class="flex justify-between items-center mb-6">
                <h2 id="modal-title" class="text-2xl font-bold text-gray-800">Tambah Pengumuman Baru</h2>
                <button id="close-modal-btn" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-times text-2xl"></i>
                </button>
            </div>
            <!-- ID form ditambahkan untuk memudahkan manipulasi JS -->
            <!-- Catatan: [$infoJKA->id_kelas ?? 'kelas_dummy', $infoJKA->id_mapel ?? 'mapel_dummy'] adalah placeholder, sesuaikan dengan logic routing Laravel Anda -->
            <form id="announcement-form" action="{{ route('storePengumumanDaftar', [$infoJKA->id_kelas ?? 'kelas_dummy', $infoJKA->id_mapel ?? 'mapel_dummy']) }}" method="POST">
                @csrf
                <!-- Field untuk method PUT/PATCH (hanya muncul saat Edit) -->
                <input type="hidden" name="_method" id="form-method" value="POST">
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 font-semibold mb-2">Judul</label>
                    <input type="text" id="judul" name="judul" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan judul pengumuman" required>
                </div>
                <div class="mb-6">
                    <label for="isi" class="block text-gray-700 font-semibold mb-2">Isi Pengumuman</label>
                    <textarea id="isi" name="isi" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Tuliskan isi pengumuman di sini..." required></textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" id="cancel-btn" class="py-2 px-6 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition duration-300">Batal</button>
                    <button type="submit" id="submit-btn" class="py-2 px-6 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-300">Simpan</button>
                </div>
                <div class="mt-4">
                    <p class="text-sm text-gray-500">Noted: Pengumuman ini akan otomatis terhapus setelah satu minggu.</p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- Sidebar Toggle Functionality ---
        const menuButton = document.getElementById('menu-button');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        const toggleSidebar = () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        };

        menuButton.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // --- SweetAlert2 Notification Logic ---
        const successMessage = document.getElementById('session-success');
        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: successMessage.dataset.message,
                timer: 2500, // Notifikasi akan hilang setelah 2.5 detik
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-xl'
                }
            });
        }

        const errorMessage = document.getElementById('session-error');
        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: errorMessage.dataset.message,
                customClass: {
                    popup: 'rounded-xl'
                }
            });
        }

        const validationErrors = document.getElementById('validation-errors');
        if (validationErrors) {
            const errors = JSON.parse(validationErrors.dataset.errors);
            let errorText = '<ul class="list-disc list-inside text-left">';
            errors.forEach(error => {
                errorText += `<li>${error}</li>`;
            });
            errorText += '</ul>';

            Swal.fire({
                icon: 'error',
                title: 'Gagal Validasi',
                html: errorText
            });
        }

        // --- Modal Functionality for Add/Edit ---
        const modal = document.getElementById('announcement-modal');
        const modalContent = modal.querySelector('div.bg-white'); // Target konten modal
        const addBtn = document.getElementById('add-announcement-btn');
        const closeModalBtn = document.getElementById('close-modal-btn');
        const cancelBtn = document.getElementById('cancel-btn');
        const editBtns = document.querySelectorAll('.edit-btn');
        const form = document.getElementById('announcement-form');
        const modalTitle = document.getElementById('modal-title');
        const inputJudul = document.getElementById('judul');
        const inputIsi = document.getElementById('isi');
        const formMethod = document.getElementById('form-method');

        // Base URL untuk simpan pengumuman baru (pastikan variabel ini sesuai dengan rute Laravel Anda)
        const defaultStoreUrl = form.getAttribute('action'); // Ambil action default dari form

        const openModal = () => {
            modal.classList.remove('invisible', 'opacity-0');
            modalContent.classList.remove('scale-95');
        };

        const closeModal = () => {
            modalContent.classList.add('scale-95');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('invisible');
                form.reset(); // Reset form fields on close
                // Kembalikan form ke mode default (Tambah)
                modalTitle.textContent = 'Tambah Pengumuman Baru';
                form.setAttribute('action', defaultStoreUrl);
                formMethod.value = 'POST';
                document.getElementById('submit-btn').textContent = 'Simpan';
            }, 300);
        };

        // Handler untuk tombol 'Tambah Pengumuman'
        addBtn.addEventListener('click', () => {
            modalTitle.textContent = 'Tambah Pengumuman Baru';
            form.setAttribute('action', defaultStoreUrl);
            formMethod.value = 'POST'; // Set method ke POST untuk Tambah
            document.getElementById('submit-btn').textContent = 'Simpan';
            openModal();
        });

        // Handler untuk tombol 'Edit'
        editBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const id = e.currentTarget.getAttribute('data-id');
                const judul = e.currentTarget.getAttribute('data-judul');
                const isi = e.currentTarget.getAttribute('data-isi');
                
                // 1. Set Judul Modal
                modalTitle.textContent = 'Edit Pengumuman';
                
                // 2. Isi Form dengan Data yang Ada
                inputJudul.value = judul;
                inputIsi.value = isi;
                
                // 3. Update Action Form untuk Update menggunakan route() helper Laravel
                // Ganti URL manual dengan route helper
                // Pastikan route 'updatePengumuman' Anda menerima ID pengumuman
                const updateRoute = "{{ route('updatePengumuman', 'ID_PLACEHOLDER') }}";
                form.setAttribute('action', updateRoute.replace('ID_PLACEHOLDER', id));
                
                // 4. Set Method ke PUT/PATCH
                formMethod.value = 'PUT'; // Set method ke PUT/PATCH untuk Edit
                document.getElementById('submit-btn').textContent = 'Update';

                // 5. Buka Modal
                openModal();
            });
        });

        // Event listener untuk menutup modal
        closeModalBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });

        // --- Delete Confirmation Logic using SweetAlert2 ---
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form submit secara langsung
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan pengumuman ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Jika dikonfirmasi, lanjutkan submit form
                    }
                });
            });
        });
    });
</script>

</body>
</html>
