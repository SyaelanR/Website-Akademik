# Akademik

# 📚 Website Akademik

Website Akademik adalah sistem informasi berbasis web yang dirancang untuk membantu pengelolaan kegiatan akademik di sekolah secara terintegrasi. Sistem ini mendukung berbagai peran pengguna dan menyediakan fitur e-learning serta manajemen data akademik secara efisien.

---

## 🚀 Fitur Utama

### 👥 Multi-Level User

Sistem memiliki 4 level pengguna dengan hak akses berbeda:

* **Admin Developer** → Mengelola akun admin sekolah
* **Admin Sekolah** → Mengelola data akademik dan pengguna
* **Guru** → Mengelola pembelajaran dan penilaian
* **Siswa** → Mengakses materi dan hasil belajar

---

### 📱 Responsive Design

* Tampilan website sudah **responsive**
* Dapat diakses dengan baik melalui:

  * Desktop
  * Tablet
  * Smartphone

---

### 🎓 E-Learning (Pembelajaran Daring)

* Upload & akses materi pembelajaran
* Manajemen tugas & pengumpulan tugas
* Penilaian dan absensi siswa

---

### 🏫 Manajemen Akademik

Sistem mendukung pengelolaan akademik secara lengkap, meliputi:

* 📊 **Sistem Pelaporan Akademik (Rapor)**
* 👨‍🎓 **Pengelolaan Data Siswa**
* 👩‍🏫 **Pengelolaan Data Guru**
* 📚 **Manajemen Kurikulum**
* 🎓 **Pengelolaan Angkatan**

---

## 🛠️ Teknologi yang Digunakan

* **Framework**: Laravel 11
* **Database**: MySQL
* **Frontend**: Tailwind CSS

---

## ⚙️ Instalasi

1. Clone repository

```bash
git clone https://github.com/username/nama-project.git
```

2. Masuk ke folder project

```bash
cd nama-project
```

3. Install dependency

```bash
composer install
npm install && npm run build
```

4. Copy file environment

```bash
cp .env.example .env
```

5. Konfigurasi database di file `.env`

6. Generate key

```bash
php artisan key:generate
```

7. Migrasi database

```bash
php artisan migrate
```

8. Jalankan server

```bash
php artisan serve
```
```bash
npm run dev
```
---

## 🔐 Hak Akses Pengguna

| Role            | Akses Utama                  |
| --------------- | ---------------------------- |
| Admin Developer | Kelola akun admin sekolah    |
| Admin Sekolah   | Kelola data akademik         |
| Guru            | Kelola pembelajaran & nilai  |
| Siswa           | Akses materi & hasil belajar |

---

## 📌 Catatan

* Pastikan konfigurasi database sudah benar sebelum migrasi
* Gunakan PHP versi yang kompatibel dengan Laravel 11 (≥ PHP 8.2)
* Pastikan Node.js sudah terinstall untuk build frontend

---

## 📄 Lisensi

Project ini menggunakan lisensi **MIT**.

---

## ✨ Kontribusi

Kontribusi sangat terbuka! Silakan fork repository ini dan ajukan pull request.

---

## 📞 Kontak

Jika ada pertanyaan atau saran, silakan hubungi developer.

---
