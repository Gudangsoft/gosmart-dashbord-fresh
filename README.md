# GoSmart - Platform E-Learning

GoSmart adalah platform pembelajaran online (LMS) berbasis web yang memungkinkan instruktur membuat dan menjual kursus, serta siswa mengikuti kursus secara online dengan sistem pembayaran terintegrasi.

## Fitur Utama

- **Manajemen Kursus** — Buat, kelola, dan publikasikan kursus online (gratis & berbayar)
- **Sistem Pembayaran** — Integrasi Midtrans (virtual account bank transfer)
- **Keranjang Belanja** — Tambah kursus ke cart, checkout, dan lacak status pembayaran
- **Sertifikat** — Generate sertifikat dengan QR Code otomatis setelah kursus selesai
- **Live Streaming** — Streaming materi pembelajaran via YouTube
- **Event** — Buat dan kelola acara/event edukatif
- **Panel Admin** — Kelola pengguna, kursus, penarikan dana instruktur, dan konten iklan
- **API** — REST API dengan autentikasi Laravel Sanctum

## Peran Pengguna

| Peran | Akses |
|-------|-------|
| **Admin** | Kelola seluruh sistem: pengguna, kursus, pembayaran, pengumuman |
| **Instruktur/Teacher** | Buat kursus, kelola materi, lihat penghasilan, ajukan penarikan dana |
| **Siswa/Member** | Daftar kursus, ikuti pembelajaran, dapatkan sertifikat |

## Teknologi

- **Backend:** Laravel 11, PHP
- **Frontend:** Bootstrap 5, Livewire, jQuery, Vite
- **Database:** MySQL
- **Pembayaran:** Midtrans
- **PDF & Sertifikat:** DomPDF, Simple QR Code
- **API Auth:** Laravel Sanctum

---

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js >= 18 & NPM
- MySQL 8.0+
- Git

---

## Instalasi

### 1. Clone Repositori

```bash
git clone https://github.com/Gudangsoft/gosmart-dashbord-fresh.git
cd gosmart-dashbord-fresh
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Install Dependensi JavaScript

```bash
npm install
```

### 4. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` sesuai konfigurasi lokal:

```env
APP_NAME=GoSmart
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gosmart_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Buat Database

Buat database MySQL dengan nama `gosmart_db` (atau sesuai yang dikonfigurasi di `.env`), lalu jalankan migrasi:

```bash
php artisan migrate --seed
```

### 6. Build Assets Frontend

```bash
npm run build
```

Untuk mode development dengan hot reload:

```bash
npm run dev
```

### 7. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

---

## Konfigurasi Midtrans (Pembayaran)

1. Daftar akun di [Midtrans](https://midtrans.com)
2. Dapatkan **Server Key** dan **Client Key** dari dashboard Midtrans
3. Tambahkan ke `.env`:

```env
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
```

---

## Cara Penggunaan

### Sebagai Admin

1. Login ke `/login` menggunakan akun admin
2. Akses dashboard admin di `/admin/dashboard`
3. **Kelola Pengguna** — `/admin/users` — lihat, setujui, ubah peran, atau hapus pengguna
4. **Kelola Kursus** — `/admin/class` — setujui atau tolak kursus yang diajukan instruktur
5. **Kelola Kategori** — `/admin/class-category` — tambah dan aktifkan kategori kursus
6. **Kelola Penarikan Dana** — `/admin/withdraw` — proses permintaan penarikan instruktur
7. **Pengumuman** — `/admin/pages` — buat halaman/pengumuman publik
8. **Live Streaming** — `/admin/livestream` — tambahkan sesi live dari YouTube

### Sebagai Instruktur/Teacher

1. Daftar akun dan minta peran instruktur kepada admin
2. Login dan akses dashboard instruktur
3. **Buat Kursus Baru:**
   - Masuk ke menu "Kelas Saya"
   - Klik "Tambah Kelas Baru"
   - Isi judul, deskripsi, harga, kategori, dan upload thumbnail
   - Tambahkan materi berupa video/link
   - Submit untuk ditinjau admin
4. **Kelola Pendapatan** — Lihat riwayat penjualan dan ajukan penarikan dana
5. **Kelola Event** — Buat acara dan pantau pendaftaran peserta

### Sebagai Siswa/Member

1. Daftar di `/register`, lalu verifikasi email
2. Login di `/login`
3. **Jelajahi Kursus** — Cari kursus gratis atau berbayar dari halaman utama
4. **Enroll Kursus Gratis** — Klik "Ikuti Kursus" langsung tanpa pembayaran
5. **Beli Kursus Berbayar:**
   - Tambahkan kursus ke keranjang
   - Masuk ke halaman checkout
   - Pilih metode pembayaran (virtual account)
   - Selesaikan pembayaran dalam 24 jam
6. **Ikuti Pembelajaran** — Akses materi video setelah pembayaran dikonfirmasi
7. **Dapatkan Sertifikat** — Sertifikat otomatis tersedia setelah kursus selesai, dapat diunduh sebagai PDF

---

## API Endpoints

### Publik (Tanpa Autentikasi)

| Method | Endpoint | Keterangan |
|--------|----------|------------|
| POST | `/api/v1/login` | Login, mendapatkan token Sanctum |
| GET | `/api/v1/public/certificate` | Daftar sertifikat |
| GET | `/api/v1/public/certificate/key/{code}` | Cek sertifikat berdasarkan kode |
| GET | `/api/v1/public/statistics` | Statistik platform |
| POST | `/api/v1/public/midtrans/va/create` | Buat virtual account pembayaran |

### Terautentikasi (Wajib Bearer Token)

| Method | Endpoint | Keterangan |
|--------|----------|------------|
| GET | `/api/v1/logout` | Logout |
| GET | `/api/v1/course/index` | Daftar kursus |
| POST | `/api/v1/course/store` | Buat kursus baru |
| POST | `/api/v1/course/{id}/update` | Update kursus |
| GET | `/api/v1/course/delete/{id}` | Hapus kursus |

**Contoh request login:**

```bash
curl -X POST http://localhost:8000/api/v1/login \
  -H "Content-Type: application/json" \
  -d '{"email": "user@example.com", "password": "password"}'
```

**Contoh request dengan token:**

```bash
curl http://localhost:8000/api/v1/course/index \
  -H "Authorization: Bearer {token}"
```

---

## Struktur Direktori Penting

```
app/
├── Http/Controllers/
│   ├── Auth/              # Login, Register, Reset Password
│   ├── Backend/           # Fitur instruktur (Event, Voucher, Kreasi)
│   ├── Api/               # REST API controllers
│   └── Admin*/            # Panel admin
├── Models/                # Eloquent models (User, ClassMenu, Order, dll.)
resources/views/           # Blade templates
routes/
├── web.php                # Route web utama
└── api.php                # Route REST API
database/migrations/       # Skema database
```

---

## Lisensi

Proyek ini dikembangkan oleh **Gudangsoft** dan dilisensikan di bawah [MIT License](LICENSE).
