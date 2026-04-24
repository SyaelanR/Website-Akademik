<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin Klien - Sistem Manajemen Sekolah</title>
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
                 <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100 hover:font-semibold">
                    <i class="fa-solid fa-tachometer-alt w-6 h-6 mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ url()->previous() }}" class="flex items-center px-6 py-3 text-gray-700 bg-gray-200 font-semibold">
                    <i class="fa-solid fa-building-user w-6 h-6 mr-3"></i>
                    <span>Manajemen Klien</span>
                </a>
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
                <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Tambah Admin Baru</h1>
                <div class="flex items-center space-x-4">
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 md:p-8 flex-1">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <!-- Form Header -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">
                            Form Tambah Admin Massal {{ $info_sekolah->nama_sekolah }}
                        </h2>
                        <p class="text-gray-500 mt-1">
                            Isi data Admin pada baris yang tersedia. Klik "Tambah Baris" untuk menambahkan lebih banyak Admin.
                        </p>
                    </div>

                    <!-- Admin Form Table -->
                    <form id="add-admin-form" method="POST" action="{{ route('storeAdmin', ['id_sekolah' => $info_sekolah->id_sekolah]) }}">
                        @csrf

                        <!-- ✅ Tambahkan wrapper scroll -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left border-collapse">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="p-3 font-semibold text-gray-600 min-w-[150px]">NIK</th>
                                        <th class="p-3 font-semibold text-gray-600 min-w-[250px]">Nama</th>
                                        <th class="p-3 font-semibold text-gray-600 min-w-[150px]">Alamat</th>
                                        <th class="p-3 font-semibold text-gray-600 min-w-[150px]">Nomor Telp</th>
                                        <th class="p-3 font-semibold text-gray-600 min-w-[150px]">Email</th>
                                        <th class="p-3 font-semibold text-gray-600 min-w-[180px]">Username</th>
                                        <th class="p-3 font-semibold text-gray-600 min-w-[180px]">Password</th>
                                        <th class="p-3 font-semibold text-gray-600 text-center min-w-[80px]">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="admin-table-body" class="divide-y">
                                    <!-- Dynamic rows will be inserted here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-6 flex flex-col md:flex-row justify-between items-center gap-4">
                            <button type="button" id="add-row-btn" class="w-full md:w-auto bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300 flex items-center justify-center">
                                <i class="fa-solid fa-plus mr-2"></i>
                                Tambah Baris
                            </button>

                            <div class="flex w-full md:w-auto gap-4">
                                <a href="{{ route('dashboard') }}" class="w-full md:w-auto bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 transition duration-300 text-center flex items-center justify-center">
                                    Batal
                                </a>
                                <button type="submit" class="w-full md:w-auto bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
                                    <i class="fa-solid fa-save mr-2"></i>
                                    Simpan Semua
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
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
        const tableBody = document.getElementById('admin-table-body');
        let rowCount = 0;

        // Function to create and add a new row
        const addNewRow = () => {
            rowCount++;
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50';
            row.innerHTML = `
                <td class="p-2">
                    <input type="text" name="admin[${rowCount}][nip]" placeholder="Contoh: opsional${rowCount}" class="table-input" />
                </td>
                <td class="p-2">
                    <input type="text" name="admin[${rowCount}][nama]" placeholder="Nama Lengkap" class="table-input" />
                </td>
                <td class="p-2">
                    <input type="text" name="admin[${rowCount}][alamat]" placeholder="alamat" class="table-input" />
                </td>
                <td class="p-2">
                    <input type="text" name="admin[${rowCount}][no_telp]" placeholder="Nomor telephone" class="table-input" />
                </td>
                <td class="p-2">
                    <input type="text" name="admin[${rowCount}][email]" placeholder="Email" class="table-input" />
                </td>
                <td class="p-2">
                    <input type="text" name="admin[${rowCount}][username]" placeholder="Username uniq" class="table-input" />
                </td>
                <td class="p-2">
                    <input type="password" name="admin[${rowCount}][password]" placeholder="Password default" class="table-input" />
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

        // Handle form submission
        const form = document.getElementById('add-admin-form');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.remove());
            document.querySelectorAll('.table-input.border-red-500').forEach(el => el.classList.remove('border-red-500'));

            const formData = new FormData(this);

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token'),
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    // Handle success
                    alert(result.message);
                    window.location.href = "{{ route('dashboard') }}"; // Redirect on success
                } else if (response.status === 422) {
                    // Handle validation errors
                    displayErrors(result.errors);
                    alert('Terdapat kesalahan pada data yang Anda masukkan. Silakan periksa kembali.');
                } else {
                    // Handle other server errors
                    throw new Error(result.message || 'Terjadi kesalahan pada server.');
                }

            } catch (error) {
                console.error('Error:', error);
                alert('Gagal mengirim data. Pastikan tidak ada NIP/Username yang duplikat dan semua kolom terisi.');
            }
        });

        function displayErrors(errors) {
            for (const key in errors) {
                // key akan berbentuk seperti "admin.1.nip"
                // Kita perlu mencari input yang sesuai
                const parts = key.split('.');
                if (parts[0] === 'admin' && parts.length === 3) {
                    const rowKey = parts[1];
                    const fieldName = parts[2];
                    const message = errors[key][0];

                    // Cari input berdasarkan atribut 'name'
                    const input = document.querySelector(`input[name="admin[${rowKey}][${fieldName}]"]`);
                    
                    if (input) {
                        input.classList.add('border-red-500');
                        const errorElement = document.createElement('p');
                        errorElement.className = 'text-red-600 text-xs mt-1 error-message';
                        errorElement.textContent = message;
                        // Sisipkan pesan error setelah input
                        input.parentNode.appendChild(errorElement);
                    }
                }
            }
        }
    </script>

</body>
</html>