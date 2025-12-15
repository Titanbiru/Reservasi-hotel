# 🏨 Hotel Management & Reservation System

![Laravel](https://img.shields.io/badge/Laravel-12.x-red)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue)
![Database](https://img.shields.io/badge/Database-MySQL-orange)
![License](https://img.shields.io/badge/License-MIT-green)
![Status](https://img.shields.io/badge/Status-Development-yellow)

Sistem Informasi Manajemen Hotel berbasis web yang dirancang untuk mengelola reservasi kamar, data tamu, fasilitas hotel, serta operasional resepsionis secara terstruktur dan efisien.

Project ini dibuat menggunakan **Laravel** dengan sistem autentikasi multi-role dan alur reservasi yang menyerupai proses nyata di hotel.

---

## 🚀 Fitur Utama

- **Autentikasi Multi-Role**
  - Admin
  - Resepsionis
  - Guest (Tamu)

- **Manajemen Kamar**
  - CRUD tipe kamar
  - Pengaturan harga per malam
  - Upload gambar kamar

- **Manajemen Fasilitas Hotel**
  - CRUD fasilitas
  - Upload gambar fasilitas
  - Dukungan lebih dari 10 fasilitas

- **Manajemen Banner**
  - Upload banner carousel oleh Admin
  - Aktif / nonaktif banner
  - Tanpa judul dan subjudul (opsional)
  - Penghapusan banner dari dashboard admin

- **Sistem Reservasi**
  - Pemesanan kamar oleh Guest
  - Generate kode reservasi otomatis
  - Perhitungan total harga otomatis

- **Status Reservasi Bertahap**
  - `pending`
  - `confirmed`
  - `checked_in`
  - `check_out`
  - `cancelled`

- **Konfirmasi Resepsionis**
  - Check-in dan check-out dilakukan melalui resepsionis
  - Menyerupai proses nyata di hotel

- **File Storage**
  - Upload gambar menggunakan Laravel Storage
  - Public storage dengan `storage:link`

- **Database Seeding**
  - Dummy data untuk user, kamar, fasilitas, dan reservasi

---


## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12.37.00
- **Bahasa**: PHP 8.2+
- **Database**: MySQL / MariaDB
- **Frontend**: Blade Template
- **Server Lingkungan Lokal (Opsional)**: Laragon / XAMPP / WAMP
- **Frontend Styling**: Bootstrap 5.3+ (melalui Vite)
- **Library Pendukung**:
  - Carbon (manajemen tanggal)
  - FakerPHP (dummy data)
  - Composer (manajemen dependensi php)

---

## 📋 Prasyarat Sistem

Pastikan environment Anda memenuhi syarat berikut:

- PHP >= 8.2
- Composer 2.8.10
- MySQL / MariaDB
- Apache / Nginx atau Laravel Artisan Serve

---

## ⚙️ Instalasi & Setup

### 1. Clone Repository
```bash
git clone https://github.com/username/hotel-reservation.git
cd hotel-reservation
```

### 2. Install Dependency
``` bash
composer install
```
### 3. Konfigurasi Environment
``` bash
cp .env.example .env
php artisan key:generate
```
Atur konfigurasi database di file .env.

### 4. Migrasi & Seeder Database
``` bash
php artisan migrate:fresh --seed
```

### 5. Storage Link
``` bash
php artisan storage:link
```

### 6. Jalankan Aplikasi
``` bash
php artisan serve
```
Akses aplikasi melalui:
``` bash
http://127.0.0.1:8000
```

---

## 🔐 Akun Default
| Role        | Email | Password |
|------------|------------|------------|
| Admin       | admin@hotel.com |12345678|
| Resepsionis | resepsionis@hotel.com |12345678|

---

## 📂 Struktur Role

| Role        | Akses Utama |
|------------|------------|
| Admin       | Manajemen kamar, Manajemen fasilitas, Manajemen banner, Manajemen user |
| Resepsionis | Konfirmasi reservasi, Proses check-in & check-out |
| Guest       | Reservasi, Melihat history reservasi, Melihat kamar |

## 📄 License

Project ini menggunakan lisensi MIT.

## ℹ️ Tentang Laravel

Laravel adalah framework PHP dengan sintaks elegan dan fitur lengkap untuk membangun aplikasi web modern.
Dokumentasi resmi: https://laravel.com/docs