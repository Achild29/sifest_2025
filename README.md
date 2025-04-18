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

## Stage this App: Add Service phpmyadmin

Pada tahap ini saya menambahakan service baru pada container docker saya
service baru nya yaitu:

- phpmyadmin

saya sudah memberikan alias pada file .bashrc saya di direktori ~/home/[username]
```
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```

sehingga dapat dengan mudah menjalankan aplikasi nya dengan perintah sebagai berikut:
```
sail up -d
```
pasitkan untuk mengetikan perintah diatas pada folder project dan juga sudah menajalankan docker desktop nya
perintah diatas akan menjalankan semua service dalam satu container pada docker

setelah berjalan lalu pergi ke halaman: [localhost](http://localhost/)
jika masih terdapat error pastikan juga anda sudah migrasi database nya dengan perintah sebagai berikut:
```
sail artisan migrate
```

untuk melihat service phpmyadmin anda bisa pergi ke: [localhost:8080](http://localhost:8080) 
untuk masuk ke panel phpmyadmin, berikut ini adalah authentication nya:
Server: mysql
Username: sail
Password: password
atau bisa anda lihat pada file .env

Note: Saya menggunakan Linux: Ubuntu 24.04.2 LTS, jika kalian menggunakan windows berbeda lagi, silahkan hubungi developer untuk menjalankan aplikasi ini
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
