<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nilai - Sistem Manajemen Sekolah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- SweetAlert2 for notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            <a href="{{ route('manajemenNilai') }}" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 transition duration-200">
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
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Daftar Nilai</h1>
             <div class="flex items-center space-x-4">
                
            </div>
        </header>

        <main class="p-6 md:p-8 flex-1">
            <!-- Session Messages Handling -->
            @if(session('success'))
                <div id="session-success" data-message="{{ session('success') }}" class="hidden"></div>
            @endif
            @if ($errors->any())
                <div id="validation-errors" data-errors='@json($errors->all())' class="hidden"></div>
            @endif

            <!-- UPDATED Header -->
            <header class="mb-8 bg-indigo-600 p-6 rounded-2xl shadow-lg flex flex-wrap justify-between items-center text-white gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">Daftar Nilai: {{$infoJKA->kelas?->nama_kelas ?? 'N/A'}} - {{$infoJKA->mapel?->nama_mapel ?? 'N/A'}}</h1>
                    <p class="text-indigo-200 mt-2">Pilih tugas untuk diisi nilainya atau buat tugas baru.</p>
                </div>
                <a href="{{ route('manajemenNilai') }}" class="flex-shrink-0 inline-flex items-center bg-white text-indigo-600 hover:bg-gray-100 transition duration-300 px-4 py-2 rounded-lg shadow-md font-semibold">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    <span>Kembali</span>
                </a>
            </header>
            
            <div class="bg-white p-6 rounded-xl shadow-md">
                <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
                    <h2 class="text-2xl font-bold text-gray-800">Sesi Penilaian</h2>
                    <div class="flex items-center gap-2">
                        <button id="add-task-btn" class="bg-indigo-600 text-white font-semibold py-2 px-5 rounded-lg shadow-md hover:bg-indigo-700 transition duration-300 flex items-center">
                            <i class="fa-solid fa-plus mr-2"></i> Tambah Sesi
                        </button>
                        <button onclick="window.location.href = '{{ route('exportNilai',[$infoJKA->kelas?->id_kelas ?? 0, $infoJKA->mapel->id_mapel ?? 0]) }}'" class="bg-green-600 text-white font-semibold py-2 px-5 rounded-lg shadow-md hover:bg-green-700 transition duration-300 flex items-center">
                            <i class="fa-solid fa-file-excel mr-2"></i> Export Nilai
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[600px] text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Keterangan</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Tipe Nilai</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Tanggal</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Sifat</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm text-center">Hapus</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                        @forelse (($daftarNilai ?? []) as $nilai)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-medium text-gray-800">{{$nilai->keterangan}}</td>
                                <td class="p-3">
                                    @if($nilai->tipe_nilai == 'Tugas')
                                        <span class="bg-blue-100 text-blue-800 font-medium py-1 px-3 rounded-full text-xs capitalize">{{$nilai->tipe_nilai}}</span>
                                    @elseif($nilai->tipe_nilai == 'PR')
                                        <span class="bg-cyan-100 text-cyan-800 font-medium py-1 px-3 rounded-full text-xs capitalize">{{$nilai->tipe_nilai}}</span>
                                    @elseif($nilai->tipe_nilai == 'UAS')
                                        <span class="bg-red-100 text-red-800 font-medium py-1 px-3 rounded-full text-xs capitalize">{{$nilai->tipe_nilai}}</span>
                                     @elseif($nilai->tipe_nilai == 'UTS')
                                        <span class="bg-yellow-100 text-yellow-800 font-medium py-1 px-3 rounded-full text-xs capitalize">{{$nilai->tipe_nilai}}</span>
                                    @elseif($nilai->tipe_nilai == 'Hafalan')
                                        <span class="bg-green-100 text-green-800 font-medium py-1 px-3 rounded-full text-xs capitalize">{{$nilai->tipe_nilai}}</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 font-medium py-1 px-3 rounded-full text-xs capitalize">{{$nilai->tipe_nilai}}</span>
                                    @endif
                                <td class="p-3 text-gray-600">{{$nilai->tanggal}}</td>
                                <td class="p-3 text-gray-600">{{$nilai->sifat}}</td>
                                <td class="p-3 text-center">
                                    <form action="{{ route('destroyDaftarNilai', $nilai->id_daftar_nilai) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition duration-200" title="Hapus Sesi">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                @if ($nilai->sifat == 'online')
                                    <td class="p-3 text-center">
                                        <a href="{{route('inputNilaiOnline',[$nilai->id_kelas, $nilai->id_mapel, $nilai->id_daftar_nilai])}}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Masuk</a>
                                    </td>
                                @elseif ($nilai->sifat == 'offline')
                                    <td class="p-3 text-center">
                                        <a href="{{route('inputNilai',[$nilai->id_kelas, $nilai->id_mapel, $nilai->id_daftar_nilai])}}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Masuk</a>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-3 text-center text-gray-500">
                                    <div class="text-center py-12">
                                        <i class="fa-solid fa-folder-open text-5xl text-gray-400 mb-4"></i>
                                        <p class="text-gray-600 font-semibold text-lg">Belum ada daftar nilai.</p>
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

<!-- Modal Tambah Nilai -->
<div id="task-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center bg-gray-900 bg-opacity-50 p-4">
    <div id="modal-content" class="bg-white rounded-xl shadow-lg w-full max-w-lg">
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-bold text-gray-800">Tambah Sesi Penilaian</h2>
            <button id="close-task-modal-btn" class="text-gray-400 hover:text-gray-600 transition duration-300">
                <i class="fa-solid fa-times text-2xl"></i>
            </button>
        </div>
        <form id="task-form" action="{{route('storeDaftarNilai',[$infoJKA->kelas?->id_kelas ?? 0, $infoJKA->mapel->id_mapel ?? 0])}}" method="POST">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label for="keterangan_nilai" class="block text-gray-700 font-semibold mb-2">Keterangan Nilai</label>
                    <input type="text" id="keterangan_nilai" name="keterangan_nilai" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Contoh: Tugas Harian 1" required>
                </div>
                <div>
                    <label for="tipe_nilai" class="block text-gray-700 font-semibold mb-2">Tipe Nilai</label>
                    <select id="tipe_nilai" name="tipe_nilai" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <option value="Tugas">Tugas</option>
                        <option value="PR">PR</option>
                        <option value="UAS">UAS</option>
                        <option value="UTS">UTS</option>
                        <option value="Hafalan">Hafalan</option>
                    </select>
                </div>
                
                <div>
                    <label for="tanggal" class="block text-gray-700 font-semibold mb-2">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
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
            html: errorText,
        });
    }


    // --- Modal Logic ---
    const addTaskBtn = document.getElementById('add-task-btn');
    const taskModal = document.getElementById('task-modal');
    const closeTaskModalBtn = document.getElementById('close-task-modal-btn');

    if (addTaskBtn && taskModal && closeTaskModalBtn) {
        const openModal = () => taskModal.classList.remove('hidden');
        const closeModal = () => taskModal.classList.add('hidden');

        addTaskBtn.addEventListener('click', openModal);
        closeTaskModalBtn.addEventListener('click', closeModal);
        taskModal.addEventListener('click', (e) => {
            if (e.target === taskModal) {
                closeModal();
            }
        });
    }

    // --- Delete Confirmation ---
    const deleteForms = document.querySelectorAll('.delete-form');
    if (deleteForms) {
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Sesi penilaian dan semua nilai siswa di dalamnya akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) { this.submit(); }
                });
            });
        });
    }
});
</script>
</body>
</html>
