# ⚡ Listriku - Aplikasi Pembayaran Listrik Pascabayar (PPOB)

![Laravel](https://img.shields.io/badge/Laravel-11%2F12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Chart.js](https://img.shields.io/badge/Chart.js-F5788D?style=for-the-badge&logo=chartdotjs&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

**Listriku** adalah aplikasi web manajemen tagihan dan pembayaran listrik pascabayar yang dirancang untuk efisiensi dan kemudahan penggunaan. Aplikasi ini memfasilitasi pencatatan meteran listrik, pengelolaan pelanggan, serta transaksi pembayaran dengan antarmuka yang modern dan responsif.

---

## 🌟 Fitur Utama

Aplikasi ini memiliki dua hak akses pengguna dengan fitur yang berbeda:

### 👮 Administrator (Petugas/Admin)
* **Dashboard Interaktif**: Statistik real-time pelanggan aktif, total pendapatan, dan status tagihan dengan visualisasi grafik (Chart.js).
* **Manajemen Data Master**: Pengelolaan data Tarif (Volt Ampere/Daya) dan Tarif per kWh.
* **Kelola Pelanggan**: Tambah, edit, dan hapus data pelanggan lengkap dengan akun login otomatis.
* **Pencatatan Meter**: Input meteran awal dan akhir untuk menghitung tagihan otomatis.
* **Transaksi Pembayaran**: Memproses pembayaran tagihan pelanggan secara manual.
* **Cetak Struk & Laporan**: Fitur cetak bukti pembayaran dan export laporan pendapatan bulanan ke PDF.
* **Manajemen Akun**: Update profil dan keamanan password admin.

### 👤 Pelanggan (User)
* **Info Tagihan Real-time**: Melihat status tagihan bulan berjalan langsung di dashboard.
* **Riwayat Transaksi**: Melihat history pembayaran bulan-bulan sebelumnya.
* **Simulasi Pembayaran**: Melakukan pembayaran mandiri (Mock Payment Gateway).
* **Cetak Struk**: Mengunduh bukti pembayaran resmi sendiri.

---

## 📸 Tampilan Aplikasi

| Dashboard Admin |
| :---: | :---: |
| <img width="1911" height="912" alt="Screenshot 2026-02-02 094627" src="https://github.com/user-attachments/assets/f926de3c-ef54-4581-a47d-5b95bfa78707" />
| Riwayat Tagihan | <img width="1919" height="911" alt="Screenshot 2026-02-02 094640" src="https://github.com/user-attachments/assets/131b7c29-c59c-48c3-9c14-8cbdbfa87dcd" /> |

---

## 🛠️ Instalasi & Penggunaan

Ikuti langkah berikut untuk menjalankan aplikasi di komputer lokal Anda:

### Prasyarat
* PHP >= 8.2
* Composer
* MySQL

### Langkah-langkah
1.  **Clone Repository**
    ```bash
    git clone [https://github.com/Fahvvi/tagihan-app.git](https://github.com/Fahvvi/tagihan-app.git)
    cd tagihan-app
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    ```

3.  **Konfigurasi Environment**
    Duplikasi file `.env.example` menjadi `.env`, lalu atur koneksi database Anda.
    ```bash
    cp .env.example .env
    ```
    Buka file `.env` dan sesuaikan:
    ```ini
    DB_DATABASE=listriku_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generate Key & Migrasi Database**
    ```bash
    php artisan key:generate
    php artisan migrate:fresh --seed
    ```
    *(Command `--seed` akan otomatis membuat Data Admin Default & Tarif Dasar)*

5.  **Jalankan Server**
    ```bash
    php artisan serve
    ```

6.  **Akses Aplikasi**
    Buka browser dan kunjungi `http://localhost:8000`

---

## 🔐 Akun Demo (Seeder)

Gunakan akun berikut untuk masuk ke dalam sistem:

| Role | Username | Password |
| :--- | :--- | :--- |
| **Admin** | `admin` | `password` |
| **Pelanggan** | *(Buat manual via Admin)* | `password` |

---

## 📄 Lisensi

Proyek ini dibuat untuk tujuan edukasi dan Uji Kompetensi Keahlian (UKK/Serkom). Silakan dikembangkan lebih lanjut.

---

<p align="center">
  Dibuat dengan ❤️ oleh <b>Fahvvi</b>
</p>
