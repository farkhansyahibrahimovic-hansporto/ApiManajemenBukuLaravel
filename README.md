# Laravel Book Management API with JWT Authentication

RESTful API untuk manajemen data buku yang dibangun menggunakan Laravel. Sistem ini tidak hanya menyediakan operasi CRUD, tetapi juga menerapkan autentikasi berbasis JSON Web Token (JWT) untuk mengamankan akses ke setiap endpoint.

---

## Deskripsi

Aplikasi ini dirancang sebagai backend service yang memungkinkan pengguna untuk melakukan registrasi, login, dan mengelola data buku. Setiap permintaan ke endpoint tertentu dilindungi oleh token autentikasi sehingga hanya pengguna terdaftar yang dapat mengaksesnya.

---

## Fitur

* Autentikasi pengguna menggunakan JWT
* Registrasi dan login pengguna
* Manajemen data buku (create, read, update, delete)
* Proteksi endpoint menggunakan middleware
* Struktur API berbasis REST

---

## Teknologi

* PHP dengan Laravel Framework
* Database MySQL atau PostgreSQL
* JWT menggunakan package tymon/jwt-auth
* Composer sebagai dependency manager

---

## Instalasi

1. Clone repository

```bash
git clone https://github.com/username/laravel-book-api.git
cd laravel-book-api
```

2. Install dependency

```bash
composer install
```

3. Salin file environment

```bash
cp .env.example .env
```

4. Konfigurasi database pada file `.env`

5. Generate application key

```bash
php artisan key:generate
```

6. Generate JWT secret

```bash
php artisan jwt:secret
```

7. Jalankan migrasi database

```bash
php artisan migrate
```

8. Jalankan server

```bash
php artisan serve
```

---

## Autentikasi

### Register

```
POST /api/register
```

### Login

```
POST /api/login
```

Contoh response:

```json
{
  "access_token": "your_token_here",
  "token_type": "bearer"
}
```

---

## Endpoint Buku

| Method | Endpoint        | Keterangan                |
| ------ | --------------- | ------------------------- |
| GET    | /api/books      | Mengambil semua data buku |
| POST   | /api/books      | Menambahkan data buku     |
| GET    | /api/books/{id} | Detail buku               |
| PUT    | /api/books/{id} | Memperbarui data buku     |
| DELETE | /api/books/{id} | Menghapus data buku       |

Seluruh endpoint di atas memerlukan token autentikasi.

---

## Penggunaan Token

Setiap request ke endpoint yang dilindungi harus menyertakan header berikut:

```
Authorization: Bearer your_token_here
```

---

## Struktur Direktori

```
app/
 ├── Http/
 │    ├── Controllers/
 │    └── Middleware/
 ├── Models/
routes/
 └── api.php
```

---

## Catatan

* File `.env` tidak disertakan dalam repository
* Gunakan `.env.example` sebagai referensi konfigurasi
* Disarankan menggunakan data dummy untuk pengujian

---

## Penulis

Farkhansyah Ibrahimovic
Email: [farkhansyahibrahimovic@gmail.com](mailto:farkhansyahibrahimovic@gmail.com)

---

## Penutup

Proyek ini dikembangkan sebagai bagian dari pembelajaran backend development, dengan fokus pada pembuatan API yang terstruktur dan aman menggunakan Laravel serta JWT.
