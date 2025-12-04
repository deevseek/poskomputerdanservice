# Aplikasi Kasir + Servis + Garansi Multi-Tenant (Laravel 10)

Proyek ini adalah kerangka awal aplikasi SaaS POS + Servis + Garansi berbasis Laravel 10 dengan dukungan multi-tenant subdomain.

## Instalasi
1. Clone repo dan masuk direktori
   ```bash
   git clone <url> poskomputerdanservice
   cd poskomputerdanservice
   ```
2. Instal dependensi
   ```bash
   composer install
   ```
3. Salin file env
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Atur koneksi database MySQL di `.env`.
5. Jalankan migrasi dan seeder
   ```bash
   php artisan migrate --seed
   ```
6. Konfigurasi subdomain untuk multi-tenant (misal menggunakan wildcard `*.aplikasipos.test`) dan arahkan ke aplikasi Laravel. Middleware `tenant` bertugas meresolusi subdomain ke data tenant.

Semua label UI menggunakan Bahasa Indonesia dan format rupiah Rp.
