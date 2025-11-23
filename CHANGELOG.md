# Changelog

All notable changes to this project will be documented in this file.

## [Unreleased] - 2025-11-23

### Ditambahkan
- **Autentikasi Berbasis Username**: Implementasi username untuk login pengguna menggantikan NISN
  - Migrasi baru untuk mengganti kolom nisn menjadi username di tabel pengguna
  - Kolom username sekarang wajib diisi saat registrasi
- **Desain Layout Mobile App**: Desain mobile-first untuk halaman login dan register
  - Layout responsif yang menjaga tampilan aplikasi mobile di desktop
  - Wadah layar mobile yang terpusat dengan sudut membulat dan bayangan
  - Ukuran layar mobile tetap (414px x 892px) untuk pengalaman konsisten
- **Kolom Alamat Pengguna**: Implementasi kolom alamat untuk profil pengguna
  - Migrasi baru untuk menambahkan kolom alamat ke tabel pengguna
  - Kolom input ditambahkan ke formulir registrasi dalam bentuk textarea
  - Kolom input ditambahkan ke formulir pembaruan profil dalam bentuk textarea
  - Validasi ditambahkan untuk kolom alamat (maksimal 500 karakter)
  - Contoh data alamat ditambahkan ke seeder
- **Kolom Nomor Telepon Pengguna**: Implementasi kolom no_hp untuk profil pengguna
  - Migrasi baru untuk menambahkan kolom no_hp ke tabel pengguna
  - Kolom input ditambahkan ke formulir registrasi dalam bentuk input tel
  - Kolom input ditambahkan ke formulir pembaruan profil dalam bentuk input tel
  - Validasi ditambahkan untuk kolom nomor telepon (maksimal 15 karakter)
  - Contoh data nomor telepon ditambahkan ke seeder
- **Peningkatan Dashboard Siswa**: Ganti slider promosi dengan daftar pesanan terbaru
  - Buat view dashboard siswa terpisah (resources/views/dashboard/student.blade.php)
  - Hapus slider promosi dari dashboard siswa
  - Tambahkan daftar pesanan terbaru yang menampilkan 5 pesanan terakhir dengan status dan harga
  - Terapkan statistik cepat untuk pesanan menunggu dan siap diambil
  - Tambahkan link ke detail pesanan dan riwayat pesanan lengkap
  - Perbarui DashboardController untuk mengarahkan pengguna siswa ke view yang benar
- **Peningkatan Halaman Checkout**: Diperbarui informasi halaman pembuatan pesanan dan metode pembayaran
  - Mengganti informasi NISN dengan alamat pengguna di halaman pembuatan pesanan
  - Menggunakan ikon lokasi untuk menampilkan informasi alamat pengguna
  - Mengganti teks metode pembayaran dari 'Tunai saat ambil' menjadi 'COD - Cash on Delivery'
  - Memperbarui instruksi pembayaran dari 'Bayar langsung di kantin' menjadi 'Bayar langsung saat menerima pesanan'
  - Menambahkan teks cadangan jika alamat pengguna belum diisi
  - Memperbarui ikon dan gaya tampilan untuk menyesuaikan perubahan
- **Penghapusan Alert Informasi Penting**: Hapus bagian informasi penting dari halaman checkout
  - Menghapus alert kuning dengan teks 'Informasi Penting' di halaman /orders/create
  - Menghapus petunjuk tentang proses pesanan setelah klik tombol
  - Menghapus petunjuk untuk menyiapkan uang pas saat mengambil pesanan
  - Menghapus struktur HTML yang mengelilingi alert termasuk ikon dan warna

### Diubah
- **Sistem Autentikasi**: Ganti NISN dengan username untuk identifikasi pengguna
  - Form login sekarang menerima username atau email untuk otentikasi
  - Form registrasi sekarang membutuhkan input username
  - LoginRequest diperbarui untuk mengotentikasi dengan username atau email
  - Model User diperbarui untuk menggunakan username menggantikan nisn
  - Seeder pengguna diperbarui untuk menggunakan username untuk akun default
- **Nama Aplikasi Berbasis Pengaturan**: Implementasi nama aplikasi dinamis dari pengaturan database
  - Perbarui AppServiceProvider untuk menyediakan variabel cafeName dan appName ke semua view
  - Gunakan View Composer agar pengaturan tersedia secara global
  - Penanganan error untuk kasus ketika tabel pengaturan belum ada
- **Layout Mobile**: Perbarui halaman login dan register dengan format aplikasi mobile
  - Layout wadah terpusat di layar desktop
  - Tampilan seperti perangkat mobile dengan sudut membulat dan bayangan
  - Pengalaman mobile konsisten terlepas dari perangkat yang digunakan

### Diubah (Perubahan Sebelumnya)
- **Rute**: Ganti rute utama (/) dari halaman selamat datang ke redirect ke halaman login
- **Nama Aplikasi**: Semua instance "Kantin Sekolah" diganti dengan variabel dinamis $appName/$cafeName
  - Halaman login (`resources/views/auth/login.blade.php`)
  - Halaman register (`resources/views/auth/register.blade.php`)
  - Judul layout tamu (`resources/views/layouts/guest.blade.php`)
  - Judul layout aplikasi (`resources/views/layouts/app.blade.php`)
  - Header navigasi (`resources/views/layouts/navigation.blade.php`)
  - Halaman selamat datang (`resources/views/welcome.blade.php`)
- **Konfigurasi Database**: Ganti nama database di .env dari `aplikasi-kantin` ke `aplikasi-cafe`
- **Lingkungan**: Perbarui APP_NAME dari 'Laravel' ke 'Aplikasi Cafe' dan APP_URL dari 'http://kantin.test' ke 'http://cafe.test'

### File yang Dimodifikasi
- `app/Models/User.php` - Ganti fillable dari nisn ke username
- `app/Http/Requests/Auth/LoginRequest.php` - Perbarui otentikasi untuk menggunakan username
- `app/Http/Controllers/Auth/RegisteredUserController.php` - Perbarui registrasi untuk menggunakan username
- `resources/views/auth/login.blade.php` - Perbarui label formulir dan placeholder untuk username dan layout mobile
- `resources/views/auth/register.blade.php` - Ganti kolom NISN dengan kolom username dan perbarui layout mobile
- `database/seeders/UserSeeder.php` - Perbarui pengguna default untuk menggunakan username
- `database/migrations/2025_11_23_094036_rename_nisn_to_username_in_users_table.php` - Migrasi untuk mengganti kolom
- `app/Providers/AppServiceProvider.php` - Tambahkan View Composer untuk pengaturan global
- `routes/web.php` - Ganti rute utama untuk redirect ke login
- `resources/views/layouts/guest.blade.php` - Perbarui judul untuk menggunakan nama aplikasi dinamis
- `resources/views/layouts/app.blade.php` - Perbarui judul untuk menggunakan nama aplikasi dinamis
- `resources/views/layouts/navigation.blade.php` - Perbarui header untuk menggunakan nama cafe dinamis
- `resources/views/welcome.blade.php` - Perbarui untuk menggunakan nama cafe dinamis
- `.env` - Perbarui nama database, nama aplikasi, dan url aplikasi

### Detail Teknis
- **Autentikasi**: Pengguna sekarang bisa login menggunakan username atau email
- **Database**: Kolom username unik dan wajib untuk semua pengguna
- **Pengalaman Pengguna**: Formulir registrasi sekarang secara jelas membutuhkan username untuk pembuatan akun
- **Layout Mobile**: Halaman sekarang tampil dalam format wadah mobile di semua perangkat
- **Desain Responsif**: Menjaga tampilan aplikasi mobile sambil tetap responsif
- **Penamaan Dinamis**: Nama aplikasi sekarang berasal dari pengaturan database, bisa diubah lewat panel admin
- **Variabel Global**: Variabel cafeName dan appName sekarang tersedia di semua view
- **Implementasi Aman**: Penanganan error di AppServiceProvider untuk mencegah crash saat tabel pengaturan belum tersedia
- **Database**: Menggunakan MySQL dengan nama database `aplikasi-cafe`

### Catatan Migrasi
Untuk menerapkan perubahan ini:
1. Perbarui server MySQL Anda untuk menyertakan database bernama `aplikasi-cafe`
2. Jalankan migrasi: `php artisan migrate` (termasuk migrasi username)
3. Bersihkan cache konfigurasi: `php artisan config:cache`
4. Bersihkan cache view: `php artisan view:clear`

## [Previous - Order Cancellation] - 2025-10-31

### Bug Fixes (Latest)
- **Fixed**: Product images now display correctly in all order views
  - Admin order detail view (`resources/views/admin/orders/show.blade.php`)
  - Student order list view (`resources/views/orders/index.blade.php`)
  - Student order detail view (`resources/views/orders/show.blade.php`)
  - Changed from `asset('storage/' . $image)` to `asset($image)`
  - Database stores images as `images/products/filename.jpg` (not `storage/images/products/filename.jpg`)
  - All image paths now consistent across the application

### Added
- **Order Cancellation System**: Complete order and item cancellation functionality
  - Cancel entire orders with reason tracking
  - Cancel individual order items with reason tracking
  - Automatic stock return when items/orders are cancelled
  - Cancellation timestamp tracking
  - Modal dialogs for cancellation with reason input

- **Enhanced Admin Order Management**:
  - Quick status update buttons for orders
  - Visual status indicators with gradient colors
  - Cancel order button with reason modal
  - Cancel individual item button with reason modal
  - Cancellation information display on order details

### Changed
- **Admin Orders Index**: Redesigned for mobile-first compact layout
  - Card-based order list instead of table
  - Gradient statistics cards (2-column grid)
  - Compact filter section
  - Improved mobile navigation
  - Shows cancelled status badge

- **Admin Order Detail View**: Complete redesign
  - **Fixed**: Product images now display correctly (using `asset('storage/' . $image)`)
  - Mobile-friendly compact design
  - Quick status update buttons
  - Cancellation info banner when order is cancelled
  - Individual item cancellation buttons
  - Visual indication of cancelled items (opacity reduced)
  - Gradient status card based on order status

### Modified Files
- `resources/views/admin/orders/index.blade.php` - Complete redesign for mobile
- `resources/views/admin/orders/show.blade.php` - Complete redesign with cancellation features
- `app/Http/Controllers/OrderController.php` - Added cancelOrder() and cancelOrderItem() methods
- `app/Models/Order.php` - Added cancellation fields to fillable and casts
- `app/Models/OrderItem.php` - Added cancellation fields to fillable and casts
- `routes/web.php` - Added cancel order and cancel item routes

### New Files
- `database/migrations/2025_10_31_014930_add_cancellation_fields_to_orders_and_order_items.php`

### Technical Details
- **Database**: Added `is_cancelled`, `cancellation_reason`, and `cancelled_at` to orders and order_items tables
- **Stock Management**: Automatically returns stock when orders or items are cancelled
- **Order Total**: Automatically recalculates total when individual items are cancelled
- **Auto-cancellation**: Orders are automatically marked as cancelled if all items are cancelled
- **Validation**: Prevents cancellation of completed orders or already cancelled items

### Bug Fixes
- **Fixed**: Product images not showing in order detail page (admin/orders/show)
  - Changed from `asset($image)` to `asset('storage/' . $image)`
  - Images now properly reference the storage path

### Migration Notes
To apply these changes:
```bash
php artisan migrate
```

This will add cancellation tracking fields to orders and order_items tables.

## [Previous Release] - 2025-10-30

### Added
- **Settings Module**: Complete settings management system for admin
  - Settings model with caching support (`app/Models/Setting.php`)
  - Settings controller with CRUD operations (`app/Http/Controllers/Admin/SettingController.php`)
  - Settings migration with default values (`database/migrations/2025_10_30_222116_create_settings_table.php`)

- **Settings Views**: Three new views for settings management
  - Settings index page (`resources/views/admin/settings/index.blade.php`)
  - Website settings page (`resources/views/admin/settings/website.blade.php`)
  - Customer management page (`resources/views/admin/settings/customers.blade.php`)

- **Website Settings Features**:
  - Cafe name configuration
  - Cafe description
  - Address and phone number
  - Operating hours
  - Maximum orders per day per student
  - Enable/disable ordering system toggle

- **Customer Management Features**:
  - View all registered students/customers
  - Display customer statistics (total orders per customer)
  - Delete customer accounts with confirmation
  - Pagination support for large customer lists

### Changed
- **Mobile Navigation**: Updated bottom navigation menu (`resources/views/layouts/navigation.blade.php`)
  - Separated admin and student navigation menus
  - Admin menu now shows: Home, Produk, Pesanan, Pengaturan
  - Student menu remains: Home, Menu, Keranjang, Pesanan
  - Added settings icon to admin navigation

### Modified Files
- `resources/views/layouts/navigation.blade.php` - Updated mobile menu for admin/student role differentiation
- `routes/web.php` - Added settings routes for admin
- `.gitignore` - Updated for better Laravel project management

### New Files
- `app/Models/Setting.php`
- `app/Http/Controllers/Admin/SettingController.php`
- `database/migrations/2025_10_30_222116_create_settings_table.php`
- `resources/views/admin/settings/index.blade.php`
- `resources/views/admin/settings/website.blade.php`
- `resources/views/admin/settings/customers.blade.php`
- `CHANGELOG.md`

### Technical Details
- **Database**: New `settings` table with key-value structure supporting different data types (text, number, boolean, json)
- **Caching**: Settings are cached for 1 hour to improve performance
- **Validation**: Form validation for all setting inputs
- **Security**: Settings management only accessible to admin role via middleware
- **UX**: Mobile-friendly responsive design with gradient cards and intuitive icons

### Migration Notes
To apply these changes:
```bash
php artisan migrate
```

This will create the settings table and populate it with default values.
