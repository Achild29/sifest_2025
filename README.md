## Stage this App: Manage Student-Update and Delete Student
Tahap ini adalah Lanjutan dari tahap sebelumnya, pada tahap seblumnya Admin sudah dapat membuat data siswa baru, sekarang kita akan coba membuat fitur untuk Update

pastikan data yg akan di update benar perhatikan pada table yg menampilkan data siswa, saya akan gunakan id atau priamry key dari table data tersebut, dengan cara mengirimkan id nya sebagai parameter di fungsi edit, pastikan tombol edit mengarah pada fungsi edit yg telah ditentukan dengan mengirimkan parameter id nya pada file blade `./resources/views/livewire/admin/manage-student.blade.php` lalu untuk fungsi nya terdapat pada `./app/Http/Livewire/Admin/ManageStudent.php`, flow nya begini:

dari fungsi `edit($id)` yg terdapat pada `ManageStudent.php` akan men-dispatch fungsi `showEdit($id)` yg terdapat pada `ModalStudent.php`, pada fungis `showEdit($id)` akan menampilkan form edit, jika user klik tombol update pada form tersebut maka akan menjalan fungsi `update()` yg terdapat pada `ModalStudent.php` pada flow nya data dikirmkan melalui parameter fungsi dan properti dari class tersebut

untuk proses update hampir sama dengan proses delete menggunakan try-catch.

terdapat perubahan juga pada fungsi store, yg awalnya validasi di dalam fungsi tersebut sekarang saya pisah menjadi fungsi tersendiri, karena akan digunakan kembali pada fungsi update, Fungsi validasi, digunakan untuk memvalidasi field-field yg terdapat pada form.

Admin juga bisa merest password si siswa, flow nya hampir sama seperti update.

Fitur Delete:

Pada Fitur ini hampir sama flow nya, tapi ada yg menarik disini, karena Table User dan table Student memiliki relasi dan cascade on Delete

```php
$student = User::find($this->idUser)?->Student;
$student->user->delete();
```
maka ketika saya menghapus record pada table user, secara otomatis akan menghapus record pada table student yg memiliki relasi pada field: user_id

Perlu diperhatikan, di sini saya tidak mengimplementasikan yg namanya SoftDelete, library tambahan dari Laravel, Maka dari itu perlu diperhatikan ketika akan menghapus data nya. Sekali terhapus maka data tidak bisa restore kembali

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
