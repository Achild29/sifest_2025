## Stage this App: Main Core: Scan Masuk
Pada update ini, Guru dapat melakukan scan untuk absensi Masuk

untuk fitur scan nya saya menggunakan library [html5-qrcode](https://github.com/mebjas/html5-qrcode/tree/master) jangan lupa kasih bintang pada github nya hehe.
nah untuk menggunakan library tersebut saya mengambil script js nya lalu saya simpan script js nya pada direktori`public/js` dengan nama file `html5-qrcode.min.js` adapun sctipt nya saya ambil dari [githubnya](https://github.com/mebjas/html5-qrcode/blob/master/minified/html5-qrcode.min.js)

nah pada view `resources/views/livewire/guru/absensi/scan-masuk.blade.php` saya menambahk code untuk script scanner code nya
```php
@push('html5-qrcode') //untuk menggunakan library html5-qrcode
    <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
@endpush

@push('scan-qr') //untuk memanggil script scanner
    <script src="{{ asset('js/scan-qr-masuk.js') }}"></script>
@endpush
```
nah pada layouts juga harus ditambahkan `resources/views/components/layouts/app/blade.php`
```php
@stack('html5-qrcode') //didalam header
@stack('scan-qr') //didalam body
```
methode diatas saya menggunakan stack-push fitur bawaan blade laravel
selanjutanya saya juga menambahkan file `scan-qr-masuk.js` pada direktori `public/js` agar rapih, jadi saya pisahkan untuk js berada di direktori tersbut sedangkan php berada pada blade php

pada src `scan-qr-masuk.js`:
```js
function onScanSuccess(decodedText, decodedResult) {
    var variabelData = { data: {   //ini data yg akan dikirimkan
        code: decodedResult.decodedText
    }};
    Livewire.dispatch('qr-scanned', variabelData); //ini akan menjalakan fungsi yg terdapat pada component livewire
    html5QRCodeScanner.clear();
}
```
akan terhubung/menjalakan pada fungsi yg terdapat pada `app/Livewire/Guru/Absensi/ScanMasuk.php`
```php
#[On('qr-scanned')]
public function handleScan(array $data)
{
    ...
}
```
nah pada fungsi handleScan membutuhkan parameter data berupa array yg telah dikirimkan dari file js tersebut
selanjutnya akan membuat record attendaces

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
