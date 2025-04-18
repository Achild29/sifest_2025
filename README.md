## Stage this App: Membuat Tampilan Dashboard
Pada tahap ini saya akan menggunakan Livewire
pertama-tama membuat sebuah Layout terlebih dahulu
```bash
sail artisan livewire:layout
```
perintah diatas secara ototmatis akan membuat kan sebuah layout file: `./resources/views/components/layouts/app.blade.php`
selanjutnya ubah layout tersebut, saya juga memecahnya menjadi sebuah component
```bash
sail artisan make:component namaComponent --view
```
setelah component untuk layoutnya sudah selesai, sekarang kita akan membuat sebuah component dari livewire dengan nama dashboard
```bash
sail artisan make:livewire dashboard
```
sesuaikan view pada `./resources/views/livewire/dashboard.blade.php` dan `./resources/views/dashboard.blade.php`

lalu lihat tampilannya pada dashboard:
1. [Admin Dashboard](http://localhost/admin)
2. [Guru Dashboard](http://localhost/guru)
3. [Siswa Dashboard](http://localhost/siswa)

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
