## Stage this App: Fitur Login with multi user
pada tahap ini saya akan membuat fitur login denga 3 level user yg berbeda;
1. admin
2. guru
3. murid/wali murid

pertama membuat 3 Controller dengan level yg berbeda:
```
sail artisan make:controller Admin/DashboardController
sail artisan make:controller Teacher/DashboardController
sail artisan make:controller Student/DashboardController
```
setelah menjalankan perintah diatas maka secara otomatis akan membuat folder dengan file controller nya

- ./app/Http/Controllers/Admin/DashboardController.php
- ./app/Http/Controllers/Teacher/DashboardController.php
- ./app/Http/Controllers/Student/DashboardController.php

setelah itu saya coba membuat sebuah view sederhana yg akan menampilkan halaman dashboard, yang bertuliskan Hello [nama user yg telah login] anda sudah login, dengan nama file blade nya adalah dashboard
```
sail artisan make:view dashboard
```
lalu atur juga route nya, untuk melihat dashboard nya.

Sekarang mari kita atur Logic untuk Authentication Login nya
saya akan membuat sebuah controller baru yg terdapat pada foler Auth
```
sail artisan make:controller Auth/AuthController
```
saya juga mengarhakan untuk login page dari AuthController tersebut, cek di route/web.php pada ->name('login');
saya membuat customRequest baru, ./app/Http/Requests/UserAuthRequest
```
sail artisan make:request UserAuthRequest
```
pastikan pada view login, field nya adalah text, dan password sesuai dengan yg terdapat pada UserAuthRequest
dan pada form action nya menuju pada function yg terdapat pada AuthController melalui routes

Selanjutnya saya juga membuat sebuah custom middleware: RedirectIfAuthenticated yang meng-extends ke Illuminate\Auth\Middleware\RedirectIfAuthenticated
```
sail artisan make:middleware RedirectIfAuthenticated
```
ini supaya mencegah hak akses pada routes
lalu atur juga alias pada ./boostrap/app.php
seletelah itu tambahkan guard pada ./config/auth.php
terakhir atur pada routes nya membuatnya menjadi sebuah group berdasarkan middleware

## Aplikasi ini dibuat dengan

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

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
