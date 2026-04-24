<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Klien - Sistem Manajemen Sekolah</title>
    <!-- Tailwind CSS CDN -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- SweetAlert2 -->
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
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
            visibility: hidden;
            opacity: 0; /* Start hidden */
        }
        .modal.show {
            opacity: 1;
            visibility: visible;
        }
        .modal-content {
            transition: transform 0.3s ease-in-out;
            transform: scale(0.95);
        }
        .modal.show .modal-content {
            transform: scale(1);
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar bg-white w-64 min-h-screen flex-shrink-0 shadow-lg fixed lg:relative z-50 transform -translate-x-full lg:translate-x-0">
            <div class="p-6">
                <a href="#" class="flex items-center space-x-3">
                    <i class="fa-solid fa-shield-halved text-3xl text-indigo-600"></i>
                    <span class="text-2xl font-bold text-gray-800">AdminSys</span>
                </a>
            </div>
            <nav class="mt-6">
                 <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100 hover:font-semibold">
                    <i class="fa-solid fa-tachometer-alt w-6 h-6 mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 bg-gray-200 font-semibold">
                    <i class="fa-solid fa-building-user w-6 h-6 mr-3"></i>
                    <span>Manajemen Klien</span>
                </a>
            </nav>
           <div class="p-6 border-t border-gray-200 flex-shrink-0">
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
                <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Detail Klien Sekolah</h1>
                <div class="flex items-center space-x-4">
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 md:p-8 flex-1">
                {{-- Success and Error Messages --}}
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                        <p class="font-bold">Sukses</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
                        <p class="font-bold">Terjadi Kesalahan</p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Client Information Section -->
                <div class="bg-white p-6 rounded-xl shadow-md mb-8">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                        <h2 class="text-2xl font-bold text-gray-800">Informasi Klien</h2>
                        <div class="flex space-x-3 mt-4 md:mt-0">
                            <button id="edit-client-btn" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300 flex items-center whitespace-nowrap shadow-md">
                                <i class="fa-solid fa-pencil mr-2"></i> Edit Klien
                            </button>
                            <a href="{{ route('dashboard') }}" class="bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 transition duration-300 flex items-center whitespace-nowrap">
                                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex items-center mb-8">
                            <div class="bg-indigo-100 p-4 rounded-full mr-5">
                                <i class="fa-solid fa-school-flag text-3xl text-indigo-600"></i>
                            </div>
                            <div>
                                <h3 id="client-name-display" class="text-2xl font-bold text-gray-900">{{$info_sekolah->nama_sekolah}}</h3>
                                <p class="text-gray-500">ID Klien: {{$info_sekolah->id_sekolah}}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Email -->
                            <div class="bg-gray-50 p-4 rounded-lg flex items-start space-x-4">
                                <i class="fa-solid fa-envelope text-xl text-gray-400 mt-1"></i>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Email</label>
                                    <p id="client-email-display" class="text-md font-semibold text-gray-800">{{$info_sekolah->email}}</p>
                                </div>
                            </div>
                            <!-- Nomor HP -->
                            <div class="bg-gray-50 p-4 rounded-lg flex items-start space-x-4">
                                <i class="fa-solid fa-phone text-xl text-gray-400 mt-1"></i>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Nomor HP</label>
                                    <p id="client-phone-display" class="text-md font-semibold text-gray-800">{{$info_sekolah->no_telp}}</p>
                                </div>
                            </div>
                            <!-- Alamat -->
                            <div class="bg-gray-50 p-4 rounded-lg flex items-start space-x-4 md:col-span-2">
                                <i class="fa-solid fa-map-marker-alt text-xl text-gray-400 mt-1"></i>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Alamat</label>
                                    <p id="client-address-display" class="text-md font-semibold text-gray-800">{{$info_sekolah->alamat}}</p>
                                </div>
                            </div>
                             <!-- Status Klien -->
                            <div class="bg-gray-50 p-4 rounded-lg flex items-start space-x-4">
                                <i class="fa-solid fa-toggle-on text-xl text-gray-400 mt-1"></i>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Status Klien</label>
                                    <p id="client-status-display" class="mt-1">
                                         @if($info_sekolah->status == 'Aktif')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                        @elseif($info_sekolah->status == 'Pending')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Non-Aktif</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- School Admins Section -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                     <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <h2 class="text-2xl font-bold text-gray-800">Daftar Admin Sekolah</h2>
                        <button id="add-admin-btn" type="button" onclick="window.location='{{ route('tambahAdminKlien', ['id_sekolah' => $info_sekolah->id_sekolah]) }}'" class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 flex items-center whitespace-nowrap">
                            <i class="fa-solid fa-user-plus mr-2"></i>
                            Tambah Admin
                        </button>
                    </div>
                    <!-- Admins Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[600px] text-left">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="p-3 font-semibold text-gray-600">Nama</th>
                                    <th class="p-3 font-semibold text-gray-600">Email</th>
                                    <th class="p-3 font-semibold text-gray-600">No telp</th>
                                    <th class="p-3 font-semibold text-gray-600">Username</th>
                                    <th class="p-3 font-semibold text-gray-600 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse ($admin_sekolah as $admin)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 text-gray-800 font-medium">{{$admin->name}}</td>
                                    <td class="p-3 text-gray-700">{{$admin->email}}</td>
                                    <td class="p-3 text-gray-700">{{$admin->no_telp}}</td>
                                    <td class="p-3 text-gray-700">{{$admin->username}}</td>
                                    <td class="p-3 text-center">
                                        <div class="flex justify-center space-x-4">
                                            <button class="text-blue-600 hover:text-blue-800 edit-admin-btn" title="Edit Admin"
                                                data-id="{{ $admin->id }}"
                                                data-name="{{ $admin->name }}"
                                                data-email="{{ $admin->email }}"
                                                data-username="{{ $admin->username }}"
                                                data-alamat="{{ $admin->alamat }}"
                                                data-no_telp="{{ $admin->no_telp }}"
                                                data-nik="{{ $admin->nisn_nik }}"
                                                >
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            <form action="{{ route('destroyAdminKlien', ['id' => $admin->id]) }}" method="POST" class="inline-block delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="p-3 text-center text-gray-500">
                                        <div class="text-center py-12">
                                            <i class="fa-solid fa-exclamation-circle text-5xl text-gray-400 mb-4"></i>
                                            <p class="text-gray-600 font-semibold text-lg">Belum ada data Admin.</p>
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

    <!-- Modal Edit Klien -->
    <div id="edit-client-modal" class="modal fixed inset-0 bg-black bg-opacity-50 z-[60] flex items-center justify-center p-4 opacity-0">
        <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-lg">
            <div class="flex justify-between items-center p-6 border-b">
                <h2 class="text-2xl font-bold text-gray-800">Edit Informasi Klien</h2>
                <button class="close-modal-btn text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-times text-2xl"></i>
                </button>
            </div>
            <form id="edit-client-form" method="POST" action="{{ route('updateKlien', ['id' => $info_sekolah->id_sekolah]) }}">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
                    <div>
                        <label for="edit-client-name" class="block text-gray-700 font-semibold mb-2">Nama Sekolah</label>
                        <input type="text" id="edit-client-name" name="nama_sekolah" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label for="edit-client-email" class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" id="edit-client-email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label for="edit-client-phone" class="block text-gray-700 font-semibold mb-2">Nomor HP</label>
                        <input type="tel" id="edit-client-phone" name="no_telp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label for="edit-client-address" class="block text-gray-700 font-semibold mb-2">Alamat</label>
                        <textarea id="edit-client-address" name="alamat" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required></textarea>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Status</label>
                        <div class="flex items-center space-x-6">
                            <label class="flex items-center">
                                <input type="radio" name="status" value="Aktif" class="form-radio h-4 w-4 text-indigo-600">
                                <span class="ml-2 text-gray-700">Aktif</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="status" value="Pending" class="form-radio h-4 w-4 text-indigo-600">
                                <span class="ml-2 text-gray-700">Pending</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="status" value="Non-Aktif" class="form-radio h-4 w-4 text-indigo-600">
                                <span class="ml-2 text-gray-700">Non-Aktif</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 p-6 bg-gray-50 rounded-b-xl border-t">
                    <button type="button" class="cancel-modal-btn py-2 px-6 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition duration-300">Batal</button>
                    <button type="submit" class="py-2 px-6 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-300">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Admin -->
    <div id="edit-admin-modal" class="modal fixed inset-0 bg-black bg-opacity-50 z-[60] flex items-center justify-center p-4 opacity-0">
        <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-lg">
            <div class="flex justify-between items-center p-6 border-b">
                <h2 class="text-2xl font-bold text-gray-800">Edit Admin Sekolah</h2>
                <button class="close-modal-btn text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-times text-2xl"></i>
                </button>
            </div>
            <form id="edit-admin-form" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
                    <div>
                        <label for="edit-nik" class="block text-gray-700 font-semibold mb-2">NIK</label>
                        <input type="text" id="edit-nik" name="nik" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label for="edit-name" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                        <input type="text" id="edit-name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label for="edit-email" class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" id="edit-email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label for="edit-no_telp" class="block text-gray-700 font-semibold mb-2">No-telp</label>
                        <input type="text" id="edit-no_telp" name="no_telp" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label for="edit-alamat" class="block text-gray-700 font-semibold mb-2">Alamat</label>
                        <input type="text" id="edit-alamat" name="alamat" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label for="edit-username" class="block text-gray-700 font-semibold mb-2">Username</label>
                        <input type="text" id="edit-username" name="username" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label for="edit-password" class="block text-gray-700 font-semibold mb-2">Password Baru (Opsional)</label>
                        <input type="password" id="edit-password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Kosongkan jika tidak diubah">
                    </div>
                </div>
                <div class="flex justify-end space-x-4 p-6 bg-gray-50 rounded-b-xl border-t">
                    <button type="button" class="cancel-modal-btn py-2 px-6 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition duration-300">Batal</button>
                    <button type="submit" class="py-2 px-6 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-300">Simpan Perubahan</button>
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

            if (menuButton && sidebar && overlay) {
                menuButton.addEventListener('click', toggleSidebar);
                overlay.addEventListener('click', toggleSidebar);
            }

            // --- Generic Modal Logic ---
             const openModal = (modal) => {
                if (modal) {
                    modal.classList.add('show');
                }
            };

            const closeModal = (modal) => {
                 if (modal) {
                    modal.classList.remove('show');
                }
            };

             // --- Edit Client Modal Functionality ---
            const editClientModal = document.getElementById('edit-client-modal');
            const editClientBtn = document.getElementById('edit-client-btn');
            const editClientForm = document.getElementById('edit-client-form');

            if (editClientBtn && editClientModal && editClientForm) {
                 editClientBtn.addEventListener('click', function() {
                    // Populate client modal fields (using data from Blade variables)
                    document.getElementById('edit-client-name').value = "{{ $info_sekolah->nama_sekolah }}";
                    document.getElementById('edit-client-email').value = "{{ $info_sekolah->email }}";
                    document.getElementById('edit-client-phone').value = "{{ $info_sekolah->no_telp }}";
                    document.getElementById('edit-client-address').value = "{{ $info_sekolah->alamat }}";
                    
                    // Set radio button for status
                    const currentStatus = "{{ $info_sekolah->status }}";
                    const statusRadio = document.querySelector(`#edit-client-modal input[name="status"][value="${currentStatus}"]`);
                    if (statusRadio) {
                        statusRadio.checked = true;
                    }
                    
                    openModal(editClientModal);
                });
            }


            // --- Edit Admin Modal Functionality ---
            const editAdminModal = document.getElementById('edit-admin-modal');
            const editAdminButtons = document.querySelectorAll('.edit-admin-btn');
            const editAdminForm = document.getElementById('edit-admin-form');

            editAdminButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const data = this.dataset;
                    
                    // Set form action URL
                    let url = "{{ route('updateAdminKlien', ':id') }}";
                    editAdminForm.action = url.replace(':id', data.id);
                    
                    // Populate form fields
                    document.getElementById('edit-name').value = data.name;
                    document.getElementById('edit-email').value = data.email;
                    document.getElementById('edit-username').value = data.username;
                    document.getElementById('edit-password').value = ''; // Clear password
                    document.getElementById('edit-no_telp').value = data.no_telp;
                    document.getElementById('edit-alamat').value = data.alamat;
                    document.getElementById('edit-nik').value = data.nik;
                    
                    openModal(editAdminModal);
                });
            });

            // --- Event Listeners for Closing Modals ---
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        closeModal(modal);
                    }
                });
                 // Find close and cancel buttons within *this* modal
                const closeBtn = modal.querySelector('.close-modal-btn');
                const cancelBtn = modal.querySelector('.cancel-modal-btn');
                if (closeBtn) {
                     closeBtn.addEventListener('click', () => closeModal(modal));
                }
                 if (cancelBtn) {
                    cancelBtn.addEventListener('click', () => closeModal(modal));
                }
            });

            // --- Delete Confirmation ---
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data ini akan dihapus secara permanen!", // More generic message
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
        });
    </script>

</body>
</html>
