<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Acara Sekolah - EduSys</title>
    <!-- Tailwind CSS CDN -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- SweetAlert2 CDN untuk Notifikasi -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="{{ asset('asset/school-solid-full.png') }}">
    <style>
        /* Custom styles */
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        /* Override untuk memastikan card selalu full width di container grid satu kolom */
        .event-card > div {
            width: 100%;
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
            <a href="{{ route('manajAcara') }}" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 transition duration-200">
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
            {{-- Session Messages Handling --}}
            @if(session('success'))
                <div id="session-success" data-message="{{ session('success') }}" class="hidden"></div>
            @endif
            @if(session('error'))
                <div id="session-error" data-message="{{ session('error') }}" class="hidden"></div>
            @endif
            @if ($errors->any())
                <div id="validation-errors" data-errors='@json($errors->all())' class="hidden"></div>
            @endif

            <!-- START: Content Header/Intro -->
            <header class="mb-8 bg-indigo-600 p-8 rounded-2xl shadow-lg text-white">
                <h2 class="text-3xl font-bold mb-2">Manajemen Acara</h2>
                <p class="text-indigo-200">Kelola semua kegiatan, jadwal, dan acara penting sekolah.</p>
            </header>
            <!-- END: Content Header/Intro -->

            <div class="bg-white p-6 rounded-xl shadow-md">
                <!-- Action Bar -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Acara</h2>
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <div class="relative w-full md:w-64">
                            <input type="text" id="search-input" placeholder="Cari acara..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <i class="fa-solid fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <!-- Tombol Tambah Acara -->
                        <button id="btn-add" class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 flex items-center whitespace-nowrap shadow-md hover:shadow-lg">
                            <i class="fa-solid fa-plus mr-2"></i>
                            Tambah Acara
                        </button>
                    </div>
                </div>
                
                <!-- Card View Acara -->
                <div class="grid grid-cols-1 gap-6" id="event-list-container">
                    @forelse($daftarAcara ?? [] as $acara)
                        @php
                            // safety: ensure Carbon parsing
                            $isPast = \Carbon\Carbon::parse($acara->tanggal_selesai)->lt(\Carbon\Carbon::now());
                            $startIso = \Carbon\Carbon::parse($acara->tanggal_mulai)->format('Y-m-d\TH:i');
                            $endIso = \Carbon\Carbon::parse($acara->tanggal_selesai)->format('Y-m-d\TH:i');
                        @endphp

                        <div class="event-card" 
                             data-id="{{ $acara->id_daftar_acara }}"
                             data-judul="{{ e($acara->judul_acara) }}"
                             data-tanggal-mulai="{{ $startIso }}"
                             data-tanggal-selesai="{{ $endIso }}"
                             data-lokasi="{{ e($acara->lokasi) }}"
                             data-peserta="{{ e($acara->peserta) }}"
                             data-deskripsi="{{ e($acara->deskripsi) }}">
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
                                            <p><i class="fa-solid fa-calendar-day w-5 mr-2 {{ $isPast ? 'text-gray-500' : 'text-indigo-500' }}"></i> {{ \Carbon\Carbon::parse($acara->tanggal_mulai)->format('d M Y') }}</p>
                                        @else
                                            <p><i class="fa-solid fa-calendar-day w-5 mr-2 {{ $isPast ? 'text-gray-500' : 'text-indigo-500' }}"></i> {{ \Carbon\Carbon::parse($acara->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($acara->tanggal_selesai)->format('d M Y') }}</p>
                                        @endif
                                        <p><i class="fa-solid fa-clock w-5 mr-2 {{ $isPast ? 'text-gray-500' : 'text-indigo-500' }}"></i> {{ \Carbon\Carbon::parse($acara->tanggal_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($acara->tanggal_selesai)->format('H:i') }}</p>
                                        <p><i class="fa-solid fa-location-dot w-5 mr-2 {{ $isPast ? 'text-gray-500' : 'text-indigo-500' }}"></i> {{ $acara->lokasi }}</p>
                                    </div>
                                    
                                    <div class="flex justify-between items-center border-t pt-4">
                                        <span class="text-xs font-medium text-gray-500">
                                            <i class="fa-solid fa-user-group mr-1"></i> {{ $acara->peserta }}
                                        </span>
                                        <div class="flex items-center">
                                            <button type="button" class="edit-btn text-indigo-600 hover:text-indigo-900 mx-1 p-1 transition" title="Edit Acara" data-id="{{ $acara->id_daftar_acara }}">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>

                                            <!-- Delete: hidden form + visible button that JS will confirm -->
                                            <form id="delete-form-{{ $acara->id_daftar_acara }}" action="{{ route('admin.acara.destroy', $acara->id_daftar_acara) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete-btn text-red-600 hover:text-red-900 mx-1 p-1 transition" title="Hapus Acara" data-id="{{ $acara->id_daftar_acara }}" data-title="{{ $acara->judul_acara }}">
                                                    <i class="fa-solid fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div id="empty-state" class="w-full flex flex-col items-center justify-center text-center p-10 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                            <i class="fa-solid fa-calendar-xmark text-5xl text-gray-400 mb-3"></i>
                            <h3 class="text-lg font-semibold text-gray-600">Belum ada acara</h3>
                            <p class="text-sm text-gray-500 mt-1">Silakan tambahkan acara baru agar muncul di daftar.</p>
                            <button id="add-event-from-empty" class="mt-4 inline-block px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg shadow hover:bg-indigo-700 transition">
                                <i class="fa-solid fa-plus mr-1"></i> Tambah Acara
                            </button>
                        </div>
                    @endforelse
                </div>
                <!-- Pesan jika tidak ada hasil pencarian -->
                <div id="no-results-message" class="hidden w-full flex-col items-center justify-center text-center p-10 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                    <i class="fa-solid fa-magnifying-glass text-5xl text-gray-400 mb-3"></i>
                    <h3 class="text-lg font-semibold text-gray-600">Acara tidak ditemukan</h3>
                    <p class="text-sm text-gray-500 mt-1">Coba gunakan kata kunci pencarian yang berbeda.</p>
                </div>
            </div>
        </main>
    </div>

<!-- Modal for Add/Edit New Event (POPUP FORM) -->
<div id="event-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[9999] hidden flex justify-center items-center p-4" aria-modal="true" role="dialog">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto transform transition-all">
        <!-- Modal Header -->
        <div class="p-6 border-b flex justify-between items-center sticky top-0 bg-white z-10">
            <h3 class="text-2xl font-bold text-gray-800" id="modal-title">
                <i class="fa-solid fa-calendar-plus mr-2 text-indigo-600"></i> Tambah Acara Baru
            </h3>
            <button id="close-modal-button" class="text-gray-400 hover:text-gray-600 transition p-2 rounded-full hover:bg-gray-100">
                <i class="fa-solid fa-times text-2xl"></i>
            </button>
        </div>

        <!-- Modal Body (Form) -->
        <!-- Default action -> store; JS akan mengganti action & method saat edit -->
        <form id="event-form" action="{{ route('admin.acara.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            <!-- method override (set by JS to PUT on edit) -->
            <input type="hidden" name="_method" id="form_method" value="">

            <!-- Hidden ID field for editing -->
            <input type="hidden" id="event_id" name="event_id"> 

            <!-- Hidden fields expected by controller -->
            <input type="hidden" id="tanggal_acara" name="tanggal_acara">
            <input type="hidden" id="waktu_acara" name="waktu_acara">
            
            <!-- Judul Acara -->
            <div>
                <label for="judul_acara" class="block text-sm font-medium text-gray-700 mb-1">Judul Acara <span class="text-red-500">*</span></label>
                <input type="text" id="judul_acara" name="judul_acara" placeholder="Contoh: Lomba Sains Nasional" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
            </div>

            <!-- Tanggal dan Waktu Acara (Visible: datetime-local untuk UX) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="waktu_mulai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal & Waktu Mulai <span class="text-red-500">*</span></label>
                    <input type="datetime-local" id="waktu_mulai" name="waktu_mulai" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                </div>
                <div>
                    <label for="waktu_berakhir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal & Waktu Berakhir <span class="text-red-500">*</span></label>
                    <input type="datetime-local" id="waktu_berakhir" name="waktu_berakhir" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                </div>
            </div>

            <!-- Lokasi -->
            <div>
                <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi <span class="text-red-500">*</span></label>
                <input type="text" id="lokasi" name="lokasi" placeholder="Contoh: Aula Serbaguna Lantai 2" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
            </div>

            <!-- Peserta Target (Manual Input) -->
            <div>
                <label for="peserta_target" class="block text-sm font-medium text-gray-700 mb-1">Peserta Target <span class="text-red-500">*</span></label>
                <input type="text" id="peserta_target" name="peserta_target" placeholder="Contoh: Siswa Kelas X-XII, Guru Mapel Fisika, dll." required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
            </div>

            <!-- Deskripsi Acara -->
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Jelaskan secara singkat tujuan dan rangkaian acara." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"></textarea>
            </div>

            <!-- Modal Footer (Tombol Aksi) -->
            <div class="flex justify-end pt-4 border-t sticky bottom-0 bg-white">
                <button type="button" id="cancel-button" class="px-5 py-2 mr-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-100 transition duration-300">
                    Batal
                </button>
                <button type="submit" id="save-button" class="px-5 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:bg-indigo-700 transition duration-300 transform hover:scale-[1.02]">
                    <i class="fa-solid fa-save mr-2"></i> Simpan Acara
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // --- STATE & SELECTORS ---
    const btnAdd = document.getElementById('btn-add');
    const menuButton = document.getElementById('menu-button');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const eventModal = document.getElementById('event-modal');
    const closeModalButton = document.getElementById('close-modal-button');
    const cancelButton = document.getElementById('cancel-button');
    const eventForm = document.getElementById('event-form');
    const modalTitle = document.getElementById('modal-title');
    const saveButton = document.getElementById('save-button');
    const eventListContainer = document.getElementById('event-list-container');
    const emptyState = document.getElementById('empty-state');
    const addFromEmptyBtn = document.getElementById('add-event-from-empty');
    const searchInput = document.getElementById('search-input');

    // route base for update (will append /{id})
    const updateBaseUrl = "{{ url('manajemen-acara/acara-sekolah') }}";

    // default store url (already on form action by blade)
    const storeUrl = "{{ route('admin.acara.store') }}";

    // --- SIDEBAR ---
    menuButton.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });
    overlay.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    // --- MODAL HELPERS ---
    function openAddModal() {
        // Reset form to add mode
        eventForm.reset();
        eventForm.action = storeUrl;
        document.getElementById('form_method').value = '';
        document.getElementById('event_id').value = '';
        modalTitle.innerHTML = '<i class="fa-solid fa-calendar-plus mr-2 text-indigo-600"></i> Tambah Acara Baru';
        saveButton.innerHTML = '<i class="fa-solid fa-save mr-2"></i> Simpan Acara';
        showModal();
    }

    function showModal() {
        eventModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    function hideModal() {
        eventModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    btnAdd.addEventListener('click', openAddModal);
    if (addFromEmptyBtn) addFromEmptyBtn.addEventListener('click', openAddModal);
    closeModalButton.addEventListener('click', hideModal);
    cancelButton.addEventListener('click', hideModal);
    // close on overlay click
    eventModal.addEventListener('click', (e) => { if (e.target === eventModal) hideModal(); });

    // --- Fill modal for Edit ---
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const id = btn.getAttribute('data-id');
            // find parent card
            const card = btn.closest('.event-card');
            if (!card) return;
            const judul = card.getAttribute('data-judul') || '';
            const tanggalMulai = card.getAttribute('data-tanggal-mulai') || '';
            const tanggalSelesai = card.getAttribute('data-tanggal-selesai') || '';
            const lokasi = card.getAttribute('data-lokasi') || '';
            const peserta = card.getAttribute('data-peserta') || '';
            const deskripsi = card.getAttribute('data-deskripsi') || '';

            // set form to update
            eventForm.action = updateBaseUrl + '/' + id;
            document.getElementById('form_method').value = 'PUT'; // override method
            document.getElementById('event_id').value = id;

            // visible fields
            document.getElementById('judul_acara').value = judul;
            document.getElementById('waktu_mulai').value = tanggalMulai;
            document.getElementById('waktu_berakhir').value = tanggalSelesai;
            document.getElementById('lokasi').value = lokasi;
            document.getElementById('peserta_target').value = peserta;
            document.getElementById('deskripsi').value = deskripsi;

            // change modal title and button
            modalTitle.innerHTML = `<i class="fa-solid fa-edit mr-2 text-indigo-600"></i> Edit Acara ID: ${id}`;
            saveButton.innerHTML = '<i class="fa-solid fa-save mr-2"></i> Update Acara';

            showModal();
        });
    });

    // --- Delete with confirmation (SweetAlert) ---
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const id = btn.getAttribute('data-id');
            const title = btn.getAttribute('data-title') || 'acara ini';
            Swal.fire({
                title: 'Konfirmasi Hapus Acara',
                text: `Anda yakin ingin menghapus acara: "${title}"? Tindakan ini tidak dapat dibatalkan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-form-' + id);
                    if (form) {
                        form.submit();
                    } else {
                        // fallback: direct fetch delete (not used normally)
                        Swal.fire('Gagal', 'Form hapus tidak ditemukan.', 'error');
                    }
                }
            });
        });
    });

    // --- Before submit: convert visible datetime-local(waktu_mulai) -> tanggal_acara + waktu_acara fields (controller expects those) ---
    eventForm.addEventListener('submit', (e) => {
        // Validate visible date/time presence
        const waktuMulaiVal = document.getElementById('waktu_mulai').value;
        const waktuBerakhirVal = document.getElementById('waktu_berakhir').value;

        if (!waktuMulaiVal || !waktuBerakhirVal) {
            e.preventDefault();
            Swal.fire({ icon: 'error', title: 'Form Tidak Lengkap', text: 'Harap isi tanggal & waktu mulai dan berakhir.'});
            return;
        }

        // basic validation: mulai < berakhir
        // if (new Date(waktuMulaiVal) >= new Date(waktuBerakhirVal)) {
        //     e.preventDefault();
        //     Swal.fire({ icon: 'error', title: 'Kesalahan Validasi', text: 'Tanggal & waktu mulai harus sebelum berakhir.'});
        //     return;
        // }

        // derive tanggal_acara & waktu_acara from waktu_mulai
        const parts = waktuMulaiVal.split('T'); // ["YYYY-MM-DD", "HH:MM"]
        if (parts.length === 2) {
            document.getElementById('tanggal_acara').value = parts[0];
            // ensure seconds are not included (controller expects HH:mm)
            document.getElementById('waktu_acara').value = parts[1].slice(0,5);
        } else {
            // fallback — do nothing
        }

        // let the form submit normally (server-side will store)
    });

    // --- Search (client-side filter on rendered cards) ---
    searchInput.addEventListener('keyup', () => {
        const term = searchInput.value.toLowerCase().trim();
        const allCards = document.querySelectorAll('.event-card');
        const noResultsMessage = document.getElementById('no-results-message');
        let visibleCount = 0;

        document.querySelectorAll('.event-card').forEach(card => {
            const title = (card.getAttribute('data-judul') || '').toLowerCase();
            const desc = (card.getAttribute('data-deskripsi') || '').toLowerCase();
            const lokasi = (card.getAttribute('data-lokasi') || '').toLowerCase();
            const peserta = (card.getAttribute('data-peserta') || '').toLowerCase();

            if (title.includes(term) || desc.includes(term) || lokasi.includes(term) || peserta.includes(term)) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Tampilkan atau sembunyikan pesan "tidak ditemukan"
        const hasEvents = allCards.length > 0;
        noResultsMessage.style.display = (hasEvents && visibleCount === 0) ? 'flex' : 'none';
    });

    // --- Flash messages (SweetAlert) ---
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
</script>
</body>
</html>