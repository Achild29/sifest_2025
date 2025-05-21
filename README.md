## CodeNest
- Latar Belakang:

Dalam era digital yang terus berkembang pesat, penguasaan keterampilan pemrograman menjadi semakin krusial dan relevan bagi individu dalam berbagai bidang Namun, seringkali ditemukan bahwa keterbatasan waktu dalam kurikulum pendidikan formal menjadi kendala bagi peserta didik yang ingin mendalami pemrograman secara komprehensif.

Meyakini perlunya solusi untuk mengatasi tantangan-tantangan tersebut dan memberikan kesempatan belajar pemrograman yang lebih intensif dan terstruktur di luar jam pendidikan formal, sebuah program kelompok atau club yang akan menjalankan kegiatan serupa bootcamp pemrograman direncanakan untuk dibentuk di lingkungan lembaga pendidikan ini. Program ini diharapkan dapat menjadi wadah pengembangan diri bagi peserta didik yang memiliki minat dan potensi di bidang pemrograman, memberikan pelatihan yang lebih mendalam dan fokus, yang mungkin sulit didapatkan dalam kurikulum reguler dengan
sumber daya pengajar yang terbatas.

Mengingat rencana pembentukan program bootcamp pemrograman di lingkungan lembaga pendidikan ini yang didasari oleh kebutuhan peserta didik untuk mendapatkan
pembelajaran pemrograman yang lebih mendalam di luar keterbatasan kurikulum reguler dan tantangan ketersediaan tenaga pengajar yang kompeten, saya mengembangkan dan merancang sistem aplikasi dasar yang akan mendukung operasionalnya. Aplikasi berbasis web ini dibangun menggunakan Laravel, Livewire, Tailwind CSS, dan Flux UI, dengan fokus pada penyediaan fitur-fitur esensial untuk pengelolaan bootcamp. Sistem ini dirancang dengan tiga
tingkatan peran pengguna: Admin yang dapat mengelola akun pengguna lain, Guru (kemungkinan akan diperankan oleh satu atau beberapa tenaga pengajar yang kompeten, atau mungkin juga melibatkan praktisi industri) yang dapat mengelola kelas, materi, jadwal, dan
absensi, serta Siswa yang dapat mengikuti kelas dan mengakses materi.

Meskipun belum memiliki fitur yang sangat komprehensif, aplikasi ini diharapkan dapat menyediakan rancangan dasar yang esensial, seperti pengelolaan akun pengguna dengan berbagai peran (Admin, Guru, Siswa), pengelolaan kelas dan peserta, distribusi materi pembelajaran (modul), penjadwalan kegiatan pembelajaran, serta sistem absensi dengan pemindaian QR code dan opsi manual. Aplikasi ini juga memungkinkan guru untuk melihat laporan absensi per siswa maupun per kelas, serta melihat jadwal yang telah dibuat.

Dengan adanya aplikasi ini, diharapkan proses administrasi dan operasional bootcamp pemrograman dapat berjalan lebih lancar, terorganisir, dan transparan, memberikan dukungan yang signifikan bagi peserta didik yang ingin memperdalam keterampilan pemrograman di luar keterbatasan kurikulum reguler dan keterbatasan sumber daya pengajar di lingkungan lembaga pendidikan ini. Selain itu, aplikasi ini juga diharapkan dapat menjadi fondasi yang kuat untuk
pengembangan sistem yang lebih komprehensif di masa depan, seiring dengan pertumbuhan dan perkembangan club pemrograman di lingkungan lembaga pendidikan ini. Aplikasi ini menjadi langkah awal yang signifikan dalam mendukung terciptanya lingkungan belajar pemrograman yang efektif dan kolaboratif di lingkungan lembaga pendidikan ini, dengan memanfaatkan sumber daya pengajar yang ada secara lebih terstruktur.

## Pre-Req.
Pastikan sudah install:
1. php minimal versi 8.3
2. composer
3. NodeJs
4. webserver
5. database

## how to install
- download all source from git hub:
```bash
git clone https://github.com/Achild29/sifest_2025
```

- install dependcies with composer:
```bash
composer install
composer update
```

- install dependecies with npm:
```bash
npm install
npm run build
```

- Membuat file configurasi nya file .env dari .env.example, ketikan perintah berikut:
```bash
cp .env.example .env
```


- konfigurasi file .env
- migrasi database:
```bash
php artisan migrate
```
- jalankan seeder:
```bash
php artisan db:seed
```

- generate app key:
```bash
php artisan key:generate
```

- jalankan web server dan nyalakan port untuk database

## Aplikasi ini dibuat dengan
1. Laravel
2. Tailwind CSS
3. Flux UI

## About Laravel
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## License
Programmer: Wahyu Khoirur Rizal - 221091750092 | 05SISM001
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
