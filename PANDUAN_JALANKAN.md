# 🚀 Panduan Menjalankan Dashboard Admin E&DGarage

## 📋 Prerequisites (Yang Harus Ada)

1. **XAMPP** sudah terinstall dan berjalan (Apache & MySQL)
2. **PHP 8.2+** (biasanya sudah include di XAMPP)
3. **Composer** sudah terinstall
4. **Node.js & NPM** (untuk build assets)

---

## 📝 Langkah-langkah Setup

### 1. ✅ Setup Database

Pastikan MySQL di XAMPP sudah berjalan, lalu buat database:

```sql
CREATE DATABASE website_ukk_penjualan;
```

Atau bisa melalui phpMyAdmin di: `http://localhost/phpmyadmin`

### 2. ⚙️ Konfigurasi Environment

Buka file `.env` di root project dan pastikan konfigurasi database sudah benar:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=website_ukk_penjualan
DB_USERNAME=root
DB_PASSWORD=
```

### 3. 📦 Install Dependencies

Jalankan di terminal/PowerShell:

```bash
# Install PHP dependencies
composer install

# Install NPM dependencies
npm install
```

### 4. 🔑 Generate Application Key

```bash
php artisan key:generate
```

### 5. 🗄️ Run Migrations

Jalankan migration untuk membuat tabel-tabel di database:

```bash
php artisan migrate
```

Ini akan membuat tabel:
- `users` (sudah ada dari Laravel)
- `products` (motor bekas)
- `transactions` (transaksi penjualan)
- `cache`, `jobs` (untuk Laravel)

### 6. 👤 Setup Authentication (Jika Belum Ada)

Jika belum ada sistem login, install Laravel Breeze:

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run build
```

Atau jika ingin manual, pastikan ada route login di `routes/web.php`.

### 7. 🎨 Build Assets (CSS & JS)

```bash
npm run build
```

Atau untuk development dengan auto-reload:

```bash
npm run dev
```

### 8. 🚀 Jalankan Server

```bash
php artisan serve
```

Server akan berjalan di: `http://localhost:8000`

---

## 🔐 Cara Mengakses Dashboard

### Opsi 1: Jika Sudah Ada Login

1. Buka browser: `http://localhost:8000`
2. Login sebagai admin
3. Akses: `http://localhost:8000/admin/dashboard`

### Opsi 2: Buat User Admin (Jika Belum Ada)

Jalankan di terminal:

```bash
php artisan tinker
```

Lalu ketik:

```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@edgarage.com';
$user->password = bcrypt('password123');
$user->save();
exit
```

Atau buat seeder:

```bash
php artisan make:seeder AdminSeeder
```

---

## 📊 Menambahkan Data Dummy (Opsional)

Untuk melihat dashboard dengan data, buat seeder:

```bash
php artisan make:seeder ProductSeeder
php artisan make:seeder TransactionSeeder
```

---

## 🎯 URL yang Tersedia

- **Dashboard Admin**: `http://localhost:8000/admin/dashboard`
- **Home**: `http://localhost:8000`
- **Login**: `http://localhost:8000/login` (jika menggunakan Breeze)

---

## 🐛 Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "Table doesn't exist"
```bash
php artisan migrate:fresh
```

### Error: "Vite manifest not found"
```bash
npm run build
```

### Error: "Route not found"
Pastikan route sudah ditambahkan di `routes/web.php` dan jalankan:
```bash
php artisan route:clear
php artisan route:cache
```

### Error: "Permission denied"
Pastikan folder `storage` dan `bootstrap/cache` memiliki permission write.

---

## 📱 Fitur Dashboard

Setelah berhasil login dan mengakses dashboard, Anda akan melihat:

1. **3 Card Statistik**:
   - Total Produk
   - Total Pengguna  
   - Total Transaksi

2. **Tabel Transaksi Terbaru**:
   - ID Transaksi
   - Nama Pembeli
   - Produk
   - Tanggal
   - Status

3. **Sidebar Navigation**:
   - Dashboard (aktif)
   - Produk
   - Pengguna
   - Transaksi
   - Profil Admin
   - Logout

---

## ✅ Checklist Setup

- [ ] Database dibuat
- [ ] File `.env` dikonfigurasi
- [ ] `composer install` dijalankan
- [ ] `npm install` dijalankan
- [ ] `php artisan key:generate` dijalankan
- [ ] `php artisan migrate` dijalankan
- [ ] Authentication sudah setup
- [ ] `npm run build` dijalankan
- [ ] `php artisan serve` dijalankan
- [ ] Bisa login dan akses dashboard

---

## 🎉 Selamat!

Jika semua langkah sudah selesai, dashboard admin E&DGarage siap digunakan! 🚗✨

---

**Catatan**: Pastikan Apache dan MySQL di XAMPP sudah berjalan sebelum menjalankan aplikasi.

