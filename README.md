# MokerJobs

Aplikasi web lowongan kerja berbasis **Laravel** dan **Tailwind CSS**.

---

## 🚀 Instalasi

### 1. Clone repository ini

```bash
git clone https://github.com/alfanulum/project_web_mokerjobs.git
cd project_web_mokerjobs
```

### 2. Install PHP & JS dependencies

```bash
composer install
npm install
```

### 3. Copy file .env dan sesuaikan konfigurasi

```bash
cp .env.example .env
```

### 4. Generate app key

```bash
php artisan key:generate
```

### 5. Siapkan database

- Buat database di MySQL
- Jalankan migrasi

```bash
php artisan migrate
```

### 6. Buat symbolic link untuk mengakses file upload secara publik

```bash
php artisan storage:link
```

Perintah ini membuat shortcut dari `storage/app/public` ke `public/storage` agar file yang diupload bisa diakses melalui URL, misalnya:

```
http://localhost:8000/storage/company_logos/namafile.jpg
```

### 7. Jalankan server lokal

```bash
php artisan serve
npm run dev
```

---

## ⚙️ Tools yang Digunakan

- Laravel 10+
- Tailwind CSS
- Vite
- Livewire *(opsional jika digunakan)*

---

## 📁 Contoh `.env`

```env
APP_NAME=MokerJobs
APP_ENV=local
APP_KEY=base64:GENERATE_DULU_PAKAI_KEY:GENERATE
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mokerjobs
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

VITE_APP_NAME="MokerJobs"
```

---

## 👥 Kontributor

- @namamu  
- @temanmu

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **MIT License**.

---

## 🔐 Tips: Backup dan Restore `.env` Sebelum Git Pull

### ✅ Backup `.env`

```bash
cp .env .env.backup
```

### 🔄 Lakukan Git Pull

```bash
git pull origin main
```

### ♻️ Restore `.env` (jika terhapus atau terubah)

```bash
mv .env.backup .env
```

> **Catatan:** File `.env` tidak ikut diupload ke GitHub, pastikan kamu backup agar konfigurasi lokal (database, key, dll.) tetap aman.

---

Happy coding! 🚀
