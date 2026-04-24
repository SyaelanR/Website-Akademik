<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unggah Tugas: {{ $tugasSiswa->daftarNilai->keterangan ?? 'Tugas' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('asset/school-solid-full.png') }}">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }
        .sidebar { transition: transform 0.3s ease-in-out; }
        .file-upload-area.dragover {
            border-color: #4f46e5; /* indigo-600 */
            background-color: #eef2ff; /* indigo-50 */
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar bg-white w-64 min-h-screen flex-shrink-0 shadow-lg fixed lg:relative z-50 transform -translate-x-full lg:translate-x-0">
        <div class="p-6">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                <i class="fa-solid fa-school text-3xl text-indigo-600"></i>
                <span class="text-2xl font-bold text-gray-800">EduSys</span>
            </a>
        </div>
        <nav class="mt-6">
            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-tachometer-alt w-6 mr-3"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('lihatNilaiMapel')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
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
            <a href="{{ route('lihatPengumumanSiswa')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
                <i class="fa-solid fa-bullhorn mr-3"></i>
                <span>Pengumuman</span>
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
            <button id="menu-button" class="lg:hidden text-gray-600 focus:outline-none">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Unggah Jawaban Tugas</h1>
            <div class="flex items-center space-x-4">
                <img class="h-10 w-10 rounded-full object-cover" src="https://placehold.co/100x100/667eea/ffffff?text=S" alt="User avatar">
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 md:p-8 flex-1">
            <header class="mb-8 bg-indigo-600 p-6 rounded-2xl shadow-lg flex flex-wrap justify-between items-center text-white gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">Tugas: {{ $tugasSiswa->daftarNilai->keterangan ?? 'Tugas' }}</h1>
                    <p class="text-indigo-200 mt-2">Mapel: {{ $tugasSiswa->daftarNilai->mapel->nama_mapel ?? 'N/A' }}</p>
                </div>
                <a href="{{ route('lihatTugasDaftar', $tugasSiswa->id_mapel) }}" class="flex-shrink-0 inline-flex items-center bg-white text-indigo-600 hover:bg-gray-100 transition duration-300 px-4 py-2 rounded-lg shadow-md font-semibold">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    <span>Kembali ke Daftar Tugas</span>
                </a>
            </header>

            <div class="bg-white rounded-xl shadow-md p-6 md:p-8 max-w-3xl mx-auto">
                <form action="{{ route('unggahTugas') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_daftar_nilai_siswa" value="{{ $tugasSiswa->id_daftar_nilai_siswa }}">

                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg" role="alert">
                            <p class="font-bold">Terjadi Kesalahan</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="list-disc ml-5">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-6">
                        <label for="file" class="block text-gray-700 font-semibold mb-2">File Jawaban</label>
                        <div id="file-upload-area" class="file-upload-area border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-indigo-500 transition-colors">
                            <input type="file" id="file" name="file" class="hidden" accept=".pdf" required>
                            <div id="file-upload-placeholder">
                                <i class="fa-solid fa-cloud-arrow-up text-4xl text-indigo-500 mb-4"></i>
                                <p class="font-semibold text-gray-700">Klik untuk memilih file</p>
                                <p class="text-sm text-gray-500 mt-1">atau seret dan lepas file di sini</p>
                                <p class="text-xs text-gray-400 mt-2">Hanya file PDF, maks. 10MB</p>
                            </div>
                            <div id="file-name-display" class="hidden items-center justify-center">
                                <i class="fa-solid fa-file-pdf text-3xl text-red-500 mr-3"></i>
                                <span class="font-medium text-gray-800"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-4">
                        <a href="{{ route('lihatTugasDaftar', $tugasSiswa->id_mapel) }}" class="bg-gray-100 text-gray-700 font-semibold py-2 px-6 rounded-lg hover:bg-gray-200 transition-all duration-300">
                            Batal
                        </a>
                        <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition-all duration-300 flex items-center justify-center">
                            <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Jawaban
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Sidebar
            const menuButton = document.getElementById('menu-button');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const toggleSidebar = () => {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            };
            menuButton.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);

            // File Upload UI
            const fileUploadArea = document.getElementById('file-upload-area');
            const fileInput = document.getElementById('file');
            const fileUploadPlaceholder = document.getElementById('file-upload-placeholder');
            const fileNameDisplay = document.getElementById('file-name-display');
            const fileNameSpan = fileNameDisplay.querySelector('span');

            fileUploadArea.addEventListener('click', () => fileInput.click());

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0) {
                    fileNameSpan.textContent = fileInput.files[0].name;
                    fileUploadPlaceholder.classList.add('hidden');
                    fileNameDisplay.classList.remove('hidden');
                    fileNameDisplay.classList.add('flex');
                }
            });

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                fileUploadArea.addEventListener(eventName, e => {
                    e.preventDefault();
                    e.stopPropagation();
                }, false);
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                fileUploadArea.addEventListener(eventName, () => {
                    fileUploadArea.classList.add('dragover');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                fileUploadArea.addEventListener(eventName, () => {
                    fileUploadArea.classList.remove('dragover');
                }, false);
            });

            fileUploadArea.addEventListener('drop', e => {
                fileInput.files = e.dataTransfer.files;
                fileInput.dispatchEvent(new Event('change'));
            }, false);
        });
    </script>
</body>
</html>
