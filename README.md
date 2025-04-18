## Stage this App: Add Toaster
Pada tahap ini saya akan menggunakan Toaster dari https://github.com/masmerise/livewire-toaster
install toaster:
```
sail composer require masmerise/livewire-toaster
```
setelah itu ubah juga pada views yg akan menggunakan toaster tersebut
secara garis beras letakan pada layout - jika anda menggunakan layout
```html
<!DOCTYPE html>
<html>
<head>
    <!-- ... -->
</head>

<body>
    <!-- Application content -->

    <x-toaster-hub /> <!-- 👈 -->
</body>
</html>
```
lalu pada AuthController saya akan coba menggunakannya jika login gagal
selanjutnya saya coba atur secara custom Toasternya, untuk mengaturnya terdapat pada config
```
sail artisan vendor:publish --tag=toaster-config
sail artisan vendor:publish --tag=toaster-views
```
saya juga mengatur pada `./resources/view/vendor/toaster` check cara penggunaan Toaster pada halaman [documentasi](https://github.com/masmerise/livewire-toaster?tab=readme-ov-file#installation) nya
lalu tambahkan pada `./resources/js/app.js`
```js
import './bootstrap';
import '../../vendor/masmerise/livewire-toaster/resources/js'; // 👈

// other app stuff...
```
check apakah Toaster berjalan dengan login username dan password yg salah

thanks to https://github.com/masmerise/livewire-toaster

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
