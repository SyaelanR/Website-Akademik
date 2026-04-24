<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Klien - Sistem Manajemen Sekolah</title>
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
                <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Tambah Klien Baru</h1>
                <div class="flex items-center space-x-4">
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 md:p-8 flex-1">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-4">
                        <h2 class="text-2xl font-bold text-gray-800">Formulir Pendaftaran Klien</h2>
                         <a href="#" class="bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 transition duration-300 flex items-center whitespace-nowrap">
                            <i class="fa-solid fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                    
                    <form action = "{{ route('storeKlien')}}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Sekolah -->
                            <div class="md:col-span-2">
                                <label for="school-name" class="block text-sm font-medium text-gray-700 mb-2">Nama Sekolah</label>
                                <input name="nama_sekolah" type="text" id="school-name" placeholder="Masukkan nama lengkap sekolah" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>
                            <!-- Email -->
                            <div>
                                <label for="school-email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input name="email" type="email" id="school-email" placeholder="contoh: info@sekolah.sch.id" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>
                            <!-- No Telp -->
                            <div>
                                <label for="school-phone" class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                                <input name="no_telp" type="tel" id="school-phone" placeholder="contoh: (021) 123-4567" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>
                            <!-- Alamat -->
                            <div class="md:col-span-2">
                                 <label for="school-address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                                 <textarea name="alamat" id="school-address" rows="4" placeholder="Masukkan alamat lengkap sekolah" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end gap-4 mt-8 border-t border-gray-200 pt-6">
                            <button onclick="window.location.href='{{ route('dashboard') }}';" type="button" class="bg-gray-200 text-gray-700 font-semibold py-2 px-5 rounded-lg hover:bg-gray-300 transition duration-300">
                                Batal
                            </button>
                            <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-5 rounded-lg hover:bg-indigo-700 transition duration-300">
                                <i class="fa-solid fa-plus mr-2"></i>
                                Tambahkan Klien
                            </button>
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
    </script>

</body>
</html>
