1. Pastikan sudah menginstall composer
2. Jalankan command "composer install", untuk menginstall requirement package composer
3. Buat File .env untuk konfigurasi database dan installasi Koneksi Server Midtrans
   isi file .env sebagai berikut :
# Koneksi Databas
DB_HOSTNAME=""
DB_USERNAME=""
DB_PASSWORD=""
DB_DATABASE=""
DB_DRIVER="mysqli"

# Koneksi Midtrans
SERVER_KEY=""
CLIENT_KEY=""

#Sesuaikan hostname, username, password, dan database anda
#Sesuaikan juga Server Key, Client Key milik anda, belum punya akun silahkan daftar www.midtrans.co.id
#Jika tidak memasukan Server Key dan Client Key Metode pembayaran nontunai tidak akan berfungsi

4. Import database wafood.sql pada phpmyadmin
5. Masuk dengan akun berikut
Masuk Admin
Nama Pengguna   : admin
Kata Sandi      : admin123