## Stage this App: add TailwindCSS, library Livewire/Flux UI and create view login
saya menggunakan storage link jadi, semua asset gambar akan terdapat pada direktori storage

untuk mengaktifkan strorage link, jalankan perintah berikut:
```
sail artisan storage:link
```
selanjut nya buat direktori 'assets' pada ./storage/app/public/
```
mkdir storage/app/public/assets
```
jadi sekarang semua asset gambar terdapat di direktori

- ./storage/app/public/assets/

pada tahap ini saya menginstall framework css: [tailwind](https://tailwindcss.com/)
```
sail npm install tailwindcss @tailwindcss/vite
```
saya juga menggunakan library [livewire](https://livewire.laravel.com/) dari Laravel dan [Flux UI](https://fluxui.dev/docs/installation)
```
sail composer require livewire/livewire
sail composer require livewire/flux
```
lalu saya membuat view login
```
sail artisan make:view auth/login
```
perintah diatas akan secara otomatis membuat file blade:

- ./resources/views/auth/login.blade.php

saya juga sudah menambahkan pada routes/web.php, untuk menampilkan tampilan dari file blade telah dibuat
nah untuk melihat hasilnya jangan lupa jalankan vite nya:
```
sail npm run dev
```
lalu lihat pada [localhost/login](http://localhost/login)


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
