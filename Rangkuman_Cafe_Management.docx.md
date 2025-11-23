# Rangkuman Flow dan Business Process - Sistem Cafe Management

## 1. **Deskripsi Umum**
Sistem Cafe Management adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola operasional cafe secara digital, meliputi manajemen produk, pesanan, kategori, dan pengaturan sistem.

## 2. **Jenis Pengguna (User Roles)**
- **Pengunjung (Guest)**: Pengguna yang belum login
- **Pelanggan (Customer)**: User yang terdaftar dan dapat memesan
- **Admin**: User dengan akses penuh untuk mengelola sistem

## 3. **Business Process Flow**

### **Flow Pengunjung (Guest)**
```
1. Akses Halaman Welcome
2. Registrasi (jika belum memiliki akun)
3. Login
4. Menuju Dashboard / Produk
```

### **Flow Pelanggan (Customer)**
```
1. Login ke Sistem
2. Melihat Daftar Produk
3. Menambahkan Produk ke Keranjang
4. Mengelola Keranjang (update kuantitas/hapus item)
5. Membuat Pesanan (Checkout)
6. Melihat Riwayat Pesanan
7. Mengelola Profil
```

### **Flow Admin**
```
1. Login ke Sistem
2. Manajemen Produk:
   - Tambah/Edit/Hapus Produk
   - Toggle ketersediaan produk
3. Manajemen Pesanan:
   - Lihat semua pesanan
   - Update status pesanan
   - Pembatalan pesanan
4. Manajemen Kategori:
   - Tambah/Edit/Hapus kategori
5. Manajemen Pengguna:
   - Lihat daftar pelanggan
   - Hapus akun pelanggan
6. Manajemen Pengaturan:
   - Konfigurasi website
   - Pengaturan umum
```

## 4. **Proses Bisnis Utama**

### **A. Manajemen Produk**
- Admin menambahkan produk baru dengan detail harga, deskripsi, kategori
- Produk dapat di-hide/tampilkan sesuai ketersediaan
- Produk dikelompokkan berdasarkan kategori

### **B. Proses Pemesanan**
- Pelanggan memilih produk dan menambahkan ke keranjang
- Pelanggan dapat mengupdate kuantitas atau menghapus item dari keranjang
- Pelanggan melakukan checkout untuk membuat pesanan
- Admin menerima pesanan dan dapat mengupdate statusnya (baru, diproses, siap, selesai, dibatalkan)

### **C. Manajemen Kategori**
- Admin dapat membuat kategori produk (misal: Makanan, Minuman, Desert)
- Produk dapat difilter berdasarkan kategori

### **D. Manajemen Akun**
- Registrasi akun pelanggan
- Login/logout sistem
- Update profil pengguna

## 5. **Fitur Utama yang Tersedia**

### **Untuk Pelanggan:**
- Registrasi dan login
- Browsing produk berdasarkan kategori
- Shopping cart (keranjang belanja)
- Checkout pesanan
- Melihat riwayat pesanan
- Update profil

### **Untuk Admin:**
- Dashboard admin
- CRUD produk
- CRUD kategori
- Manajemen pesanan (lihat, update status, batalkan)
- Manajemen pelanggan
- Pengaturan website
- Monitoring semua aktivitas

## 6. **Teknologi yang Digunakan**
- **Backend**: Laravel 12 Framework
- **Database**: SQLite
- **Frontend**: Tailwind CSS, Alpine.js
- **Build Tool**: Vite

## 7. **Keunggulan Sistem**
- Antarmuka yang responsif dan user-friendly
- Pembagian role pengguna yang jelas
- Manajemen produk dan pesanan yang komprehensif
- Sistem shopping cart real-time
- Fitur manajemen admin yang lengkap
- Arsitektur yang modular dan scalable

## 8. **Use Case Utama**
- Memudahkan pelanggan dalam memesan makanan/minuman
- Membantu admin dalam mengelola produk dan pesanan
- Memberikan visibilitas penuh atas aktivitas operasional cafe
- Mempercepat proses pemesanan dan manajemen inventaris

Sistem ini sangat cocok digunakan untuk cafe, restoran, atau tempat makan lainnya yang ingin mengoptimalkan proses pemesanan dan manajemen operasionalnya secara digital.