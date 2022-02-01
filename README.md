# Toserba

Program ini dibuat untuk memenuhi tugas akhir Pemrograman WEB, dengan mitra toko kelontong milik ibu Zainidar

# Konfigurasi Project

# dapat menjalankan development server melalui command line (cmd, power shell)

1. pada command line masuk ke folder C:\xampp\htdocs\toserba\public
2. ketikan perintah php -S localhost:8080
Jika terdapat error pada langkah 2 itu dikarenakan fungsi php belum dikenali secara global, oleh karena itu ikuti langkah ke 3 jika tidak ada error silahkan langsung ke langkah 6
3. pada komputer cari environment variables
4. Pada User variables di bagian "Path" tekan tombol "Edit"
5. Lalu tambahkan lokasi php anda jika di C silahkan copy "C:\xampp\php", jika tidak maka sesuaikan dimana xampp diinstal
6. pada url browser ketikan localhost:8080

# coba cara satu terlebih dahulu
# atau dapat mensetting virtual host 

1. Buka notepad dengan Run as administrator
2. Buke file httpd-vhosts.conf yang berada di C:\xampp\apache\conf\extra
3. Pada bagian bawah file setting dengan konfigurasi seperti ini lalu save

NameVirtualHost 127.0.0.1:80
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"
    ServerName localhost
</VirtualHost>
<VirtualHost *:80>
   	DocumentRoot "C:/xampp/htdocs/toserba/public"
   	ServerName toserba.store
	DirectoryIndex index.php
	<Directory "C:/xampp/htdocs/toserba/public">
		AllowOverride All
		Allow from All
	</Directory>
</VirtualHost>

4. Selanjutnya, buka file hosts yang berada di lokasi C:\Windows\System32\Drivers\etc
5. Pada bagian bawah file setting dengan konfigurasi seperti ini sesuai dengan namserver yang sebelumnya di setting di file httpd-vhosts.conf, lalu save

127.0.0.1 localhost
127.0.0.1 toserba.store

6. Restart Apache di xampp
7. Jalankan toserba.store di browser

