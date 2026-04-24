<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Absensi - EduSys</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 for notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <a href="{{ route('manajAbsensi') }}" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 transition duration-200">
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
            <button id="menu-button" class="lg:hidden text-gray-600 focus:outline-none">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Daftar Absensi</h1>
            <div class="flex items-center space-x-4">
                
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1">
            <!-- Session Messages Handling -->
            @if(session('success'))
                <div id="session-success" data-message="{{ session('success') }}" class="hidden"></div>
            @endif
            @if ($errors->any())
                <div id="validation-errors" data-errors='@json($errors->all())' class="hidden"></div>
            @endif

            <header class="mb-8 bg-indigo-600 p-6 rounded-2xl shadow-lg flex flex-wrap justify-between items-center text-white gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">Daftar Absensi: {{$infoJKA->kelas->nama_kelas ?? 'N/A'}} - {{$infoJKA->mapel->nama_mapel ?? 'N/A'}}</h1>
                    <p class="text-indigo-200 mt-2">Pilih sesi absensi untuk diisi atau buat sesi baru.</p>
                </div>
                <a href="{{ route('manajAbsensi') }}" class="flex-shrink-0 inline-flex items-center bg-white text-indigo-600 hover:bg-gray-100 transition duration-300 px-4 py-2 rounded-lg shadow-md font-semibold">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    <span>Kembali</span>
                </a>
            </header>
            
            <div class="bg-white p-6 rounded-xl shadow-md">
                <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
                    <h2 class="text-2xl font-bold text-gray-800">Sesi Absensi</h2>
                    <button id="add-task-btn" class="bg-indigo-600 text-white font-semibold py-2 px-5 rounded-lg shadow-md hover:bg-indigo-700 transition duration-300 flex items-center">
                        <i class="fa-solid fa-plus mr-2"></i> Tambah Sesi
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[600px] text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Keterangan</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Tanggal</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Kategori</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                        @forelse (($daftarAbsensi ?? []) as $absensi)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-medium text-gray-800">{{$absensi->keterangan}}</td>
                                <td class="p-3 text-gray-600">{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d F Y') }}</td>
                                <td class="p-3 text-gray-600">
                                    <span class="bg-gray-200 text-gray-800 font-medium py-1 px-3 rounded-full text-xs">{{$absensi->kategori}}</span>
                                </td>
                                <td class="p-3 text-center">
                                    <a href="{{ route('inputAbsensi', [$absensi->id_kelas, $absensi->id_mapel, $absensi->id_daftar_absensi])}}" class="bg-indigo-100 text-indigo-700 font-semibold py-2 px-4 rounded-lg hover:bg-indigo-200 transition duration-300">Masuk</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-3 text-center text-gray-500">
                                    <div class="text-center py-12">
                                        <i class="fa-solid fa-folder-open text-5xl text-gray-400 mb-4"></i>
                                        <p class="text-gray-600 font-semibold text-lg">Belum ada sesi absensi.</p>
                                    </div>
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

<!-- Modal Tambah Absensi -->
<div id="task-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-gray-900 bg-opacity-50 p-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg transform transition-all duration-300 ease-in-out" id="modal-content">
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-bold text-gray-800">Tambah Sesi Absensi</h2>
            <button id="close-task-modal-btn" class="text-gray-400 hover:text-gray-600 transition duration-300">
                <i class="fa-solid fa-times text-2xl"></i>
            </button>
        </div>
        <form id="task-form" action="{{route('storeAbsensiDaftar',[$infoJKA->kelas->id_kelas ?? 0, $infoJKA->mapel->id_mapel ?? 0])}}" method="POST">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label for="task-name" class="block text-gray-700 font-semibold mb-2">Keterangan Absensi</label>
                    <input type="text" name="keterangan_absen" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Contoh: Pertemuan ke-1" required>
                </div>
                <div>
                    <label for="task-type-select" class="block text-gray-700 font-semibold mb-2">Kategori Absensi</label>
                    <select name="kategori_absen" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <option value="KBM">KBM</option>
                        <option value="Setoran">Setoran</option>
                        <option value="Halaqah">Halaqah</option>
                        <option value="Daurah">Daurah</option>
                    </select>
                </div>
                <div>
                    <label for="task-due-date" class="block text-gray-700 font-semibold mb-2">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
            </div>
            <div class="flex justify-end p-6 bg-gray-50 rounded-b-xl">
                <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition duration-300">Simpan Sesi</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Sidebar Toggle ---
    const menuButton = document.getElementById('menu-button');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    if (menuButton) {
        const toggleSidebar = () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        };
        menuButton.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    }

    // --- Modal Logic ---
    const addTaskBtn = document.getElementById('add-task-btn');
    const taskModal = document.getElementById('task-modal');
    const modalContent = document.getElementById('modal-content');
    const closeTaskModalBtn = document.getElementById('close-task-modal-btn');
    const taskForm = document.getElementById('task-form');

    if (addTaskBtn) {
        const openModal = () => {
            taskModal.classList.remove('hidden');
            setTimeout(() => modalContent.classList.add('scale-100', 'opacity-100'), 10);
        }
        const closeModal = () => {
            setTimeout(() => taskModal.classList.add('hidden'), 300);
        }

        addTaskBtn.addEventListener('click', openModal);
        closeTaskModalBtn.addEventListener('click', closeModal);
        taskModal.addEventListener('click', (e) => {
            if (e.target === taskModal) {
                closeModal();
            }
        });

        // The form submission itself is handled by Laravel, no need to preventDefault unless using AJAX.
    }

    window.addEventListener('load', () => {
        const successEl = document.getElementById('session-success');
        const errorEl = document.getElementById('session-error');
        if (successEl) {
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: successEl.dataset.message, timer: 2000, showConfirmButton: false });
        }
        if (errorEl) {
            Swal.fire({ icon: 'error', title: 'Gagal', text: errorEl.dataset.message, timer: 3000, showConfirmButton: false });
        }

        // --- Handle Validation Errors ---
        const validationErrorsEl = document.getElementById('validation-errors');
        if (validationErrorsEl) {
            const errors = JSON.parse(validationErrorsEl.dataset.errors);
            let errorText = '<ul class="list-disc list-inside text-left">';
            errors.forEach(error => {
                errorText += `<li>${error}</li>`;
            });
            errorText += '</ul>';

            Swal.fire({ icon: 'error', title: 'Gagal Validasi', html: errorText });
        }
    });
});
</script>
</body>
</html>
