# Changelog

All notable changes to this project will be documented in this file.

## [Unreleased] - 2025-11-23

### Added
- **Username-based Authentication**: Implementation of username for user login instead of NISN
  - New migration to rename nisn column to username in users table
  - Username field now required during registration
- **Mobile App Layout**: Mobile-first design for login and register pages
  - Responsive layout that maintains mobile app appearance on desktop
  - Centered mobile screen container with rounded corners and shadow
  - Fixed mobile screen size (414px x 892px) for consistent experience
- **User Address Field**: Implementation of alamat field for user profiles
  - New migration to add alamat column to users table
  - Input field added to register form as textarea
  - Validation added for address field (max 500 characters)
  - Updated seeder with example address data

### Changed
- **Authentication System**: Replaced NISN with username for user identification
  - Login form now accepts username or email for authentication
  - Register form now requires username input
  - LoginRequest updated to authenticate with username or email
  - User model updated to use username instead of nisn
  - User seeder updated to use usernames for default accounts
- **Settings-based Application Name**: Implement dynamic application name from database settings
  - Update AppServiceProvider to provide cafeName and appName variables to all views
  - Use View Composer to make settings available globally
  - Error handling for cases when settings table doesn't exist yet
- **Mobile Layout**: Update login and register pages with mobile app format
  - Container layout centered on desktop screen
  - Mobile device-like appearance with rounded corners and shadow
  - Consistent mobile experience regardless of access device

### Changed (Previous Changes)
- **Route**: Changed root route (/) from welcome page to redirect to login page
- **Application Name**: All instances of "Kantin Sekolah" replaced with dynamic $appName/$cafeName variable
  - Login page (`resources/views/auth/login.blade.php`)
  - Register page (`resources/views/auth/register.blade.php`)
  - Guest layout title (`resources/views/layouts/guest.blade.php`)
  - App layout title (`resources/views/layouts/app.blade.php`)
  - Navigation header (`resources/views/layouts/navigation.blade.php`)
  - Welcome page (`resources/views/welcome.blade.php`)
- **Database Configuration**: Changed database name in .env from `aplikasi-kantin` to `aplikasi-cafe`
- **Environment**: Updated APP_NAME from 'Laravel' to 'Aplikasi Cafe' and APP_URL from 'http://kantin.test' to 'http://cafe.test'

### Modified Files
- `app/Models/User.php` - Changed fillable from nisn to username
- `app/Http/Requests/Auth/LoginRequest.php` - Updated authentication to use username
- `app/Http/Controllers/Auth/RegisteredUserController.php` - Updated registration to use username
- `resources/views/auth/login.blade.php` - Updated form labels and placeholders for username and mobile layout
- `resources/views/auth/register.blade.php` - Replaced NISN field with username field and updated mobile layout
- `database/seeders/UserSeeder.php` - Updated default users to use username
- `database/migrations/2025_11_23_094036_rename_nisn_to_username_in_users_table.php` - Migration for changing column
- `app/Providers/AppServiceProvider.php` - Added View Composer for global settings
- `routes/web.php` - Changed root route to redirect to login
- `resources/views/layouts/guest.blade.php` - Updated title to use dynamic app name
- `resources/views/layouts/app.blade.php` - Updated title to use dynamic app name
- `resources/views/layouts/navigation.blade.php` - Updated header to use dynamic cafe name
- `resources/views/welcome.blade.php` - Updated to use dynamic cafe name
- `.env` - Updated database name, app name, and app url

### Technical Details
- **Authentication**: Users can now login using either username or email
- **Database**: Username column is unique and required for all users
- **User Experience**: Register form now clearly requires username for account creation
- **Mobile Layout**: Pages now display in mobile container format on all devices
- **Responsive Design**: Maintains mobile app appearance while being responsive
- **Dynamic Naming**: Application name now comes from database settings, can be changed via admin panel
- **Global Variables**: cafeName and appName variables now available in all views
- **Safe Implementation**: Error handling in AppServiceProvider to prevent crashes when settings table is not yet available
- **Database**: Uses MySQL with database name `aplikasi-cafe`

### Migration Notes
To apply these changes:
1. Update your MySQL server to include a database named `aplikasi-cafe`
2. Run migrations: `php artisan migrate` (includes the username migration)
3. Clear configuration cache: `php artisan config:cache`
4. Clear view cache: `php artisan view:clear`

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
