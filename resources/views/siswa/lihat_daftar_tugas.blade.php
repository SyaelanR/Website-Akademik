<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas {{ $infoJadwal->mapel->nama_mapel }} - Sistem Manajemen Sekolah</title>
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
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }
        .sidebar { transition: transform 0.3s ease-in-out; }
        .modal-bg { transition: opacity 0.3s ease; }
        .modal-content { transition: transform 0.3s ease-out; }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar bg-white w-64 min-h-screen flex-shrink-0 shadow-lg fixed lg:relative z-50 transform -translate-x-full lg:translate-x-0">
            <div class="p-6">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                    <i class="fa-solid fa-school text-3xl text-indigo-600"></i>
                    <span class="text-2xl font-bold text-gray-800">EduSys</span>
                </a>
            </div>
            <nav class="mt-6">
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('dashboard')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                    <i class="fa-solid fa-tachometer-alt w-6 mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('siswa.profile') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('siswa.profile')) bg-indigo-50 text-indigo-600 @endif">
                    <i class="fa-solid fa-user-circle mr-3"></i>
                    <span>Profil</span>
                </a>
                <a href="{{ route('lihatJadwalS') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatJadwalS')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                    <i class="fa-solid fa-calendar-days w-6 mr-3"></i>
                    <span>Lihat Jadwal</span>
                </a>
                <a href="{{ route('lihatMateriMapel') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatMateriMapel') || request()->routeIs('lihatDaftarMateri')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                    <i class="fa-solid fa-book-open w-6 mr-3"></i>
                    <span>Lihat Materi</span>
                </a>
                <a href="{{ route('lihatTugasMapel') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatTugasMapel') || request()->routeIs('lihatTugasDaftar')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                    <i class="fa-solid fa-upload w-6 mr-3"></i>
                    <span>Lihat Tugas</span>
                </a>
                 <a href="{{ route('lihatAbsensi') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatAbsensi') || request()->routeIs('lihatAbsensi.perMapel')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                    <i class="fa-solid fa-list-check w-6 mr-3"></i>
                    <span>Lihat Absensi</span>
                </a>
                <a href="{{ route('lihatNilaiMapel')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatNilaiMapel') || request()->routeIs('lihatNilaiDaftar')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                    <i class="fa-solid fa-pen w-6 mr-3"></i>
                    <span>Lihat Nilai</span>
                </a>
                <a href="{{ route('lihatPengumumanSiswa')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatPengumumanSiswa')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                    <i class="fa-solid fa-bullhorn w-6 mr-3"></i>
                    <span>Pengumuman</span>
                </a>
                <a href="{{ route('lihatAcaraSiswa')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatAcaraSiswa')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                    <i class="fa-solid fa-calendar-check mr-3"></i>
                    <span>Acara</span>
                </a>
                <a href="{{ route('KRS')}}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200 @if(request()->routeIs('lihatAcaraSiswa')) bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 @endif">
                <i class="fa-solid fa-id-card mr-3"></i>
                <span>KRS</span>
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
                <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Tugas {{ $infoJadwal->mapel->nama_mapel }}</h1>
                <div class="flex items-center space-x-4">
                    
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 md:p-8 flex-1">
                <header class="mb-8 bg-indigo-600 p-6 rounded-2xl shadow-lg flex flex-wrap justify-between items-center text-white gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold">Daftar Tugas: {{ $infoJadwal->mapel->nama_mapel }}</h1>
                        <p class="text-indigo-200 mt-2">Kerjakan tugas-tugas yang diberikan oleh guru!</p>
                    </div>
                    <a href="javascript:void(0)" onclick="history.back()" class="flex-shrink-0 inline-flex items-center bg-white text-indigo-600 hover:bg-gray-100 transition duration-300 px-4 py-2 rounded-lg shadow-md font-semibold">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                </header>

                <!-- Task Card Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse ($daftarTugas ?? [] as $tugas)
                        {{-- Belum Dikerjakan --}}
                        @if ($tugas->nilai == 0 && $tugas->nama_fileTugas == null)
                            <div class="bg-white rounded-xl shadow-md p-6 flex flex-col ring-2 ring-indigo-500">
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-lg font-bold text-gray-800">{{ $tugas->daftarNilai->keterangan ?? 'Tugas Tanpa Judul' }}</h3>
                                        <span class="text-xs font-semibold bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full flex-shrink-0">Belum Dikerjakan</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-4 flex items-center">
                                        {{-- <i class="fa-solid fa-calendar-alt w-4 mr-2 text-gray-400"></i>Deadline:<strong> {{ $tugas->daftarNilai->tugas->deadline ?? 'N/A' }}</strong> --}}
                                        <i class="fa-solid fa-calendar-alt w-4 mr-2 text-gray-400"></i>Deadline:<strong> {{ $tugas->daftarNilai->tugas->deadline ? \Carbon\Carbon::parse($tugas->daftarNilai->tugas->deadline)->format('d M Y H:i') : 'N/A' }}</strong>
                                    </p>
                                </div>
                                <div class="border-t pt-4 flex items-center justify-between gap-4">
                                    <button onclick="window.location.href='{{ route('lihatSoal', $tugas->daftarNilai->tugas->nama_file ?? 0) }}'" class="w-1/2 bg-blue-100 text-blue-700 font-semibold py-2 px-4 rounded-lg hover:bg-blue-200 transition-all duration-300 flex items-center justify-center">
                                        <i class="fa-solid fa-file mr-2"></i> Lihat Soal
                                    </button>
                                    <button data-task-id="{{ $tugas->id_daftar_nilai_siswa }}" class="upload-button w-1/2 bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 flex items-center justify-center">
                                        <i class="fa-solid fa-upload mr-2"></i> Unggah Jawaban
                                    </button>
                                </div>
                            </div>
                        @elseif ($tugas->nilai == 0 && $tugas->nama_fileTugas != null)
                            <div class="bg-white rounded-xl shadow-md p-6 flex flex-col">
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-lg font-bold text-gray-800">{{ $tugas->daftarNilai->keterangan ?? 'Tugas Tanpa Judul' }}</h3>
                                        <span class="text-xs font-semibold bg-green-100 text-green-700 px-3 py-1 rounded-full flex-shrink-0">Selesai</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-4 flex items-center">
                                        <i class="fa-solid fa-calendar-alt w-4 mr-2 text-gray-400"></i>Dikerjakan: <strong>{{ \Carbon\Carbon::parse($tugas->daftarNilai->updated_at)->format('d M Y H:i') ?? 'N/A' }}</strong>
                                    </p>
                                </div>
                                <div class="border-t pt-4 flex items-center justify-between gap-4">
                                    <button onclick="window.location.href='{{ route('lihatJawaban',  $tugas->nama_fileTugas ?? 0) }}'" class="w-1/2 bg-gray-100 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-200 transition-all duration-300 flex items-center justify-center">
                                        <i class="fa-solid fa-eye mr-2"></i> Lihat Jawaban
                                    </button>
                                    <button data-task-id="{{ $tugas->id_daftar_nilai_siswa }}" class="upload-button w-1/2 bg-blue-100 text-blue-700 font-semibold py-2 px-4 rounded-lg hover:bg-blue-200 transition-all duration-300 flex items-center justify-center">
                                        <i class="fa-solid fa-pencil mr-2"></i> Edit Jawaban
                                    </button>
                                </div>
                            </div>
                        @elseif ($tugas->nilai != 0)
                            <div class="bg-white rounded-xl shadow-md p-6 flex flex-col">
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-lg font-bold text-gray-800">{{ $tugas->daftarNilai->keterangan ?? 'Tugas Tanpa Judul' }}</h3>
                                         <span class="text-xs font-semibold bg-purple-100 text-purple-700 px-3 py-1 rounded-full flex-shrink-0">Dinilai</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-4 flex items-center">
                                        <i class="fa-solid fa-award w-4 mr-2 text-gray-400"></i>Nilai: <strong>{{ $tugas->nilai }} / 100</strong>
                                    </p>
                                </div>
                                <div class="border-t pt-4 flex items-center justify-between gap-4">
                                    <button onclick="window.location.href='{{ route('lihatJawaban',  $tugas->nama_fileTugas ?? 0) }}'" class="w-full bg-gray-100 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-200 transition-all duration-300 flex items-center justify-center">
                                        <i class="fa-solid fa-eye mr-2"></i> Lihat Jawaban
                                    </button>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="col-span-full text-center py-10 bg-white rounded-xl shadow-md">
                            <i class="fa-solid fa-folder-open text-5xl text-gray-400 mb-4"></i>
                            <p class="text-gray-600 font-semibold text-lg">Belum ada tugas tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </main>
        </div>
    </div>
    
    <!-- Modal for file upload -->
    <div id="uploadModal" class="modal-bg fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center hidden p-4">
        <div class="modal-content bg-white rounded-xl shadow-2xl w-11/12 max-w-lg transform transition-all duration-300 ease-out scale-95 opacity-0" id="modalContent">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-2xl font-bold text-gray-800">Unggah Jawaban Tugas</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-800 focus:outline-none">
                    <i class="fa-solid fa-times text-2xl"></i>
                </button>
            </div>
            <form action="{{ route('unggahTugas') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_daftar_nilai_siswa" id="modal_task_id">
                <div class="p-6">
                    <div id="fileUploadArea" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-indigo-500 transition-colors">
                        <input type="file" id="fileInput" name="file" class="hidden" accept=".pdf">
                        <div id="fileUploadPlaceholder">
                            <i class="fa-solid fa-cloud-arrow-up text-4xl text-indigo-500 mb-4"></i>
                            <p class="font-semibold text-gray-700">Klik untuk memilih file</p>
                            <p class="text-sm text-gray-500 mt-1">atau seret dan lepas file di sini</p>
                            <p class="text-xs text-gray-400 mt-2">Hanya file PDF, maks. 10MB</p>
                        </div>
                        <div id="fileNameDisplay" class="hidden items-center justify-center">
                            <i class="fa-solid fa-file-pdf text-3xl text-red-500 mr-3"></i>
                            <span class="font-medium text-gray-800"></span>
                        </div>
                    </div>
                </div>

                <div class="mt-2 flex justify-end space-x-4 p-6 bg-gray-50 rounded-b-xl">
                    <button type="button" id="cancelButton" class="bg-gray-100 text-gray-700 font-semibold py-2 px-6 rounded-lg hover:bg-gray-200 transition-all duration-300">
                        Batal
                    </button>
                    <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition-all duration-300 flex items-center justify-center">
                        <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Jawaban
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const menuButton = document.getElementById('menu-button');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        const toggleSidebar = () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        };

        menuButton.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
        
        document.addEventListener('DOMContentLoaded', () => {
            const uploadModal = document.getElementById('uploadModal');
            const modalContent = document.getElementById('modalContent');
            const closeModalButton = document.getElementById('closeModal');
            const cancelButton = document.getElementById('cancelButton');
            const uploadButtons = document.querySelectorAll('.upload-button');

            const fileUploadArea = document.getElementById('fileUploadArea');
            const fileInput = document.getElementById('fileInput');
            const fileUploadPlaceholder = document.getElementById('fileUploadPlaceholder');
            const fileNameDisplay = document.getElementById('fileNameDisplay');
            const fileNameSpan = fileNameDisplay.querySelector('span');
            
            const modalTaskIdInput = document.getElementById('modal_task_id');

            const openModal = (taskId) => {
                modalTaskIdInput.value = taskId;
                uploadModal.classList.remove('hidden');
                setTimeout(() => {
                    uploadModal.classList.remove('opacity-0');
                    modalContent.classList.remove('scale-95', 'opacity-0');
                }, 10);
            };

            const closeModal = () => {
                modalContent.classList.add('scale-95', 'opacity-0');
                uploadModal.classList.add('opacity-0');
                setTimeout(() => {
                    uploadModal.classList.add('hidden');
                    fileInput.value = '';
                    fileNameDisplay.classList.add('hidden');
                    fileNameDisplay.classList.remove('flex');
                    fileUploadPlaceholder.classList.remove('hidden');
                }, 300);
            };

            uploadButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    const taskId = event.currentTarget.dataset.taskId;
                    openModal(taskId);
                });
            });

            closeModalButton.addEventListener('click', closeModal);
            cancelButton.addEventListener('click', closeModal);
            uploadModal.addEventListener('click', (event) => {
                if (event.target === uploadModal) {
                    closeModal();
                }
            });

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
                    fileUploadArea.classList.add('border-indigo-500', 'bg-indigo-50');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                fileUploadArea.addEventListener(eventName, () => {
                    fileUploadArea.classList.remove('border-indigo-500', 'bg-indigo-50');
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