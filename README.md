# Sistem Manajemen Kost Griya Asri

Aplikasi web modern untuk mengelola operasional kost (rumah kos), dibangun dengan Laravel 12 dan Tailwind CSS.

## Ringkasan Proyek

Griya Asri adalah sistem manajemen kost yang komprehensif, dirancang untuk pemilik dan pengelola rumah kos di Surabaya, Indonesia. Sistem ini menyediakan antarmuka yang intuitif untuk mengelola kamar, galeri, dan informasi tamu.

## Fitur

- **Halaman Landing**: Halaman utama modern dan responsif dengan slider galeri gambar
- **Manajemen Kamar**: Tambah, edit, dan kelola daftar kamar dengan informasi lengkap
- **Manajemen Galeri**: Unggah dan organisir gambar properti
- **Dashboard Admin**: Panel admin yang aman untuk manajemen konten
- **Dukungan Mode Gelap**: Mode gelap bawaan untuk pengalaman pengguna yang lebih baik
- **Desain Responsif**: Dioptimalkan untuk desktop, tablet, dan perangkat mobile

## Teknologi yang Digunakan

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: SQLite (dapat dikonfigurasi ke MySQL/PostgreSQL)
- **Build Tools**: Vite
- **Autentikasi**: Laravel Sanctum

## Instalasi

### Prasyarat

- PHP 8.2 atau lebih tinggi
- Composer
- Node.js dan NPM
- SQLite atau MySQL

### Langkah-langkah

1. Clone repository:
```bash
git clone https://github.com/abyanrfq/griya-asri.git
cd griya-asri/kosku
```

2. Install dependencies PHP:
```bash
composer install
```

3. Install dependencies JavaScript:
```bash
npm install
```

4. Buat file environment:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Jalankan migrasi database:
```bash
php artisan migrate
```

7. Seed database (opsional):
```bash
php artisan db:seed
```

8. Build asset frontend:
```bash
npm run build
```

9. Jalankan development server:
```bash
php artisan serve
```

Aplikasi akan tersedia di `http://localhost:8000`

## Struktur Proyek

```
kosku/
├── app/
│   ├── Http/Controllers/    # Controller aplikasi
│   ├── Models/              # Model Eloquent
│   └── Providers/           # Service providers
├── database/
│   ├── migrations/          # Migrasi database
│   └── seeders/            # Seeder database
├── public/                 # Asset publik
├── resources/
│   ├── css/               # Stylesheet
│   ├── js/                # File JavaScript
│   └── views/             # Template Blade
└── routes/                # Route aplikasi
```

## Konfigurasi

### Database

Edit file `.env` untuk mengkonfigurasi koneksi database:

```env
DB_CONNECTION=sqlite
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=kosku
# DB_USERNAME=root
# DB_PASSWORD=
```

### Pengaturan Aplikasi

```env
APP_NAME="Griya Asri"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
```

## Cara Penggunaan

### Akses Admin

1. Buka halaman `/login`
2. Gunakan kredensial yang dibuat saat seeding atau buat user admin baru
3. Akses dashboard admin untuk mengelola konten

### Mengelola Galeri

1. Login ke panel admin
2. Navigasi ke bagian Galeri
3. Unggah gambar dengan judul dan deskripsi
4. Gambar akan muncul di slider halaman landing

### Mengelola Kamar

1. Akses bagian Kamar di panel admin
2. Tambahkan detail kamar termasuk harga, fasilitas, dan gambar
3. Kamar akan ditampilkan di halaman daftar publik

## Development

### Menjalankan Mode Development

```bash
# Terminal 1: Jalankan Laravel development server
php artisan serve

# Terminal 2: Watch dan compile asset
npm run dev
```

### Build untuk Production

```bash
npm run build
php artisan optimize
```

## Lisensi

Proyek ini adalah perangkat lunak proprietary. Hak cipta dilindungi.

## Kontak

Untuk informasi tentang Kost Griya Asri:

- **Lokasi**: Jl. Rungkut Asri Timur XIII No.90, Rungkut Kidul, Surabaya
- **WhatsApp**: +62 821-4326-9626
- **Mamikos**: [Lihat Listing](https://mamikos.com/room/kost-surabaya-kost-putri-eksklusif-kost-griya-asri-rungkut-surabaya)

## Penghargaan

Dibangun dengan framework Laravel dan teknologi web modern untuk memberikan pengalaman manajemen kost yang mulus.
