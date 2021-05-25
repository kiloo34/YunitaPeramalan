Instalasi

Sebelum Proses Instalasi

pastikan komputer anda sudah terinstall composer dan npm
Sudah? Ok Lanjut

jalankan git clone https://github.com/kiloo34/YunitaPeramalan
masuk ke direktori app
jalankan composer install
jalankan php artisan key:generate
buat database MySQL untuk app-nya
copy file .env.example ke .env
perbarui file .env sesuaikan dengan nama database yg telah dibuat
jalankan composer dump-autoload
jalankan php artisan migrate --seed
jalankan npm install
jalankan php artisan serve
