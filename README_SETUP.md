# 🎓 Laravel Course Platform

Platform pembelajaran online berbasis Laravel, lengkap dengan:

- ✅ Manajemen course dan konten (artikel, video, PDF, audio)
- ✅ Sistem approval oleh admin
- ✅ Enroll & progress user
- ✅ Role-based access menggunakan Spatie
- ✅ TailwindCSS + Vite untuk UI modern

---

## 🚀 Langkah Instalasi di Server Baru

### 1. Clone Project dari GitHub

```bash
git clone https://github.com/username/nama-project.git
cd nama-project
```

### 2. Install Dependency Backend

```bash
composer install
```

### 3. Install Dependency Frontend

```bash
npm install
```

### 4. Salin File .env & Generate Key

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Konfigurasi Database di `.env`

Edit file `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password
```

---

### 6. Jalankan Migrasi & Seeder

```bash
php artisan migrate --seed
```

Seeder akan otomatis membuat:

- 📛 Role: `admin`, `user`
- 👤 Admin default:  
  Email: `admin@example.com`  
  Password: `password`

---

### 7. Jalankan Server Laravel & Vite

```bash
# Jalankan backend Laravel
php artisan serve

# Di terminal lain, jalankan frontend dev
npm run dev
```

Untuk **build production**:

```bash
npm run build
```

---

## 📂 Struktur Penting

| Lokasi | Deskripsi |
|--------|-----------|
| `app/Models/` | Model seperti `Course`, `User`, dll |
| `app/Http/Controllers/` | Semua controller logic |
| `resources/views/` | Blade template UI |
| `routes/web.php` | Routing web Laravel |
| `public/` | Aset publik |
| `database/seeders/` | Data awal: roles, admin, dll |

---

## 🛡️ Role & Permission (Spatie)

Menggunakan [spatie/laravel-permission](https://github.com/spatie/laravel-permission):

- Role: `admin`, `user`
- Middleware: `role:admin`, `permission:manage course`, dst
- Command bantu:
  ```bash
  php artisan permission:cache-reset
  ```

=============

## 🌐 Deployment ke Production

1. Jalankan ini di server production:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
npm run build
```

2. Pastikan direktori berikut bisa ditulis:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```
---

## 🧩 Stack Teknologi

- Laravel 10.x
- Vite
- Tailwind CSS
- Spatie Laravel-Permission
- Autentikasi via Laravel Breeze / Jetstream (opsional)
- Role-based middleware

---

## 🐛 Troubleshooting

| Masalah | Solusi |
|--------|--------|
| Gambar tidak muncul | Jalankan `php artisan storage:link` |
| Akses ditolak | Pastikan role & permission sudah benar |
| Error saat Vite | Jalankan ulang `npm run dev` atau `npm run build` |
| `npm` error | Coba hapus `node_modules` dan `package-lock.json`, lalu `npm install` |

---

## ✨ Kontribusi

Pull request terbuka untuk perbaikan, fitur baru, atau dokumentasi.

---

## 📜 Lisensi

MIT License – bebas digunakan dan dimodifikasi.
