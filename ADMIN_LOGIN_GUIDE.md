# 🔐 Admin Login - Bimbel Farmasi 2.0

## Akun Admin Default

Setelah setup database, gunakan kredensial berikut untuk login:

```
Email: admin@bimbelfarmasi.com
Password: password123
```

---

## 🌐 Cara Akses Admin Panel

### 1. Login ke Admin Panel
Buka browser dan kunjungi:
```
http://localhost:8000/admin/login
```

### 2. Masukkan Kredensial
- **Email:** `admin@bimbelfarmasi.com`
- **Password:** `password123`
- Centang "Ingat saya" jika ingin tetap login

### 3. Akses Dashboard
Setelah login berhasil, Anda akan diarahkan ke:
```
http://localhost:8000/admin
```

---

## 🔑 Setup Database & Admin Account

Jika belum menjalankan migration dan seeder, jalankan perintah berikut:

### Step 1: Run Migration
```bash
php artisan migrate
```

### Step 2: Seed Admin Account
```bash
php artisan db:seed --class=AdminSeeder
```

Output yang diharapkan:
```
INFO  Seeding database.

✅ Admin account created successfully!
📧 Email: admin@bimbelfarmasi.com
🔑 Password: password123
```

---

## 🛡️ Sistem Keamanan

### Middleware Protection
Semua halaman admin dilindungi dengan middleware `AdminMiddleware` yang melakukan:
1. ✅ Cek apakah user sudah login
2. ✅ Cek apakah user memiliki role admin (`is_admin = true`)
3. ✅ Redirect ke halaman login jika tidak terautentikasi
4. ✅ Logout otomatis jika bukan admin

### Authentication Flow
```
1. User mengakses /admin/* (protected route)
   ↓
2. Middleware cek authentication
   ↓
3. Jika tidak login → Redirect ke /admin/login
   ↓
4. User login dengan email & password
   ↓
5. Controller validasi credentials
   ↓
6. Cek is_admin = true
   ↓
7. Jika valid → Redirect ke /admin (dashboard)
   ↓
8. Jika bukan admin → Logout & redirect ke login dengan error
```

---

## 📄 Halaman yang Tersedia

### Public (No Authentication)
- ✅ `/admin/login` - Halaman login admin

### Protected (Requires Admin Authentication)
- ✅ `/admin` - Dashboard utama
- ✅ `/admin/students` - Manajemen peserta
- ✅ `/admin/classes` - Manajemen kelas
- ✅ `/admin/questions` - Bank soal
- ✅ `/admin/payments` - Manajemen pembayaran
- ✅ `/admin/statistics` - Laporan & statistik

---

## 🔄 Logout

### Cara Logout:
1. Klik tombol **"Logout"** di sidebar kiri bawah
2. Anda akan diarahkan kembali ke halaman login
3. Session akan dihapus secara otomatis

---

## 👥 Menambah Admin Baru

### Cara Manual via Database
1. Buka database SQLite di `database/database.sqlite`
2. Insert user baru dengan `is_admin = 1`:

```sql
INSERT INTO users (name, email, password, is_admin, email_verified_at, created_at, updated_at)
VALUES (
    'Admin Kedua',
    'admin2@bimbelfarmasi.com',
    '$2y$12$...',  -- hash password
    1,
    NOW(),
    NOW(),
    NOW()
);
```

### Cara via Artisan Tinker
```bash
php artisan tinker
```

Kemudian jalankan:
```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Admin Kedua',
    'email' => 'admin2@bimbelfarmasi.com',
    'password' => Hash::make('password123'),
    'is_admin' => true,
    'email_verified_at' => now(),
]);
```

---

## 🛠️ Technical Details

### Files Created/Modified

**Controllers:**
- `app/Http/Controllers/Admin/AdminAuthController.php`
  - `showLoginForm()` - Tampilkan form login
  - `login()` - Handle login process
  - `logout()` - Handle logout process

**Middleware:**
- `app/Http/Middleware/AdminMiddleware.php`
  - Check authentication & admin role
  - Protect all admin routes

**Views:**
- `resources/views/admin/login.blade.php`
  - Form login dengan validation errors
  - Info default credentials
  - Responsive design

**Migrations:**
- `database/migrations/2025_10_05_054849_add_is_admin_to_users_table.php`
  - Add `is_admin` boolean column to users table

**Seeders:**
- `database/seeders/AdminSeeder.php`
  - Create default admin account

**Models:**
- `app/Models/User.php`
  - Added `is_admin` to fillable & casts

**Routes:**
- `routes/web.php`
  - Added authentication routes (login/logout)
  - Applied `admin` middleware to protected routes

**Config:**
- `bootstrap/app.php`
  - Registered `admin` middleware alias

---

## ✅ Testing

### Test Login Flow
1. Akses http://localhost:8000/admin (tanpa login)
   - Expected: Redirect ke `/admin/login`
   
2. Input credentials yang salah
   - Expected: Error message "Email atau password salah"
   
3. Input credentials yang benar tapi `is_admin = false`
   - Expected: Error message "Anda tidak memiliki akses"
   
4. Input credentials admin yang benar
   - Expected: Redirect ke dashboard `/admin`
   
5. Akses halaman admin lain (students, classes, etc)
   - Expected: Bisa akses semua halaman
   
6. Klik logout
   - Expected: Redirect ke login dengan success message

### Verify Routes
```bash
php artisan route:list --path=admin
```

Expected output: 9 routes (1 login GET, 1 login POST, 1 logout POST, 6 protected pages)

---

## 🚨 Troubleshooting

### Problem: "The page has expired" saat login
**Solution:** Clear browser cache atau regenerate app key:
```bash
php artisan key:generate
```

### Problem: Error "Class 'AdminMiddleware' not found"
**Solution:** Clear config cache:
```bash
php artisan config:clear
php artisan cache:clear
```

### Problem: Redirect loop setelah login
**Solution:** Periksa session configuration di `config/session.php`:
- Pastikan `SESSION_DRIVER` di `.env` adalah `file`
- Clear session files di `storage/framework/sessions/`

### Problem: Password tidak match
**Solution:** Re-seed admin account:
```bash
php artisan migrate:fresh
php artisan db:seed --class=AdminSeeder
```

---

## 📱 Screenshots Flow

### 1. Halaman Login
```
┌─────────────────────────────────────┐
│         🎓 Admin Panel              │
│        Bimbel Farmasi 2.0           │
│                                     │
│  Email: [________________]          │
│  Password: [________________]       │
│  ☐ Ingat saya                       │
│                                     │
│  [   Masuk ke Admin Panel   ]      │
│                                     │
│  🔑 Default Credentials:            │
│  Email: admin@bimbelfarmasi.com    │
│  Password: password123              │
│                                     │
│  ← Kembali ke Beranda               │
└─────────────────────────────────────┘
```

### 2. Dashboard (After Login)
```
┌───────┬─────────────────────────────────┐
│ 🎓    │  Admin Dashboard      [🔔] [👤] │
│ Bimbel├─────────────────────────────────┤
│       │                                 │
│ 🏠 Dashboard → Active                   │
│ 👥 Peserta                              │
│ 📚 Kelas                                │
│ 📝 Soal                                 │
│ 💰 Pembayaran                           │
│ 📊 Statistik                            │
│                                         │
│ [Logout] ← Click here to logout        │
└─────────────────────────────────────────┘
```

---

## 🎉 Summary

✅ **Login Page:** http://localhost:8000/admin/login
✅ **Default Email:** admin@bimbelfarmasi.com
✅ **Default Password:** password123
✅ **Dashboard:** http://localhost:8000/admin
✅ **Protected Routes:** All admin pages require authentication
✅ **Logout Button:** Available in sidebar (bottom)

**Security Features:**
- ✅ Session-based authentication
- ✅ Password hashing with bcrypt
- ✅ Role-based access control (is_admin)
- ✅ CSRF protection on all forms
- ✅ Remember me functionality
- ✅ Automatic logout for non-admin users

Admin panel siap digunakan! 🚀
