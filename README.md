```markdown
# Sistem Gudang

Sistem Gudang adalah aplikasi web yang dibangun dengan Laravel Lumens 10 untuk mengelola data pengguna, barang, dan mutasi dalam sebuah sistem gudang.

## Prasyarat

Sebelum memulai, pastikan Anda telah menginstal:

- [Git](https://git-scm.com/)
- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/) - Versi 8.0 atau lebih baru
- [Docker](https://www.docker.com/get-started) (opsional, jika Anda ingin menggunakan Docker)

## Instalasi

Ikuti langkah-langkah berikut untuk mengatur proyek ini di lingkungan pengembangan lokal Anda:

1. **Clone repositori ini:**

   ```bash
   git clone https://github.com/tesarp1812/Sistem-Gudang.git
   ```

2. **Masuk ke direktori proyek:**

   ```bash
   cd <NAMA_PROYEK>
   ```

   Gantilah `<NAMA_PROYEK>` dengan nama direktori proyek setelah di-clone.

3. **Instal dependensi dengan Composer:**

   ```bash
   composer install
   ```

   Perintah ini akan menginstal semua dependensi yang diperlukan berdasarkan file `composer.json`.

4. **Salin file konfigurasi lingkungan:**

   ```bash
   cp .env.example .env
   ```

   Ini akan membuat salinan file `.env` dari template yang ada. sesuaikan konfigurasi lingkungan seperti database dan variabel lainnya.

5. **Generate kunci aplikasi Laravel:**

   ```bash
   php artisan key:generate
   ```

   Perintah ini akan menghasilkan dan mengatur kunci aplikasi yang diperlukan untuk enkripsi.

6. **Jalankan migrasi dan seed database:**

   ```bash
   php artisan migrate --seed
   ```

   Perintah ini akan menjalankan migrasi database dan mengisi database dengan data awal (seed).

7. **Jalankan server pengembangan PHP:**

   ```bash
   php -S localhost:8000 -t public
   ```

   Akses aplikasi Anda melalui browser di [http://localhost:8000](http://localhost:8000).
   
9. **Jalankan Login**

    Email
    ```bash
   test@test.com
   ```
    Password
    ```bash
   test123
   ```
   semua akun di database default password adalah test123 setelah di migrate --seed

## Penggunaan

Setelah server berjalan, Anda dapat mulai menggunakan aplikasi dengan membuka [http://localhost:8000](http://localhost:8000) di browser Anda. untuk akses fitur silahkan lihat di dokumentasi Postman, gunakan token untuk setiap akses endpoint yang didapat dari login.

## Postman
Dokumentasi Postman bisa di lihat di link https://documenter.getpostman.com/view/20469680/2sAXjRXARM

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

## Kontak

Jika Anda memiliki pertanyaan, silakan hubungi Tesar Pratama pwspratama@gmail.com
