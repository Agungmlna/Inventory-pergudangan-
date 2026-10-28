# Inventori (Laravel 11)

Aplikasi inventori sederhana: data barang, stok, batas stok minimum, dan pencatatan barang masuk/keluar dengan riwayat.

## Fitur
- CRUD barang (kode, nama, kategori, satuan, harga, stok, stok minimum)
- Pencarian barang
- Catat barang masuk dan keluar (stok dikunci saat transaksi agar aman)
- Peringatan stok rendah
- Riwayat transaksi per barang

## Cara menjalankan
1. Buat proyek Laravel baru, lalu salin file ini ke dalamnya:
   `composer create-project laravel/laravel inventori`
   Timpa `routes/web.php`, `composer.json` bila perlu, dan salin folder `app/`, `database/migrations/`, `resources/views/` dari proyek ini.
2. Buat database MySQL bernama `inventori`, lalu isi `.env` (lihat `.env.example`).
3. Jalankan:
   ```
   php artisan key:generate
   php artisan migrate
   php artisan serve
   ```
4. Buka http://localhost:8000

## Catatan
- Pastikan `StockMovementController` memakai `lockForUpdate()` (sudah ada), ini mencegah stok salah saat dua transaksi terjadi bersamaan.
- Untuk login, pasang Laravel Breeze: `composer require laravel/breeze --dev` lalu `php artisan breeze:install blade`.
