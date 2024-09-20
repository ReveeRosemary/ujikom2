# Dokumentasi Proyek IceSicle

## Tentang
IceSicle adalah website Toko Ice Cream Online dengan tampilan sederhana.

## Fitur

### Auth
- Login
- Register

### Halaman Awal
- Best Seller Products
- New Arrival Products

### Multi User
#### Admin
- Mengelola Users
- Mengelola Toko
- Mengelola Produk
- Mengelola Roles
- Mengelola Pesanan

#### Seller
- Mengelola Produk
- Mengelola Pesanan
- Register sebagai Seller

#### Buyer
- Membeli Produk
- Membuat Pesanan
- Register sebagai Buyer

### All
- Login
- Logout

## Akun Default
- **Admin**: 
  - Email: `admin@gmail.com`
  - Password: `password`
- **Buyer**: 
  - Email: `buyer@gmail.com`
  - Password: `password`

### ERD
![ERD](erd.png)

### UML
![UML]((https://raw.githubusercontent.com/ReveeRosemary/ujikom2/refs/heads/main/UML.png)


## Teknologi yang Digunakan
- Laravel 10
- Filament 3.2
- CDN Tailwind

## Persyaratan untuk Instalasi
- PHP 8.1.1
- Web Server
- Database (PostgreSQL)
- Web Browser

## Cara Instalasi IceSicle

### 1. Persyaratan
Sebelum memulai, pastikan Anda memenuhi persyaratan berikut:
- PHP versi 8.1.1
- Web Server (Apache)
- Database (PostgreSQL)
- Web Browser

### 2. Clone Repository
Pertama, clone repository dari GitHub dengan perintah berikut:
```bash
git clone https://github.com/ReveeRosemary/ujikom2.git

### 3. Masuk ke Direktori Proyek
Setelah clone selesai, masuk ke direktori proyek:
```bash
cd ujikom2

### 4. Instalasi Dependensi
Instal dependensi menggunakan Composer:
```bash
composer install

### 5. Salin File .env
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env

### 6. Atur Kunci Aplikasi
Generate kunci aplikasi menggunakan Artisan:

```bash
php artisan key:generate

### 7. Konfigurasi Database
Edit file `.env` dan atur konfigurasi database:
```plaintext
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database

### 8. Jalankan Migrations
Jalankan perintah berikut untuk membuat tabel di database:
```bash
php artisan migrate


### 9. Jalankan Server
Jalankan server lokal dengan perintah berikut:
```bash
php artisan serve

