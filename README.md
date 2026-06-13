# 📋 Taskly — Aplikasi Manajemen Tugas

> Aplikasi web manajemen tugas berbasis Laravel yang menerapkan prinsip Secure Coding dan OWASP Top 10 Awareness.

---

## 📖 Deskripsi Project

**Taskly** adalah aplikasi manajemen tugas berbasis web yang dibangun menggunakan framework Laravel. Aplikasi ini memungkinkan pengguna untuk mengelola proyek dan tugas secara terorganisir dengan memperhatikan aspek keamanan sejak tahap perancangan hingga implementasi.

Aplikasi ini dikembangkan sebagai Mini Project Ujian Akhir Semester dengan menerapkan konsep keamanan aplikasi web sesuai standar industri.

---

## 🛠️ Tech Stack

- **Framework**: Laravel 11
- **Database**: MySQL
- **Template Engine**: Blade
- **CSS Framework**: Tailwind CSS
- **Auth Scaffolding**: Laravel Breeze
- **Server Lokal**: Laragon
- **PHP**: >= 8.2

---

## ✅ Fitur Aplikasi

### Autentikasi
- Register akun baru
- Login dengan email & password
- Logout
- Reset Password (via email)

### Manajemen Data (CRUD)
- **Projects** — Mengelola proyek sebagai tempat untuk menyimpan tugas
- **Tasks** — Buat, lihat, edit, dan hapus tugas dengan status & prioritas 
- **Categories** — Buat label/kategori untuk mengelompokkan tugas

### Role & Hak Akses
- **Administrator** — Akses penuh ke seluruh data dan pengaturan aplikasi
- **User** — Akses terbatas hanya pada data milik sendiri

---

## ⚙️ Cara Instalasi

### Prasyarat
Pastikan sudah terinstall:
- [Laragon](https://laragon.org/) (PHP 8.2+, MySQL, Composer)
- Node.js & NPM

### Langkah Instalasi

**1. Clone repository**
```bash
git clone https://github.com/esianarahma/Taskly-PKWeb-Laravel.git
cd Taskly-PKWeb-Laravel
```

**2. Install dependency PHP**
```bash
composer install
```

**3. Install dependency JavaScript**
```bash
npm install
```

**4. Salin file environment**
```bash
cp .env.example .env
```

**5. Generate application key**
```bash
php artisan key:generate
```

**6. Konfigurasi database di file `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=taskly
DB_USERNAME=root
DB_PASSWORD=
```

**7. Buat database MySQL, lalu jalankan migration**
```bash
CREATE DATABASE taskly;
php artisan migrate
```

**8. Build assets frontend**
```bash
npm run dev
```

**9. Jalankan server**
```bash
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

---