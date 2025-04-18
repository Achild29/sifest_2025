## Stage this App: Add Models+Migration
pada tahap ini saya membuat Model beserta Migrationnya
Terdapat 4 Model tambahan beserta:

- ./app/Http/Models/Attendance
- ./app/Http/Models/ClassRoom
- ./app/Http/Models/Student
- ./app/Http/Models/Teacher

sedangkan pada 4 Migrations, secara urut saya membuatnya:

- add_role_to_users_table:
pada file migration ini saya menambahkan 2 field; username dan role, adapun role nya saya sudah deklarasikan pada Enums file

- create_students_table
- create_teachers_table
- create_class_rooms_table
- add_columns_to_students:
pada file ini saya menambahkan field kelas_id di table students sebagai foreignId terhadap table class_rooms, saya membuat table class_rooms terlebih dahulu lalu saya menambahkan field baru, agar tidak terjadi error

- create_attendance_table:
pada table attendance terdapat status, yg telah saya deklarisakn juga pada Enums file

adapun relasi nya
1. Model User -> User one to one Student/Teacher
Satu User = satu Student / satu Teacher, tergantung dari role-nya.

2. Model Student
Siswa milik satu user -> Student many to one User
Siswa berada di satu kelas -> Student many to one ClassRoom
Siswa punya banyak data absensi -> Student one to many Attendance

3. Model Teacher
Guru milik satu user -> Teacher one to one User
Guru bisa jadi wali untuk banyak kelas -> Teacher one to many ClassRooms
Guru bisa scan absensi masuk dan pulang untuk banyak siswa -> Teacher one to many Attendance

4. Model ClassRoom
Satu kelas dimiliki oleh satu guru (wali kelas) -> ClassRoom many to one Teacher
Satu kelas memiliki banyak siswa -> ClassRoom one to many Student
Satu kelas memiliki banyak data absensi -> ClassRoom one to many Attendance

4. Model Attendance
Absensi milik satu siswa -> Attendance many to one Students
Absensi terjadi dalam satu kelas ->  Attendance many to one ClassrRoom
Absensi discan masuk dan pulang oleh dua guru berbeda (bisa sama) -> Attendance many to one Teacher

untuk melihat Databasenya: jalankan perintah berikut
```
sail artisan migrate
```

lalu lihat pada phpmyadmin
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
