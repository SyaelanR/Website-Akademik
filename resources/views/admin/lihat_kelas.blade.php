
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kelas - Sistem Manajemen Sekolah</title>
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
        .modal {
            transition: opacity 0.3s ease-in-out;
        }
        .modal-content {
             transition: transform 0.3s ease-in-out;
        }
        .custom-checkbox {
            appearance: none;
            background-color: #fff;
            border: 1px solid #d1d5db;
            border-radius: 0.25rem;
            width: 1.25rem;
            height: 1.25rem;
            cursor: pointer;
            position: relative;
            transition: background-color 0.2s, border-color 0.2s;
        }
        .custom-checkbox:checked {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }
        .custom-checkbox:checked::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: white;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-size: 0.75rem;
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
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Detail Kelas</h1>
            <div class="flex items-center space-x-4">
                
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1">
             <!-- Page Header -->
            <header class="mb-8 bg-indigo-600 p-6 rounded-2xl shadow-lg text-white">
                <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold">Kelas: {{ $infoKelas->nama_kelas ?? 'Belum Ada' }}</h1>
                        <div class="flex flex-wrap items-center gap-x-6 gap-y-2 mt-3 text-indigo-200">
                            <div class="flex items-center">
                                <i class="fa-solid fa-user-tie mr-2"></i>
                                <span>Wali Kelas: <strong>{{$infoKelas->wali_kelas ?? 'Belum Dipilih'}}</strong></span>
                            </div>
                            <div class="flex items-center">
                                 <i class="fa-solid fa-calendar-days mr-2"></i>
                                 <span>Tahun Ajaran: <strong>{{$infoKelas->angkatan->angkatan ?? 'Belum Dipilih'}}</strong></span>
                            </div>
                            <div class="flex items-center">
                                 <i class="fa-solid fa-users mr-2"></i>
                                 <span>Total Siswa: <strong>{{$jumlahSiswa ?? '0'}}</strong></span>
                            </div>
                        </div>
                    </div>
                     <a href="{{ route('manajemenKelas') }}" class="flex-shrink-0 inline-flex items-center bg-white text-indigo-600 hover:bg-gray-100 transition duration-300 px-4 py-2 rounded-lg shadow-md font-semibold">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </header>
            
            <div class="bg-white p-6 rounded-xl shadow-md">
                <!-- Action Bar -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                     <div class="relative w-full md:w-1/2">
                        <input type="text" id="student-search-input" placeholder="Cari siswa di kelas ini..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <i class="fa-solid fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <button id="add-student-btn" class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 flex items-center whitespace-nowrap shadow-md hover:shadow-lg">
                        <i class="fa-solid fa-user-plus mr-2"></i>
                        Tambah Siswa
                    </button>
                </div>

                <!-- Students Table -->
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[700px] text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">NISN</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Nama Siswa</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Jenis Kelamin</th>
                                <th class="p-3 font-semibold text-gray-600 uppercase text-sm text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="student-table-body" class="divide-y">
                            @forelse ($daftarSiswa ?? [] as $siswa)
                            <tr class="student-row hover:bg-gray-50">
                                <td class="p-3 text-gray-700">{{$siswa->nisn_nik}}</td>
                                <td class="p-3 text-gray-800 font-medium">{{$siswa->name}}</td>
                                <td class="p-3 text-gray-700">{{$siswa->jenis_kelamin}}</td>
                                <td class="p-3 text-center">
                                    <form action="{{ route('keluarkanSiswaDariKelas', ['id_siswa' => $siswa->id, 'id_kelas' => $infoKelas->id_kelas]) }}" method="POST" class="remove-student-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-student-name="{{ $siswa->name }}" class="text-red-500 hover:text-red-700 transition-colors" title="Keluarkan dari Kelas">
                                            <i class="fa-solid fa-user-minus"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr id="empty-row">
                                <td colspan="4" class="p-3 text-center text-gray-500">
                                    <div class="text-center py-12">
                                        <i class="fa-solid fa-users-slash text-5xl text-gray-400 mb-4"></i>
                                        <p class="text-gray-600 font-semibold text-lg">Belum ada siswa di kelas ini.</p>
                                        <p class="text-gray-500 mt-2">Silakan tambahkan siswa ke kelas ini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div id="no-results-row" class="text-center py-12 hidden">
                        <i class="fa-solid fa-magnifying-glass text-5xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600 font-semibold text-lg">Siswa tidak ditemukan.</p>
                        <p class="text-gray-500 mt-2">Coba gunakan kata kunci pencarian yang berbeda.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
    
<!-- Add Student Modal -->
<div id="add-student-modal" class="modal fixed inset-0 bg-gray-900 bg-opacity-75 z-50 flex items-center justify-center p-4 hidden opacity-0">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-2xl transform transition-transform duration-300 scale-95">
        <div class="flex justify-between items-center p-6 border-b">
            <h3 class="text-2xl font-semibold text-gray-800">Tambah Siswa ke Kelas <span class="text-indigo-600">{{ $infoKelas->nama_kelas ?? '-' }}</span></h3>
            <button id="close-modal-btn" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <form action="{{ route('tambahSiswaKeKelas') }}" method="POST">
            @csrf
            <input type="hidden" name="id_kelas" value="{{ $id_kelas ?? '' }}">
            <div class="p-6">
                <div class="border rounded-lg max-h-72 overflow-y-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr>
                                <th class="p-3 font-semibold text-gray-600 text-left uppercase text-sm">NISN</th>
                                <th class="p-3 font-semibold text-gray-600 text-left uppercase text-sm">Nama Siswa</th>
                                <th class="p-3 w-16 text-center">
                                    <input type="checkbox" id="select-all" class="custom-checkbox" title="Pilih Semua">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($daftarSiswaBelumPunyaKelas ?? [] as $siswa)
                            <tr>
                                <td class="p-3 text-gray-700">{{ $siswa->nisn_nik }}</td>
                                <td class="p-3 text-gray-800 truncate">{{ $siswa->name }}</td>
                                <td class="p-3 text-center"><input type="checkbox" name="siswa_ids[]" value="{{ $siswa->id }}" class="custom-checkbox student-checkbox"></td>
                           </tr>
                           @empty
                           <tr>
                                <td colspan="3" class="p-3 text-center text-gray-500">
                                    <div class="text-center py-12">
                                       <i class="fa-solid fa-check-circle text-5xl text-gray-400 mb-4"></i>
                                       <p class="text-gray-600 font-semibold text-lg">Semua siswa sudah memiliki kelas.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-end gap-4 p-6 bg-gray-50 rounded-b-xl">
                <button type="button" id="cancel-btn" class="bg-gray-200 text-gray-700 font-semibold py-2 px-6 rounded-lg hover:bg-gray-300 transition duration-300">Batal</button>
                <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition duration-300">Tambahkan Siswa</button>
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

        menuButton.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
        
        // --- Modal Functionality ---
        const addStudentModal = document.getElementById('add-student-modal');
        const modalContent = addStudentModal.querySelector('.modal-content');
        const addStudentBtn = document.getElementById('add-student-btn');
        const closeModalBtn = document.getElementById('close-modal-btn');
        const cancelBtn = document.getElementById('cancel-btn');

        const openModal = () => {
            addStudentModal.classList.remove('hidden');
            setTimeout(() => {
                addStudentModal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
            }, 10);
        };

        const closeModal = () => {
            modalContent.classList.add('scale-95');
            addStudentModal.classList.add('opacity-0');
            setTimeout(() => {
                addStudentModal.classList.add('hidden');
            }, 300);
        };

        addStudentBtn.addEventListener('click', openModal);
        closeModalBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);
        addStudentModal.addEventListener('click', (event) => {
            if (event.target === addStudentModal) {
                closeModal();
            }
        });
        
        // --- Checkbox functionality ---
        const selectAllCheckbox = document.getElementById('select-all');
        const studentCheckboxes = document.querySelectorAll('.student-checkbox');
        
        if(selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', (event) => {
                studentCheckboxes.forEach(checkbox => {
                    checkbox.checked = event.target.checked;
                });
            });
        }

        // --- Remove student confirmation ---
        const removeForms = document.querySelectorAll('.remove-student-form');
        removeForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const studentName = this.querySelector('button').dataset.studentName;
                
                Swal.fire({
                    title: 'Konfirmasi',
                    text: `Apakah Anda yakin ingin mengeluarkan ${studentName} dari kelas ini?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Keluarkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });

        // --- Search functionality for students in class ---
        const searchInput = document.getElementById('student-search-input');
        const tableBody = document.getElementById('student-table-body');
        const studentRows = tableBody.querySelectorAll('.student-row');
        const noResultsRow = document.getElementById('no-results-row');
        const emptyRow = document.getElementById('empty-row'); // The row that shows "Belum ada siswa"

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            let visibleRows = 0;

            studentRows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                if (rowText.includes(searchTerm)) {
                    row.style.display = '';
                    visibleRows++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Logic to show/hide messages
            const hasStudents = studentRows.length > 0;
            noResultsRow.style.display = (hasStudents && visibleRows === 0) ? 'block' : 'none';
            if(emptyRow) emptyRow.style.display = (hasStudents && visibleRows > 0) ? 'none' : (hasStudents ? 'none' : 'table-row');

        });
    });

</script>

</body>
</html>
