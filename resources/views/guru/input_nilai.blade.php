<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai - EduSys</title>
    <!-- Tailwind CSS CDN -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts: Inter -->
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
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Input Nilai Siswa</h1>
            <div class="flex items-center space-x-4">
                
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1">
            <!-- Session Messages Handling -->
            @if(session('success'))
                <div id="session-success" data-message="{{ session('success') }}" class="hidden"></div>
            @endif

            <!-- UPDATED HEADER -->
            <header class="mb-8 bg-indigo-600 p-6 rounded-2xl shadow-lg flex flex-wrap justify-between items-center text-white gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">Input Nilai: {{ $infoJKA->mapel->nama_mapel ?? 'N/A' }} - Kelas {{ $infoJKA->kelas->nama_kelas ?? 'N/A' }}</h1>
                    <h2 class="text-xl md:text-2xl font-semibold text-indigo-200 mt-1">{{$infoDaftarNilai->keterangan ?? 'Keterangan Nilai' }}</h2>
                    <p class="text-indigo-200 mt-2">Silakan input nilai untuk siswa yang belum dinilai.</p>
                </div>
                <a href="{{ route('manajemenNilaiDaftar', ['id_kelas' =>  $infoJKA->kelas?->id_kelas, 'id_mapel' => $infoJKA->mapel->id_mapel]) }}" class="flex-shrink-0 inline-flex items-center bg-white text-indigo-600 hover:bg-gray-100 transition duration-300 px-4 py-2 rounded-lg shadow-md font-semibold">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    <span>Kembali</span>
                </a>
            </header>
            
            <!-- Siswa Belum Dinilai -->
            <div class="bg-white p-6 rounded-2xl shadow-xl mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center"><i class="fa-solid fa-pencil-alt text-yellow-500 mr-3"></i>Siswa Belum Dinilai</h2>
                <form action="{{ route('storeNilaiSiswa') }}" method="POST" id="form-belum-dinilai">
                    @csrf
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="border px-4 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Nama Siswa</th>
                                    <th class="border px-4 py-3 text-sm font-semibold text-gray-600 uppercase">NISN</th>
                                    <th class="border px-4 py-3 text-sm font-semibold text-gray-600 uppercase">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse (($daftarSiswa ?? []) as $nilai)
                            @if ($nilai->nilai == '0')
                                <tr class="text-center hover:bg-gray-50">
                                    <td class="border px-4 py-2 text-left">{{$nilai->siswa->name}}</td>
                                    <td class="border px-4 py-2">{{$nilai->siswa->nisn_nik}}</td>
                                    <td class="border px-4 py-2"><input type="number" name="nilai[{{ $nilai->id_daftar_nilai_siswa }}]" min="0" max="100" class="w-24 text-center px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"></td>
                                </tr>
                            @endif
                            @empty
                            <tr class="text-center">
                                <td colspan="3" class="border px-4 py-2 text-center">
                                    <div class="text-center py-12">
                                        <i class="fa-solid fa-folder-open text-5xl text-gray-400 mb-4"></i>
                                        <p class="text-gray-600 font-semibold text-lg">Semua siswa sudah dinilai.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition duration-300 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Simpan Nilai
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Siswa Sudah Dinilai -->
            <div class="bg-white p-6 rounded-2xl shadow-xl">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center"><i class="fa-solid fa-check-circle text-green-500 mr-3"></i>Siswa Sudah Dinilai</h2>
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="border px-4 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Nama Siswa</th>
                                <th class="border px-4 py-3 text-sm font-semibold text-gray-600 uppercase">NISN</th>
                                <th class="border px-4 py-3 text-center text-sm font-semibold text-gray-600 uppercase">Nilai</th>
                                <th class="border px-4 py-3 text-center text-sm font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (($daftarSiswa ?? []) as $nilai)
                            @if ($nilai->nilai != '0')
                            <tr class="text-center hover:bg-gray-50">
                                <td class="border px-4 py-2 text-left">{{$nilai->siswa->name}}</td>
                                <td class="border px-4 py-2">{{$nilai->siswa->nisn_nik}}</td>
                                <td class="border px-4 py-2 font-semibold text-gray-700">{{$nilai->nilai}}</td>
                                <td class="border px-4 py-2">
                                    <!-- 
                                        LARAVEL ROUTE NOTE: The error "Route [updateNilaiSiswa] not defined" 
                                        means you need to define this route in your 'routes/web.php' file. 
                                        See the chat response for an example route definition.
                                    -->
                                    <button type="button" class="edit-button text-blue-600 hover:text-blue-800 transition duration-200" title="Edit"
                                        data-nama="{{$nilai->siswa->name}}"
                                        data-nisn="{{$nilai->siswa->nisn_nik}}"
                                        data-nilai="{{$nilai->nilai}}"
                                        data-url="{{ route('updateNilaiSiswa', $nilai->id_daftar_nilai_siswa) }}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                            @endif
                            @empty
                            <tr class="text-center">
                                <td colspan="4" class="border px-4 py-2 text-center">
                                    <div class="text-center py-12">
                                        <i class="fa-solid fa-folder-open text-5xl text-gray-400 mb-4"></i>
                                        <p class="text-gray-600 font-semibold text-lg">Belum ada siswa yang dinilai.</p>
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

    <!-- Edit Nilai Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md transform transition-all duration-300 ease-in-out scale-95 opacity-0" id="editModalContent">
            <div class="flex justify-between items-center border-b border-gray-200 p-6">
                <h3 class="text-2xl font-bold text-gray-800">Edit Nilai Siswa</h3>
                <button id="closeModal" class="text-gray-400 hover:text-gray-600 focus:outline-none transition duration-200">
                    <i class="fa-solid fa-times text-2xl"></i>
                </button>
            </div>
            <form id="editForm" method="POST"> <!-- action will be set by JS -->
                @csrf
                @method('PUT') <!-- Use PUT method for updates -->
                <div class="p-6 space-y-4">
                    <div>
                        <label for="editNamaSiswa" class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
                        <input type="text" id="editNamaSiswa" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none" readonly>
                    </div>
                    <div>
                        <label for="editNisn" class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                        <input type="text" id="editNisn" class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none" readonly>
                    </div>
                    <div>
                        <label for="editNilai" class="block text-sm font-medium text-gray-700 mb-1">Nilai</label>
                        <input type="number" id="editNilai" name="nilai" min="0" max="100" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 bg-gray-50 p-6 rounded-b-2xl">
                    <button type="button" id="cancelEdit" class="bg-gray-200 text-gray-800 font-semibold py-2 px-6 rounded-lg hover:bg-gray-300 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                        Batal
                    </button>
                    <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition duration-300 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- UPDATED SCRIPT with Modal and Notification Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Sidebar Toggle Logic ---
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
            }

            // --- Edit Nilai Modal Logic ---
            const editModal = document.getElementById('editModal');
            if (editModal) {
                const editModalContent = document.getElementById('editModalContent');
                const closeModalButton = document.getElementById('closeModal');
                const cancelEditButton = document.getElementById('cancelEdit');
                const editButtons = document.querySelectorAll('.edit-button');
                
                const editForm = document.getElementById('editForm');
                const editNamaSiswaInput = document.getElementById('editNamaSiswa');
                const editNisnInput = document.getElementById('editNisn');
                const editNilaiInput = document.getElementById('editNilai');

                const openModal = (nama, nisn, nilai, url) => {
                    // Populate form fields
                    editNamaSiswaInput.value = nama;
                    editNisnInput.value = nisn;
                    editNilaiInput.value = nilai;
                    editForm.action = url;

                    // Show modal with a smooth transition
                    editModal.classList.remove('hidden');
                    setTimeout(() => {
                        editModalContent.classList.remove('scale-95', 'opacity-0');
                    }, 10);
                };

                const closeModal = () => {
                    // Hide modal with a smooth transition
                    editModalContent.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        editModal.classList.add('hidden');
                    }, 300); // This duration should match the transition duration in CSS
                };

                // Add click event to all edit buttons
                editButtons.forEach(button => {
                    button.addEventListener('click', (e) => {
                        e.preventDefault(); 
                        const btn = e.currentTarget;
                        const nama = btn.dataset.nama || 'Tidak ada nama';
                        const nisn = btn.dataset.nisn || 'Tidak ada NISN';
                        const nilai = btn.dataset.nilai || '0';
                        const url = btn.dataset.url || '#';
                        
                        openModal(nama, nisn, nilai, url);
                    });
                });

                // Add click events to close the modal
                closeModalButton.addEventListener('click', closeModal);
                cancelEditButton.addEventListener('click', closeModal);
                editModal.addEventListener('click', (e) => {
                    if (e.target === editModal) {
                        closeModal();
                    }
                });
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
        });
    </script>
</body>
</html>