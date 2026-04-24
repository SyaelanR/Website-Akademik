<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas - Sistem Manajemen Sekolah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
        .modal { transition: opacity 0.3s ease-in-out; }
        .modal-content { transition: transform 0.3s ease-in-out; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">
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
            <a href="{{ route('manajTugas') }}" class="flex items-center px-6 py-3 bg-indigo-50 text-indigo-600 font-semibold rounded-r-lg border-l-4 border-indigo-600 transition duration-200">
                <i class="fa-solid fa-file-pen w-6 mr-3"></i>
                <span>Input Tugas</span>
            </a>
            <a href="{{ route('manajemenNilai') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 transition duration-200">
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

<div id="overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden lg:hidden"></div>

<div class="flex-1 flex flex-col overflow-y-auto">
    <header class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-30">
        <button id="menu-button" class="lg:hidden text-gray-600 focus:outline-none">
            <i class="fa-solid fa-bars text-2xl"></i>
        </button>
        <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Daftar Tugas</h1>
        <div class="flex items-center space-x-4">
            
        </div>
    </header>

    <main class="p-6 md:p-8 flex-1">
        <!-- Session Messages Handling -->
        @if(session('success'))
            <div id="session-success" data-message="{{ session('success') }}" class="hidden"></div>
        @endif
        @if ($errors->any())
            <div id="validation-errors" data-errors='@json($errors->all())' class="hidden"></div>
        @endif

        <header class="mb-8 bg-indigo-600 p-6 rounded-2xl shadow-lg flex flex-wrap justify-between items-center text-white gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold">Daftar Tugas: {{$infoJKA->kelas->nama_kelas ?? 'N/A'}} - {{$infoJKA->mapel->nama_mapel ?? 'N/A'}}</h1>
                <p class="text-indigo-200 mt-2">Kelola semua tugas yang telah diberikan kepada siswa.</p>
            </div>
            <a href="{{ url()->previous() }}" class="flex-shrink-0 inline-flex items-center bg-white text-indigo-600 hover:bg-gray-100 transition duration-300 px-4 py-2 rounded-lg shadow-md font-semibold">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                <span>Kembali</span>
            </a>
        </header>
        
        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Semua Tugas</h2>
                <button id="add-task-btn" class="bg-indigo-600 text-white font-semibold py-2 px-5 rounded-lg shadow-md hover:bg-indigo-700 transition duration-300 flex items-center">
                    <i class="fa-solid fa-plus mr-2"></i> Tambah Tugas
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px] text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Keterangan</th>
                            <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Tanggal</th>
                            <th class="p-3 font-semibold text-gray-600 uppercase text-sm">Deadline</th>
                            <th class="p-3 font-semibold text-gray-600 uppercase text-sm text-center">File</th>
                            <th class="p-3 font-semibold text-gray-600 uppercase text-sm text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                    @forelse (($daftarTugas ?? []) as $tugas)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 font-medium text-gray-800">{{$tugas->keterangan}}</td>
                            <td class="p-3 text-gray-600">{{ \Carbon\Carbon::parse($tugas->created_at)->format('d M Y') }}</td>
                            <td class="p-3 text-gray-600">{{ \Carbon\Carbon::parse($tugas->deadline)->format('d M Y H:i') }}</td>
                            <td class="p-3 text-center">
                                <a href="{{ route('lihatSoalSiswa', [$tugas->nama_file])}}" class="text-indigo-600 hover:underline">Lihat File</a>
                            </td>
                            <td class="p-3 text-center">
                                <div class="flex items-center justify-center space-x-4">
                                    <a href="javascript:void(0)" class="edit-task-btn text-blue-500 hover:text-blue-700" title="Edit"
                                        data-id="{{ $tugas->id_daftar_tugas }}"
                                        data-keterangan="{{ $tugas->keterangan }}"
                                        data-deadline="{{ \Carbon\Carbon::parse($tugas->deadline)->format('Y-m-d\TH:i') }}"
                                        data-file="{{ $tugas->nama_file }}"
                                        data-url="{{ route('updateTugas', $tugas->id_daftar_tugas) }}">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>                                    <form action="{{ route('destroyTugas', $tugas->id_daftar_tugas) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                            <i class="fa-solid fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-3 text-center text-gray-500">
                                <div class="text-center py-12">
                                    <i class="fa-solid fa-folder-open text-5xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-600 font-semibold text-lg">Belum ada daftar tugas.</p>
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

<div id="task-modal" class="modal fixed inset-0 z-[100] hidden flex items-center justify-center bg-gray-900 bg-opacity-50 opacity-0 p-4">
    <div class="modal-content bg-white rounded-xl shadow-lg w-full max-w-lg transform transition-all duration-300 ease-in-out scale-95">
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-bold text-gray-800">Tambah Tugas Baru</h2>
            <button id="close-task-modal-btn" class="text-gray-400 hover:text-gray-600 transition duration-300">
                <i class="fa-solid fa-times text-2xl"></i>
            </button>
        </div>
        <form id="task-form" action="{{route('storeTugas',[$infoJKA->kelas->id_kelas ?? 0, $infoJKA->mapel->id_mapel ?? 0])}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label for="task-name" class="block text-gray-700 font-semibold mb-2">Keterangan Tugas</label>
                    <input type="text" id="task-name" name="keterangan_tugas" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan Keterangan Tugas" required>
                </div>
                <div>
                    <label for="task-file" class="block text-gray-700 font-semibold mb-2">File (PDF)</label>
                    <input type="file" id="task-file" name="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="application/pdf">
                </div>
                <div>
                    <label for="task-due-date" class="block text-gray-700 font-semibold mb-2">Deadline</label>
                    <input type="datetime-local" id="task-due-date" name="deadline" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
            </div>
            <div class="flex justify-end p-6 bg-gray-50 rounded-b-xl">
                 <button type="button" id="cancel-btn" class="bg-gray-200 text-gray-800 font-semibold py-2 px-6 rounded-lg hover:bg-gray-300 transition duration-300">Batal</button>
                <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition duration-300 ml-4">Simpan Tugas</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Tugas -->
<div id="edit-task-modal" class="modal fixed inset-0 z-[100] hidden flex items-center justify-center bg-gray-900 bg-opacity-50 opacity-0 p-4">
    <div class="modal-content bg-white rounded-xl shadow-lg w-full max-w-lg transform transition-all duration-300 ease-in-out scale-95">
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-bold text-gray-800">Edit Tugas</h2>
            <button id="close-edit-modal-btn" class="text-gray-400 hover:text-gray-600 transition duration-300">
                <i class="fa-solid fa-times text-2xl"></i>
            </button>
        </div>
        {{-- Catatan: Pastikan Anda sudah membuat route dengan nama 'updateTugas' --}}
        <form id="edit-task-form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label for="edit-keterangan" class="block text-gray-700 font-semibold mb-2">Keterangan Tugas</label>
                    <input type="text" id="edit-keterangan" name="keterangan_tugas" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div>
                    <label for="edit-deadline" class="block text-gray-700 font-semibold mb-2">Deadline</label>
                    <input type="datetime-local" id="edit-deadline" name="deadline" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div>
                    <label for="edit-file" class="block text-gray-700 font-semibold mb-2">Upload File Baru (Opsional)</label>
                    <p id="current-file" class="text-sm text-gray-500 mb-2">File saat ini: <span class="font-medium text-indigo-600"></span></p>
                    <input type="file" id="edit-file" name="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="application/pdf">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah file.</p>
                </div>
            </div>
            <div class="flex justify-end p-6 bg-gray-50 rounded-b-xl space-x-4">
                <button type="button" id="cancel-edit-btn" class="bg-gray-200 text-gray-800 font-semibold py-2 px-6 rounded-lg hover:bg-gray-300 transition duration-300">Batal</button>
                <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition duration-300">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    // Sidebar
    const menuButton = document.getElementById('menu-button');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const toggleSidebar = () => { sidebar.classList.toggle('-translate-x-full'); overlay.classList.toggle('hidden'); };
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

    const validationErrors = document.getElementById('validation-errors');
    if (validationErrors) {
        const errors = JSON.parse(validationErrors.dataset.errors);
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
    }

    // Modal Tambah
    const addTaskBtn = document.getElementById('add-task-btn');
    const taskModal = document.getElementById('task-modal');
    if (taskModal) {
        const modalContent = taskModal.querySelector('.modal-content');
        const closeTaskModalBtn = document.getElementById('close-task-modal-btn');
        const cancelBtn = document.getElementById('cancel-btn');

        const openAddModal = () => {
            taskModal.classList.remove('hidden');
            setTimeout(() => {
                taskModal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
            }, 10);
        };

        const closeAddModal = () => {
            modalContent.classList.add('scale-95');
            taskModal.classList.add('opacity-0');
            setTimeout(() => taskModal.classList.add('hidden'), 300);
        };

        addTaskBtn.addEventListener('click', openAddModal);
        closeTaskModalBtn.addEventListener('click', closeAddModal);
        cancelBtn.addEventListener('click', closeAddModal);
        taskModal.addEventListener('click', (e) => {
            if (e.target === taskModal) closeAddModal();
        });
    }

    // Modal Edit
    const editTaskModal = document.getElementById('edit-task-modal');
    if (editTaskModal) {
        const editModalContent = editTaskModal.querySelector('.modal-content');
        const closeEditModalBtn = document.getElementById('close-edit-modal-btn');
        const cancelEditBtn = document.getElementById('cancel-edit-btn');
        const editTaskBtns = document.querySelectorAll('.edit-task-btn');
        const editForm = document.getElementById('edit-task-form');

        const openEditModal = (keterangan, deadline, file, url) => {
            editForm.action = url;
            editForm.querySelector('#edit-keterangan').value = keterangan;
            editForm.querySelector('#edit-deadline').value = deadline;
            editForm.querySelector('#current-file span').textContent = file;

            editTaskModal.classList.remove('hidden');
            setTimeout(() => {
                editTaskModal.classList.remove('opacity-0');
                editModalContent.classList.remove('scale-95');
            }, 10);
        };

        const closeEditModal = () => {
            editModalContent.classList.add('scale-95');
            editTaskModal.classList.add('opacity-0');
            setTimeout(() => editTaskModal.classList.add('hidden'), 300);
        };

        editTaskBtns.forEach(btn => btn.addEventListener('click', () => openEditModal(btn.dataset.keterangan, btn.dataset.deadline, btn.dataset.file, btn.dataset.url)));
        closeEditModalBtn.addEventListener('click', closeEditModal);
        cancelEditBtn.addEventListener('click', closeEditModal);
        editTaskModal.addEventListener('click', (e) => {
            if (e.target === editTaskModal) closeEditModal();
        });
    }

    // --- Delete Confirmation ---
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda yakin ingin menghapus tugas ini?",
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
