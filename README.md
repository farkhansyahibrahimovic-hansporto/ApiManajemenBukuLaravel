# Laravel Book Management API with JWT Authentication

Proyek ini merupakan aplikasi backend berbasis RESTful API yang dibangun menggunakan Laravel. Sistem ini digunakan untuk mengelola data buku dengan pendekatan yang terstruktur, sekaligus menerapkan autentikasi berbasis JSON Web Token (JWT) sebagai mekanisme keamanan utama.

Penggunaan JWT memungkinkan setiap pengguna yang terdaftar untuk melakukan autentikasi dan mendapatkan token sebagai identitas akses. Token tersebut kemudian digunakan untuk mengamankan setiap permintaan yang dilakukan ke sistem, sehingga hanya pengguna yang terverifikasi yang dapat mengakses data.

Pengembangan proyek ini berfokus pada pemahaman dasar dalam membangun API yang rapi, efisien, dan aman, khususnya dalam pengelolaan data serta implementasi autentikasi berbasis token.

## Instalasi Singkat

```bash
git clone https://github.com/username/laravel-book-api.git
cd laravel-book-api
composer install
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan serve
```

## Catatan

Konfigurasi database perlu disesuaikan pada file `.env` sebelum menjalankan aplikasi. File `.env` tidak disertakan dalam repository untuk menjaga keamanan data konfigurasi.

## Penulis

Farkhansyah Ibrahimovic
Email: [farkhansyahibrahimovic@gmail.com](mailto:farkhansyahibrahimovic@gmail.com)

## Penutup

Proyek ini dikembangkan sebagai bagian dari proses pembelajaran dalam bidang backend development, dengan tujuan memahami implementasi API serta penerapan sistem autentikasi yang aman.
