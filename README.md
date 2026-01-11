# Project UAS Pemrograman Web  
## D-Restaurant – Aplikasi Manajemen Menu Restoran

Project ini dibuat untuk memenuhi **Ujian Akhir Semester (UAS) Mata Kuliah Pemrograman Web**.  
Aplikasi **D-Restaurant** merupakan aplikasi web sederhana berbasis **PHP Native** yang digunakan untuk mengelola data menu restoran.

---

## 📄 Deskripsi Singkat Project

D-Restaurant adalah aplikasi web sederhana berbasis PHP dan MySQL yang digunakan untuk mengelola data menu restoran.
Aplikasi ini dibuat sebagai Project UAS Pemrograman Web, dengan menerapkan konsep OOP, modular, dan routing menggunakan .htaccess.

Aplikasi ini memungkinkan admin untuk mengelola menu makanan, minuman, dan dessert secara efisien, lengkap dengan fitur pencarian, pagination, serta upload gambar menu.


---


**🚀 Fitur Utama**
**🔐 Autentikasi**

- Login menggunakan database

- Role Admin dan User

- Session-based authentication

**📋 Manajemen Menu (Admin)**

- Tambah menu

- Edit menu

- Hapus menu

- Upload gambar menu

**👀 Akses User**

- Melihat daftar menu

- Pencarian menu

- Pagination data

**🎨 UI & UX**

- Tema warna pink modern

- Responsive layout

- Tombol custom (tidak default Bootstrap)


---


## 🛠️ Teknologi yang Digunakan
- PHP Native (OOP & Modular)
- MySQL
- Bootstrap 5
- HTML5 & CSS3
- Apache Web Server (XAMPP)
-  Session Authentication

---

## 🔐 Akun Login
```
| Role  | Username | Password |
| ----- | -------- | -------- |
| Admin | admin    | admin123 |
| User  | user     | user123  |
```

---

## 🗂️ Struktur Folder
```
PROJECT_UAS/
│
├── assets/
│   └── style.css
│
├── config/
│   └── database.php
│
├── data/
│   ├── add.php
│   ├── barang.php
│   ├── edit.php
│   └── delete.php
│
├── images/
│   ├── img/
├── layout/
│   ├── header.php
│   └── footer.php
│
├── modules/
│   └── auth/
│       ├── login.php
│       └── logout.php
│
├── .htaccess
├── dashboard.php
└── index.php
```

---

## 🚀 Cara Menjalankan Aplikasi
1. Install dan jalankan **XAMPP**
2. Aktifkan **Apache** dan **MySQL**
3. Import database ke **phpMyAdmin**
4. Letakkan folder project ke dalam:
htdocs/PROJECT_UAS
5. Akses aplikasi melalui browser:
http://localhost/PROJECT_UAS


---


## 🗄️ Database

### Nama Database
_project_uas_


### Tabel `users`
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255),
    role ENUM('admin','user')
);

INSERT INTO users (username, password, role) VALUES
('admin', MD5('admin123'), 'admin'),
('user', MD5('user123'), 'user');
```
### Tabel `barang`
```
CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    harga INT,
    kategori VARCHAR(50),
    deskripsi TEXT,
    gambar VARCHAR(255)
);
```


---


## 📸 Dokumentasi
Dokumentasi aplikasi meliputi:
- Screenshot halaman Login
- Dashboard
- Data Menu
- Tambah Menu
- Edit Menu
- Pencarian
- Pagination
- Logout


---


## 📁 Deskripsi Setiap Folder
`assets/`

Berisi file CSS custom untuk mengatur tampilan aplikasi.

`config/`

Berisi konfigurasi database (koneksi MySQL).

`data/`

Berisi file CRUD menu:

- barang.php → halaman daftar menu

- add.php → tambah menu

- edit.php → edit menu

- delete.php → hapus menu

`images/`

Menyimpan gambar menu yang di-upload.

`layout/`

Template header dan footer (navbar & footer).

`modules/auth/`

Mengatur proses login dan logout.

## 🎥 Video Demo
Video demo aplikasi berdurasi maksimal **10 menit**, menampilkan:
- Proses Login
- Pengelolaan Data Menu (CRUD)
- Pencarian dan Pagination
- Logout

(Link YouTube disertakan pada form pengumpulan)

---

## 👨‍🎓 Identitas Mahasiswa
- **Nama** : _Dira Rohmaeni_
- **NIM** : _312410465_
- **Kelas** : TI.24.A5
- **Mata Kuliah** : Pemrograman Web
- **Dosen Pengampu**: Agung Nugroho, S.Kom., M.Kom
- **Tahun** : 2026

---


📚 Catatan

- Hak akses dibedakan berdasarkan role
- Keamanan menggunakan session
- CRUD hanya bisa dilakukan oleh admin


---


🔒 Hak Akses

Admin: tambah, edit, hapus menu

User: hanya melihat menu


---


## ✅ Kesimpulan
Aplikasi **D-Restaurant** berhasil diimplementasikan sesuai dengan ketentuan UAS, mencakup konsep OOP, modular, routing, CRUD, pencarian, pagination, serta desain responsif. Aplikasi ini dapat digunakan sebagai dasar pengembangan sistem manajemen restoran yang lebih kompleks.

---

**© 2026 – Project UAS Pemrograman Web**
