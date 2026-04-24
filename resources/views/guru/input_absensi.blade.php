<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Siswa - EduSys</title>
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
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }
        .sidebar { transition: transform 0.3s ease-in-out; }
        
        /* Custom select colors */
        .select-status {
            transition: background-color 0.3s, color 0.3s;
        }
        .status-hadir {
            background-color: #dcfce7; /* green-100 */
            color: #166534; /* green-800 */
            border-color: #86efac; /* green-300 */
        }
        .status-Izin { /* Matched to value="Izin" */
            background-color: #fefce8; /* yellow-100 */
            color: #854d0e; /* yellow-800 */
            border-color: #fde047; /* yellow-300 */
        }
        .status-Sakit { /* Matched to value="Sakit" */
            background-color: #e0f2fe; /* sky-100 */
            color: #075985; /* sky-800 */
            border-color: #7dd3fc; /* sky-300 */
        }
        .status-Alfa { /* Matched to value="Alfa" */
            background-color: #fee2e2; /* red-100 */
            color: #991b1b; /* red-800 */
            border-color: #fca5a5; /* red-300 */
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
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Absensi Siswa</h1>
            <div class="flex items-center space-x-4">
                
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1">
            <!-- Validation Errors -->
           <!-- Session Messages Handling -->
            @if(session('success'))
                <div id="session-success" data-message="{{ session('success') }}" class="hidden"></div>
            @endif
            @if ($errors->any())
                <div id="validation-errors" data-errors='@json($errors->all())' class="hidden"></div>
            @endif

            <!-- Session Messages Handling -->
            @if(session('success'))
                <div id="session-success" data-message="{{ session('success') }}" class="hidden"></div>
            @endif

            <header class="mb-8 bg-indigo-600 p-6 rounded-2xl shadow-lg flex flex-wrap justify-between items-center text-white gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">Absensi Kelas: {{$infoJKA->kelas->nama_kelas ?? 'N/A'}} - {{$infoJKA->mapel->nama_mapel ?? 'N/A'}}</h1>
                    <p class="text-indigo-200 mt-2"><i class="fa-solid fa-calendar-day mr-2"></i>Tanggal: {{ now()->format('d F Y') }}</p>
                </div>
                <a href="{{ url()->previous() }}" class="flex-shrink-0 inline-flex items-center bg-white text-indigo-600 hover:bg-gray-100 transition duration-300 px-4 py-2 rounded-lg shadow-md font-semibold">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    <span>Kembali</span>
                </a>
            </header>

            <!-- Siswa Belum Diabsen -->
            <div class="bg-white p-6 rounded-xl shadow-md mb-8">
                <form action="{{ route('storeAbsensiSiswa')}}" method="POST">
                    @csrf
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <h2 class="text-2xl font-bold text-gray-800">Siswa Belum Diabsen</h2>
                        <button type="button" id="hadir-semua-btn" class="bg-green-100 text-green-700 font-semibold py-2 px-4 rounded-lg hover:bg-green-200 transition duration-300 flex items-center text-sm">
                            <i class="fa-solid fa-users-viewfinder mr-2"></i>
                            Hadir Semua
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[700px] text-left">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="p-3 font-semibold text-gray-600 uppercase text-sm">NISN</th>
                                    <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Nama Siswa</th>
                                    <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Jenis Kelamin</th>
                                    <th class="p-3 font-semibold text-gray-600 uppercase text-sm w-48">Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse ($daftarSiswa ?? [] as $siswa)
                                @if ($siswa->status == null)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 text-gray-700">{{$siswa->siswa->nisn_nik}}</td>
                                    <td class="p-3 text-gray-800 font-medium">{{$siswa->siswa->name}}</td>
                                    <td class="p-3 text-gray-700">{{$siswa->siswa->jenis_kelamin}}</td>
                                    <td class="p-3">
                                        <select name='status[{{$siswa->id_daftar_absensi_siswa}}]' class="select-status status-hadir w-full p-2 border rounded-lg font-semibold">
                                            <option value="" class="text-green-800 font-medium" selected></option>
                                            <option value="Hadir" class="text-green-800 font-medium">Hadir</option>
                                            <option value="Izin" class="text-yellow-800 font-medium">Izin</option>
                                            <option value="Sakit" class="text-sky-800 font-medium">Sakit</option>
                                            <option value="Alfa" class="text-red-800 font-medium">Alfa</option>
                                        </select>
                                    </td>
                                </tr>
                                @endif
                                @empty
                                <tr>
                                    <td colspan="4" class="p-3 text-center text-gray-500">
                                        <div class="py-12">
                                            <i class="fa-solid fa-user-check text-5xl text-gray-400 mb-4"></i>
                                            <p class="text-gray-600 font-semibold text-lg">Semua siswa telah diabsen.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end items-center mt-6 border-t pt-6">
                        <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-indigo-700 transition duration-300 flex items-center">
                            <i class="fa-solid fa-save mr-2"></i>
                            Simpan Absensi
                        </button>
                    </div>
                </form>
            </div>

            <!-- Siswa Sudah Diabsen -->
             <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Siswa Sudah Diabsen</h2>
                 <div class="overflow-x-auto">
                    <table class="w-full min-w-[700px] text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">NISN</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Nama Siswa</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Jenis Kelamin</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Status Kehadiran</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse (($daftarSiswa ?? []) as $siswa)
                            @if ($siswa->status != null)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 text-gray-700">{{$siswa->siswa->nisn_nik}}</td>
                                <td class="p-3 text-gray-800 font-medium">{{$siswa->siswa->name}}</td>
                                <td class="p-3 text-gray-700">{{$siswa->siswa->jenis_kelamin}}</td>
                                <td class="p-3">
                                    @if ($siswa->status == 'Hadir')
                                    <span class="bg-green-100 text-green-800 font-medium py-1 px-3 rounded-full text-xs">Hadir</span>
                                    @elseif ($siswa->status == 'Izin')
                                    <span class="bg-yellow-100 text-yellow-800 font-medium py-1 px-3 rounded-full text-xs">Izin</span>
                                    @elseif ($siswa->status == 'Sakit')
                                    <span class="bg-sky-100 text-sky-800 font-medium py-1 px-3 rounded-full text-xs">Sakit</span>
                                    @elseif ($siswa->status == 'Alfa')
                                    <span class="bg-red-100 text-red-800 font-medium py-1 px-3 rounded-full text-xs">Alfa</span>
                                    @endif
                                </td>
                                <td class="p-3 text-center">
                                    <button type="button" class="edit-absen-button text-blue-600 hover:text-blue-800" title="Edit"
                                        data-nama="{{$siswa->siswa->name}}"
                                        data-nisn="{{$siswa->siswa->nisn_nik}}"
                                        data-status="{{$siswa->status}}"
                                        data-url="{{ route('updateAbsensiSiswa', $siswa->id_daftar_absensi_siswa) }}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td colspan="5" class="p-3 text-center text-gray-500">
                                    <div class="py-12">
                                        <i class="fa-solid fa-folder-open text-5xl text-gray-400 mb-4"></i>
                                        <p class="text-gray-600 font-semibold text-lg">Belum ada siswa yang diabsen.</p>
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

    <!-- Edit Absen Modal -->
    <div id="editAbsenModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md transform transition-all duration-300 ease-in-out scale-95 opacity-0" id="editModalContent">
            <div class="flex justify-between items-center border-b border-gray-200 p-6">
                <h3 class="text-2xl font-bold text-gray-800">Edit Absensi Siswa</h3>
                <button id="closeModal" class="text-gray-400 hover:text-gray-600 focus:outline-none transition duration-200">
                    <i class="fa-solid fa-times text-2xl"></i>
                </button>
            </div>
            <form id="editAbsenForm" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
                        <input type="text" id="editNamaSiswa" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                        <input type="text" id="editNisn" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none" readonly>
                    </div>
                    <div>
                        <label for="editStatus" class="block text-sm font-medium text-gray-700 mb-1">Status Kehadiran</label>
                        <select id="editStatus" name="status" class="select-status w-full p-2 border rounded-lg font-semibold">
                            <option value="Hadir" class="text-green-800 font-medium">Hadir</option>
                            <option value="Izin" class="text-yellow-800 font-medium">Izin</option>
                            <option value="Sakit" class="text-sky-800 font-medium">Sakit</option>
                            <option value="Alfa" class="text-red-800 font-medium">Alfa</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 bg-gray-50 p-6 rounded-b-2xl">
                    <button type="button" id="cancelEdit" class="bg-gray-200 text-gray-800 font-semibold py-2 px-6 rounded-lg hover:bg-gray-300 transition duration-300">
                        Batal
                    </button>
                    <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition duration-300">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Sidebar Toggle Functionality ---
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
        
        // --- Attendance Coloring and Bulk Action ---
        const statusSelects = document.querySelectorAll('.select-status');
        const hadirSemuaBtn = document.getElementById('hadir-semua-btn');
        
        const statusColors = {
            Hadir: 'status-hadir',
            Izin: 'status-Izin',
            Sakit: 'status-Sakit',
            Alfa: 'status-Alfa'
        };

        function updateSelectColor(selectElement) {
            Object.values(statusColors).forEach(className => selectElement.classList.remove(className));
            const selectedStatus = selectElement.value;
            if (statusColors[selectedStatus]) {
                selectElement.classList.add(statusColors[selectedStatus]);
            }
        }

        statusSelects.forEach(select => {
            select.addEventListener('change', (event) => updateSelectColor(event.target));
            updateSelectColor(select); // Initial color update
        });
        
        if (hadirSemuaBtn) {
            hadirSemuaBtn.addEventListener('click', () => {
                const unabsentedSelects = document.querySelectorAll("form[action='{{ route('storeAbsensiSiswa')}}'] .select-status");
                unabsentedSelects.forEach(select => {
                    select.value = 'Hadir';
                    updateSelectColor(select);
                });
            });
        }

        // --- Edit Absen Modal Logic ---
        const editModal = document.getElementById('editAbsenModal');
        if (editModal) {
            const modalContent = document.getElementById('editModalContent');
            const closeModalButton = editModal.querySelector('#closeModal');
            const cancelEditButton = editModal.querySelector('#cancelEdit');
            const editButtons = document.querySelectorAll('.edit-absen-button');
            
            const editForm = document.getElementById('editAbsenForm');
            const editNamaSiswaInput = document.getElementById('editNamaSiswa');
            const editNisnInput = document.getElementById('editNisn');
            const editStatusSelect = document.getElementById('editStatus');

            const openModal = (nama, nisn, status, url) => {
                editNamaSiswaInput.value = nama;
                editNisnInput.value = nisn;
                editStatusSelect.value = status;
                editForm.action = url;
                updateSelectColor(editStatusSelect); // Update color in modal select

                editModal.classList.remove('hidden');
                setTimeout(() => modalContent.classList.remove('scale-95', 'opacity-0'), 10);
            };

            const closeModal = () => {
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => editModal.classList.add('hidden'), 300);
            };

            editButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const btn = e.currentTarget;
                    openModal(
                        btn.dataset.nama || 'N/A',
                        btn.dataset.nisn || 'N/A',
                        btn.dataset.status || 'Hadir',
                        btn.dataset.url || '#'
                    );
                });
            });

            closeModalButton.addEventListener('click', closeModal);
            cancelEditButton.addEventListener('click', closeModal);
            editModal.addEventListener('click', (e) => {
                if (e.target === editModal) closeModal();
            });
            editStatusSelect.addEventListener('change', () => updateSelectColor(editStatusSelect));
        }

        // --- SweetAlert2 Notifications ---
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

            Swal.fire({ icon: 'error', title: 'Gagal Validasi', html: errorText });
        }
    });
    </script>

</body>
</html>
