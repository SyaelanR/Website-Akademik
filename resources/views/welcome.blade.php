<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen Sekolah</title>
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
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
            <!-- Header -->
            <div class="text-center mb-8">
                <a href="#" class="flex items-center justify-center space-x-3 mb-4">
                    <i class="fa-solid fa-school text-4xl text-indigo-600"></i>
                    <span class="text-3xl font-bold text-gray-800">EduSys</span>
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali</h1>
                <p class="text-gray-500 mt-1">Silakan masuk untuk melanjutkan</p>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- username Input -->
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fa-solid fa-user text-gray-400"></i>
                        </span>
                        <input 
                            type="username" 
                            id="username" 
                            name="username"
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200 @error('email') border-red-500 @enderror"
                            placeholder="Contoh: Budi"
                            required autofocus
                            value="{{ old('username') }}"
                        >
                    </div>
                    {{-- Menampilkan pesan error validasi untuk email --}}
                    @error('username')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fa-solid fa-lock text-gray-400"></i>
                        </span>
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200"
                            placeholder="Masukkan password Anda"
                            required
                        >
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">Ingat Saya</label>
                    </div>
                    <div class="text-sm">
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300"
                    >
                        Masuk
                    </button>
                </div>
            </form>

            <!-- Footer -->
            <p class="text-center text-sm text-gray-500 mt-8">
                Belum punya akun? <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Hubungi Administrator</a>
            </p>
        </div>
    </div>

</body>
</html>
