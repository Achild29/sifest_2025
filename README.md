## Stage this App: Manage Student-Read and Create Student
pada tahap ini akan saya coba implementasikan CRUD, untuk Admin, dapat Create Read Update dan Delete data Siswa
pertama saya membuat sebuah component livewire dengan nama ManageStudent
```bash
sail artisan make:livewire ManageStudent
```
dari perintah diatas akan membuat 2 file sekaligus: `./app/Livewire/Admin/ManageStudent.php` dan `./resources/views/livewire/admin/manage-student.blade.php`file pertama sebagai backend nya sedangkan file kedua sebagai frontendnya.
dari backend kita akan menggunakan Model Student yg mengambil dari database, lalu dikirimkan ke frontend agar menjadi sebuah data table siswa,
jangan lupa juga untuk mengatur route nya, tambahkan juga pada menu di sidebar

- terdapat perubahan juga di seeder nya, jadi untuk username dengan role siswa menggunakan NISN `username.users` === `nisn.students`

saya juga membuat component livewire baru bernama ModalStudent
```bash
sail artian make:livewire admin/ModalStudents
```
pada `./resources/views/livewire/admin/modal-students.blade.php` saya mendifinisak sebuah modal bisa berupa form untuk edit, create student, dan konfirmasi delete
adapaun field input yg terdapat pada modal tersebut kita juga harus deklarisakn sebagai properti di class `./app/Livewire/Admin/MidalStudents.php` agar mempermudah kita dalam penanganan CRUD

Create

untuk membuat data baru, pertama kita validasi terlebih dahulu, field2 nya, setelah validasi berhasil, selanjutnya saya akan insert di table user terlebih dahulu selanjutnya insert pada table student, adapaun tahapan insertnya:

Saya menggunakan blok try-catch, jika gagal menyimpan data ke database maka akan ketahuan eror nya dimana

inisialisasi sebelum insert `DB::beginTransaction()` : Sistem akan mencatat semua perubahan setelah ini tapi belum disimpan dalam database, read more about [DB::beginTransaction()](https://laravel.com/docs/master/database#manually-using-transactions)

proses: `DB::commit()` : pada tahap ini, menyimpan semua perubahan secara permananen, kalau semua operasi berhasil, kita commit, seperti git commit.

penaganan eror, pada block catch `DB::rollBack()`: membatalkan semua perubahahan sejak insisalisasi atau sejak `DB::beginTransaction()`, artinya kalau ada eror, maka tidak akan ada data yg tersimpan pada database, nah untuk pesan eror nya terdapat pada objek e yaitu instance of Exception pada method getMessage

- pastikan juga pada model terdapat properti fillable yg berisikan array field yg dapat kita insert

`$this->reset()`: akan me reset semua field yg pernah di input oleh user

`this->dispatch('student-created')` : method ini bawaan dari livewire, ini sangat berguna sekali, jadi data yg terdapat pada table akan secara otomatis terupdate jika data terdapat perubahan, konsepnya seperti ajax atau asyncronus, jangan lupa juga tambahkan `#[On(['student-created'])]` pada fungsi yg menngunakan model dari database.

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
