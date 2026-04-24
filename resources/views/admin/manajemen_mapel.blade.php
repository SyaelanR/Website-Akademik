<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Mata Pelajaran - EduSys</title>
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
         /* Modal transition */
        .modal {
            transition: opacity 0.3s ease-in-out;
        }
        .modal-content {
             transition: transform 0.3s ease-in-out;
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
            <a href="{{ route('manajemenMapel') }}" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 transition duration-200">
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
            <!-- Mobile Menu Button -->
            <button id="menu-button" class="lg:hidden text-gray-600 focus:outline-none">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Manajemen Mata Pelajaran</h1>
            <div class="flex items-center space-x-4">
                
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1">
            {{-- Container untuk notifikasi dari session, akan dihandle oleh JS --}}
            @if ($errors->any())
                <div id="validation-errors" data-errors='@json($errors->all())' class="hidden"></div>
            @endif
            @if (session('success'))
                <div id="session-success" data-message="{{ session('success') }}" class="hidden"></div>
            @endif
            @if (session('error'))
                <div id="session-error" data-message="{{ session('error') }}" class="hidden"></div>
            @endif

            <header class="mb-8 bg-indigo-600 p-6 rounded-2xl shadow-lg text-white">
                <h1 class="text-2xl md:text-3xl font-bold">Manajemen Mata Pelajaran</h1>
                <p class="text-indigo-200 mt-2">Tambah, edit, atau hapus data mata pelajaran dari sistem.</p>
            </header>

            <div class="bg-white p-6 rounded-xl shadow-md">
                <!-- Action Bar -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Mata Pelajaran</h2>
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <form action="{{ route('manajemenMapel') }}" method="GET">
                            <div class="relative w-full md:w-64">
                                <input value="{{ $search }}" name="search" type="text" id="search" placeholder="Cari mapel, guru, kode..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <i class="fa-solid fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </form>
                        <button id="add-mapel-btn" class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 flex items-center whitespace-nowrap shadow-md hover:shadow-lg">
                            <i class="fa-solid fa-plus mr-2"></i>
                            Tambah Mapel
                        </button>
                    </div>
                </div>

                <!-- Subjects Table -->
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[800px] text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Mapel</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Kode Mapel</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Kategori</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">SKS</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Guru</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Status</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" id="mapel-table-body">
                            @forelse ($mapels as $mapel)
                            <tr class="mapel-row hover:bg-gray-50">
                                <td class="p-3 text-gray-800 font-medium">{{$mapel->nama_mapel}}</td>
                                <td class="p-3 text-gray-700">{{$mapel->kode_mapel}}</td>
                                <td class="p-3 text-gray-700">{{$mapel->kategori}}</td>
                                <td class="p-3 text-gray-700 text-center">{{$mapel->sks}}</td>
                                <td class="p-3 text-gray-700">{{$mapel->guru->name ?? 'Belum Diatur'}}</td>
                                <td class="p-3">
                                    @if ($mapel->status === 'nonaktif')
                                    <span class="bg-red-100 text-red-700 font-medium py-1 px-3 rounded-full text-xs">Nonaktif</span>
                                    @else
                                    <span class="bg-green-100 text-green-700 font-medium py-1 px-3 rounded-full text-xs">Aktif</span>
                                    @endif
                                </td>
                                <td class="p-3 text-center">
                                    <div class="flex justify-center items-center space-x-4">
                                        <button class="edit-btn text-blue-600 hover:text-blue-800 transition-colors duration-200" title="Edit"
                                            data-id="{{ $mapel->id_mapel }}"
                                            data-nama_mapel="{{ $mapel->nama_mapel }}"
                                            data-kode_mapel="{{ $mapel->kode_mapel }}"
                                            data-kategori="{{ $mapel->kategori }}"
                                            data-sks="{{ $mapel->sks }}"
                                            data-guru_id="{{ $mapel->id_guru }}"
                                            data-status="{{ $mapel->status }}">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button> 
                                        <form action="{{ route('destroyMapel', $mapel->id_mapel) }}" method="POST" class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors duration-200" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr id="empty-row">
                                <td colspan="7" class="p-3 text-center text-gray-500">
                                    @if ($search)
                                    <i class="fa-solid fa-magnifying-glass text-4xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-600 font-semibold text-lg">Mapel tidak ditemukan.</p>
                                    <p class="text-gray-500 mt-1">Tidak ada mapel yang cocok dengan kata kunci "{{ $search }}".</p>
                                    @else
                                    <div class="text-center py-12">
                                        <i class="fa-solid fa-folder-open text-5xl text-gray-400 mb-4"></i>
                                        <p class="text-gray-600 font-semibold text-lg">Belum ada data Mapel.</p>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- paganation --}}
                    <div class="mt-6">
                        {!! $mapels->appends(request()->query())->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Add Subject Modal -->
<div id="add-mapel-modal" class="modal fixed inset-0 bg-gray-900 bg-opacity-75 z-50 flex items-center justify-center p-4 hidden opacity-0">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-lg transform transition-transform duration-300 scale-95">
        <div class="flex justify-between items-center p-6 border-b">
            <h3 class="text-2xl font-semibold text-gray-800">Tambah Mata Pelajaran</h3>
            <button class="close-modal-btn text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <form id="add-mapel-form" action="{{ route('storeMapel') }}" method="POST">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label for="nama-mapel" class="block text-gray-700 font-medium mb-2">Nama Mapel</label>
                    <input name="nama_mapel" type="text" placeholder="Contoh: Kimia" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <div>
                    <label for="kode-mapel" class="block text-gray-700 font-medium mb-2">Kode Mapel</label>
                    <input name="kode_mapel" type="text" placeholder="Contoh: STR21" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="kategori-mapel" class="block text-gray-700 font-medium mb-2">Kategori</label>
                        <select name="kategori" id="kategori-mapel" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white" required>
                            <option value="Umum">Umum</option>
                            <option value="IT">IT</option>
                            <option value="Tahfidz">Tahfidz</option>
                            <option value="Eskul">Eskul</option>
                        </select>
                    </div>
                    <div>
                        <label for="sks-mapel" class="block text-gray-700 font-medium mb-2">SKS</label>
                        <input name="sks" type="number" placeholder="3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                </div>
                <div>
                    <label for="guru-pengampu" class="block text-gray-700 font-medium mb-2">
                        Guru Pengampu
                    </label>
                    <div class="relative">
                        <select name="guru_id" size="6"
                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5
                                text-gray-800 text-sm shadow-sm focus:outline-none focus:ring-2
                                focus:ring-indigo-500 focus:border-indigo-500
                                overflow-y-auto max-h-60 appearance-none">
                            <option value="" disabled class="text-gray-400 italic">
                                Pilih Guru
                            </option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" class="hover:bg-indigo-100">
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Tambahkan ikon panah kecil (opsional) -->
                        <span class="absolute right-3 top-2.5 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-angle-down"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-4 p-6 bg-gray-50 rounded-b-xl">
                <button type="button" class="cancel-btn bg-gray-200 text-gray-700 font-semibold py-2 px-6 rounded-lg hover:bg-gray-300 transition duration-300">Batal</button>
                <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition duration-300">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Subject Modal -->
<div id="edit-mapel-modal"
    class="modal fixed inset-0 bg-gray-900 bg-opacity-75 z-50 flex items-center justify-center p-4 hidden opacity-0">
    <div
        class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-lg transform transition-transform duration-300 scale-95 max-h-[90vh] flex flex-col">
        
        <!-- Header -->
        <div class="flex justify-between items-center p-6 border-b flex-shrink-0">
            <h3 class="text-2xl font-semibold text-gray-800">Edit Mata Pelajaran</h3>
            <button class="close-modal-btn text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>

        <!-- Scrollable content -->
        <form id="edit-mapel-form" method="POST" class="flex-1 overflow-y-auto">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-4">
                <div>
                    <label for="edit-nama-mapel" class="block text-gray-700 font-medium mb-2">Nama Mapel</label>
                    <input name="nama_mapel" type="text" id="edit-nama-mapel" placeholder="Contoh: Kimia"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                </div>
                <div>
                    <label for="edit-kode-mapel" class="block text-gray-700 font-medium mb-2">Kode Mapel</label>
                    <input name="kode_mapel" type="text" id="edit-kode-mapel" placeholder="Contoh: STR21"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="edit-kategori-mapel" class="block text-gray-700 font-medium mb-2">Kategori</label>
                        <select name="kategori" id="edit-kategori-mapel"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white"
                            required>
                            <option value="Umum">Umum</option>
                            <option value="IT">IT</option>
                            <option value="Tahfidz">Tahfidz</option>
                            <option value="Eskul">Eskul</option>
                        </select>
                    </div>
                    <div>
                        <label for="edit-sks-mapel" class="block text-gray-700 font-medium mb-2">SKS</label>
                        <input name="sks" type="number" id="edit-sks-mapel" placeholder="3"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>
                </div>
                <div>
                    <label for="edit-guru-pengampu" class="block text-gray-700 font-medium mb-2">Guru Pengampu</label>
                    <div class="relative">
                        <select name="guru_id" id="edit-guru-pengampu" size="6"
                            class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-gray-800 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 overflow-y-auto max-h-60 appearance-none">
                            <option value="" disabled class="text-gray-400 italic">Pilih Guru</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" class="hover:bg-indigo-100">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        <span class="absolute right-3 top-2.5 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-angle-down"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="status-mapel" class="block text-gray-700 font-medium mb-2">Status</label>
                    <select name="status" id="edit-status-mapel"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white"
                        required>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>

            <!-- Footer (sticky at bottom) -->
            <div class="flex justify-end gap-4 p-6 bg-gray-50 rounded-b-xl flex-shrink-0 border-t">
                <button type="button"
                    class="cancel-btn bg-gray-200 text-gray-700 font-semibold py-2 px-6 rounded-lg hover:bg-gray-300 transition duration-300">
                    Batal
                </button>
                <button type="submit"
                    class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition duration-300">
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

        const toggleSidebar = () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        };

        menuButton.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

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

        const errorMessage = document.getElementById('session-error');
        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: errorMessage.dataset.message,
            });
        }

        const validationErrors = document.getElementById('validation-errors');
        if (validationErrors) {
            const errors = JSON.parse(validationErrors.dataset.errors);
            let errorText = '';
            errors.forEach(error => {
                errorText += `<p class="text-left">${error}</p>`;
            });
            Swal.fire({
                icon: 'error',
                title: 'Oops... Ada kesalahan!',
                html: `<div class="mt-2">${errorText}</div>`,
            });
        }

        // --- Add/Edit Modal Functionality ---
        const addMapelModal = document.getElementById('add-mapel-modal');
        const editMapelModal = document.getElementById('edit-mapel-modal');
        const addMapelBtn = document.getElementById('add-mapel-btn');
        const closeModalBtns = document.querySelectorAll('.close-modal-btn');
        const cancelBtns = document.querySelectorAll('.cancel-btn');

        const addMapelForm = document.getElementById('add-mapel-form');
        const editMapelForm = document.getElementById('edit-mapel-form');
        const tableBody = document.getElementById('mapel-table-body');


        const openModal = (modal, content) => {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
            }, 10);
        };

        const closeModal = (modal, content) => {
            content.classList.add('scale-95');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        };

        addMapelBtn.addEventListener('click', () => {
            addMapelForm.reset();
            openModal(addMapelModal, addMapelModal.querySelector('.modal-content'));
        });

        tableBody.addEventListener('click', function(event) {
            const editBtn = event.target.closest('.edit-btn');
            if (editBtn) {
                const data = editBtn.dataset;

                // Populate edit form
                document.getElementById('edit-nama-mapel').value = data.nama_mapel;
                document.getElementById('edit-kode-mapel').value = data.kode_mapel;
                document.getElementById('edit-kategori-mapel').value = data.kategori;
                document.getElementById('edit-sks-mapel').value = data.sks;
                document.getElementById('edit-guru-pengampu').value = data.guru_id;
                document.getElementById('edit-status-mapel').value = data.status;

                // Set form action
                let updateUrl = "{{ route('updateMapel', ':id') }}";
                editMapelForm.action = updateUrl.replace(':id', data.id);

                openModal(editMapelModal, editMapelModal.querySelector('.modal-content'));
            }
        });


        // --- DELETE Confirmation ---
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data mata pelajaran yang dihapus tidak dapat dikembalikan!",
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

        // Close modal events
        closeModalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const modal = btn.closest('.modal');
                closeModal(modal, modal.querySelector('.modal-content'));
            });
        });
        cancelBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const modal = btn.closest('.modal');
                closeModal(modal, modal.querySelector('.modal-content'));
            });
        });
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', (event) => {
                if (event.target === modal) {
                    closeModal(modal, modal.querySelector('.modal-content'));
                }
            });
        });
    });
</script>

</body>
</html>
