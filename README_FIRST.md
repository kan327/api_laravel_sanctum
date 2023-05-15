# langsung buka SiswaController aja 

1. Buka terminal atau command prompt atw langsung ctrl+`~ di vsc

2. Salin file `.env.example` menjadi `.env` pake `cp .env.example .env` di terminal.

3. `composer install` di terminal untuk menginstal dependensi

4. jalanin perintah `php artisan key:generate` di terminal. untuk melakukan enkripsi data, seperti cookie dan password.

5. Buat databasenya aja namanya [   apiKelompok3    ] dan setting envnya

6. `php artisan migrate` untuk melakukan migrasi tabel ke dalam database

7. Terakhir, jalankan perintah `php artisan serve --port=8081` untuk memulai server lokal. kalo bukan port 8081 pake php artisan serve biasa aja, tapi jangan lupa ganti api.dart di flutter nanti

# ARIGATO NEE