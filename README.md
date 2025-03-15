# Food Share Hub
Food Share Hub adalah platform berbasis web yang dirancang untuk memoderasi dan mengelola distribusi program makan gratis. Platform ini memungkinkan pengguna untuk mengajukan permintaan makanan, jumlah kebutuhan, serta melihat status pengiriman makanan (dalam perjalanan atau belum dikirim).


## Fitur Utama
1. Ajukan Permintaan: Page dengan fitur bagi pengguna untuk mengajukan permintaan program makan gratis ke sekolahnya.
2. Status Permintaan: Page dengan fitur bagi pengguna untuk melihat apakah permintaan tersebut masih pending ataupun sudah diterima atau ditolak
3. Riwayat Bantuan: Page dengan fitur bagi pengguna untuk melihat riwayat bantuan yang telah diajukan
4. Pengaturan Pengguna: Page dengan fitur bagi pengguna untuk mengubah atau mengatur data dirinya.

## Teknologi yang Digunakan

Framework: Laravel
Database: MySQL
Bahasa Pemrograman: PHP
Frontend: Blade Template Engine
Server: Apache (XAMPP/LAMP/WAMP)

## Instalasi
1. Git clone https://github.com/yimeiw/foodShareHub.git
2. cd foodShareHub
3. composer install
4. copy .env.example .env
5. php artisan key:generate
6. code . (masuk ke dalam vscode dan buka terminalnya)
7. buka XAMPP dan buat database bernama laravel 
8. php artisan migrate
9. php artisan serve (buka link localhost)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
