<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Guru - Sistem Manajemen Sekolah</title>
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
        /* Sidebar transition */
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        /* Style for table inputs */
        .table-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .table-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.3);
        }
        /* New style to always show horizontal scrollbar */
        .force-scroll-x {
            overflow-x: auto; /* Menggunakan auto agar scrollbar muncul hanya jika dibutuhkan */
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
            <a href="{{ route('manajemenGuru') }}" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 transition duration-200">
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
            <h1 class="text-lg sm:text-xl md:text-2xl font-semibold text-gray-800 truncate">Tambah Guru Baru</h1>
            <div class="flex items-center space-x-4">
                
            </div>
        </header>

            <!-- Page Content -->
            <main class="p-6 md:p-8 flex-1">
                <header class="mb-8 bg-indigo-600 p-8 rounded-2xl shadow-lg text-white">
                    <h2 class="text-3xl font-bold mb-2">Manajemen Guru</h2>
                    <p class="text-indigo-200">Kelola semua data guru dan staf yang terdaftar di sekolah.</p>
                </header>

                <div class="bg-white p-6 rounded-xl shadow-md">
                    <!-- Form Header -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Form Tambah Guru Massal</h2>
                        <p class="text-gray-500 mt-1">Isi data Guru pada baris yang tersedia. Klik "Tambah Baris" untuk menambahkan lebih banyak Guru.</p>
                    </div>

                    <!-- Session Messages Handling -->
                    @if(session('success'))
                        <div id="session-success" data-message="{{ session('success') }}" class="hidden"></div>
                    @endif
                    @if ($errors->any())
                        <div id="validation-errors" data-errors='@json($errors->all())' class="hidden"></div>
                    @endif

                    <!-- teacher Form Table -->
                    <form id="add-teacher-form" method="POST" action="{{ route('storeGuru') }}">@csrf
                        <!-- MODIFIED: Changed overflow-x: auto for better responsiveness -->
                        <div class="force-scroll-x">
                            <table class="w-full min-w-[1200px] text-left">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <!-- MODIFIED: min-width removed for better responsiveness -->
                                        <th class="p-3 font-semibold text-gray-600 uppercase text-sm whitespace-nowrap" style="min-width: 150px;">NIK</th>
                                        <th class="p-3 font-semibold text-gray-600 uppercase text-sm whitespace-nowrap" style="min-width: 250px;">Nama Guru</th>
                                        <th class="p-3 font-semibold text-gray-600 uppercase text-sm whitespace-nowrap" style="min-width: 300px;">Alamat</th>
                                        <th class="p-3 font-semibold text-gray-600 uppercase text-sm whitespace-nowrap" style="min-width: 200px;">Tempat lahir</th>
                                        <th class="p-3 font-semibold text-gray-600 uppercase text-sm whitespace-nowrap" style="min-width: 180px;">Tanggal lahir</th>
                                        <th class="p-3 font-semibold text-gray-600 uppercase text-sm whitespace-nowrap" style="min-width: 250px;">Nomor Telp</th>
                                        <th class="p-3 font-semibold text-gray-600 uppercase text-sm whitespace-nowrap" style="min-width: 100px;">Jabatan</th>
                                        <th class="p-3 font-semibold text-gray-600 uppercase text-sm whitespace-nowrap" style="min-width: 180px;">Username</th>
                                        <th class="p-3 font-semibold text-gray-600 uppercase text-sm whitespace-nowrap" style="min-width: 180px;">Password</th>
                                        <th class="p-3 font-semibold text-gray-600 uppercase text-sm text-center whitespace-nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="teacher-table-body" class="divide-y">
                                    <!-- Dynamic rows will be inserted here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Action Buttons for Table -->
                        <div class="mt-6 flex flex-col md:flex-row justify-between items-center gap-4 pt-6 border-t">
                            <button type="button" id="add-row-btn" class="w-full md:w-auto bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300 flex items-center justify-center shadow-md">
                                <i class="fa-solid fa-plus mr-2"></i>
                                Tambah Baris
                            </button>
                            <div class="flex w-full md:w-auto gap-4">
                               <a href="{{ route('manajemenGuru') }}" class="w-full md:w-auto bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 transition duration-300 text-center flex items-center justify-center">
                                    Batal
                                </a>
                                <button type="submit" class="w-full md:w-auto bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 shadow-md">
                                    <i class="fa-solid fa-save mr-2"></i>
                                    Simpan Semua
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>

    <script>
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

        // --- Dynamic Table Row Functionality ---
        const addRowBtn = document.getElementById('add-row-btn');
        const tableBody = document.getElementById('teacher-table-body');
        let rowCount = 0;

        // Function to create and add a new row
        const addNewRow = () => {
            rowCount++;
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50';
            row.innerHTML = `
                <td class="p-2">
                    <input type="text" name="teacher[${rowCount}][nik]" placeholder="Contoh: 19850315..." class="table-input" />
                </td>
                <td class="p-2">
                    <input type="text" name="teacher[${rowCount}][nama]" placeholder="Nama Lengkap Guru" class="table-input" />
                </td>
                <td class="p-2">
                    <input type="text" name="teacher[${rowCount}][alamat]" placeholder="Alamat" class="table-input" />
                </td>
                <td class="p-2">
                    <input type="text" name="teacher[${rowCount}][tempat_lahir]" placeholder="Tempat lahir" class="table-input" />
                </td>
                <td class="p-2">
                    <input type="date" name="teacher[${rowCount}][tanggal_lahir]" class="table-input" />
                </td>
                <td class="p-2">
                    <input type="tel" name="teacher[${rowCount}][nomor_telp]" placeholder="Nomor Telp" class="table-input" />
                </td>
                <td class="p-2">
                    <select name="teacher[${rowCount}][jabatan]" class="table-input">
                        <option value="guru">Guru</option>
                        <option disabled value="staf">Staf</option>
                    </select>
                </td>
                <td class="p-2">
                    <input type="text" name="teacher[${rowCount}][username]" placeholder="Username unik" class="table-input" />
                </td>
                <td class="p-2">
                    <input type="password" name="teacher[${rowCount}][password]" placeholder="Password default" class="table-input" />
                </td>
                <td class="p-2 text-center">
                    <button type="button" class="text-red-500 hover:text-red-700 delete-row-btn" title="Hapus Baris">
                        <i class="fa-solid fa-trash-alt text-lg"></i>
                    </button>
                </td>
            `;
            tableBody.appendChild(row);
        };

        // Add initial rows on page load
        document.addEventListener('DOMContentLoaded', () => {
            addNewRow(); // Start with one empty row
        });

        // Event listener for the "Add Row" button
        addRowBtn.addEventListener('click', addNewRow);

        // Event listener for deleting rows (using event delegation)
        tableBody.addEventListener('click', (event) => {
            const deleteButton = event.target.closest('.delete-row-btn');
            if (deleteButton) {
                // Prevent deleting the last row
                if (tableBody.rows.length > 1) {
                    deleteButton.closest('tr').remove();
                } else {
                    alert("Tidak bisa menghapus baris terakhir.");
                }
            }
        });

        // --- SweetAlert2 Notifications for Success ---
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

        // --- SweetAlert2 Notifications for Validation Errors ---
        const validationErrors = document.getElementById('validation-errors');
        if (validationErrors) {
            try {
                const errorsData = validationErrors.dataset.errors;
                // Replace HTML entities that might break JSON parsing
                const sanitizedErrorsData = errorsData.replace(/&quot;/g, '"');
                const errors = JSON.parse(sanitizedErrorsData);
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
            } catch (e) {
                console.error("Error parsing validation errors:", e);
            }
        }

    </script>
</body>
</html>