## Stage this App: Generate QR Code
untuk QR Code saya menggunakan package dari `simplesoftwareio/simple-qrcode`, untuk menginstall package tersebut, run this command:
```bash
sail composer require simplesoftwareio/simple-qrcode
```
atau
```bash
composer require simplesoftwareio/simple-qrcode
```
note: karena saya developmentnya menggunakan docker maka dari itu terdapat perintah sail, read more about [sail](https://laravel.com/docs/master/sail)

Selanjutnya, saya membuat fungsi helper untuk mengenerate Qr code adapun fungsi tersebut terdapat pada `app/Helpers/QrCodeHelper.php`, saya membuat agar reuseable.
adapaun fungsi nya:
membuat qr code dari nisn siswa, qrcode nya berupa gambar/png, format name nya adalah qr_nisn.png dan tersimpan di `storage/public/qr_code/`

pada seeder student `databse/StudentSeeder.php` saya juga menggunakan fungsi helper tersebut,
saat user dengan role admin membuat akun siswa fungsi helper tersebut juga digunakan.

secara otomatis saat seeder di jalankan akan membuat qr code tersebut dan juga saat user dengan role admin membuat akun siswa secara otomatis juga akan membuat qr code nya juga. nah ketika admin menghapus akun siswa, gambarnya juga akan otomatis terhapus.

pada akun siswa, saya juga menambahkan sidebar untuk melihat qr_code nya, ketika di klik akan membuka tab baru dan menampilkan qr_code nya...

Struktur database nya juga berubah, pada table student saya menambahkan field qr_path:

run this command please:
```bash
php artisan migrate:fresh --seed
```
or
```bash
sail artisan migrate:fresh --seed
```
and check folder `storage/public/qr_code`

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

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
