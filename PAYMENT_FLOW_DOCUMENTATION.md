# Payment Flow & Admin Approval System

## Overview
Sistem pembayaran yang lengkap dengan approval real-time oleh admin. User dapat melihat status pembayaran mereka berubah secara langsung setelah admin melakukan verifikasi.

---

## 📋 Complete Flow Diagram

```
USER SIDE                           ADMIN SIDE
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

1. User pilih program
   └─> Klik "Beli Sekarang"
   
2. Form Order                       
   └─> Input catatan (optional)
   └─> Submit order
   
3. Pilih Metode Pembayaran
   ├─> Bank Transfer
   ├─> E-Wallet
   └─> QRIS
   
4. Upload Bukti Pembayaran          ┌──────────────────────┐
   └─> Upload foto                  │  Admin Dashboard     │
   └─> Submit                       │  Payment List        │
                                    │  [Real-time Update]  │
5. Success Page                     └──────────────────────┘
   └─> Status: "Menunggu Verifikasi"        │
                                             │
6. Pesanan Saya                              ▼
   └─> Status: ⏳ Pending            Admin klik "Lihat Bukti"
                                             │
                                             ▼
                                    ┌──────────────────────┐
                                    │  Payment Detail      │
                                    │  - User info         │
                                    │  - Order info        │
                                    │  - Bukti pembayaran  │
                                    └──────────────────────┘
                                             │
                                    ┌────────┴────────┐
                                    │                 │
                                APPROVE          REJECT
                                    │                 │
                                    ▼                 ▼
7. Pesanan Saya                 Payment: paid    Payment: rejected
   └─> Status: ✓ LUNAS!         Order: processing  Order: cancelled
   └─> Tombol "Akses Layanan"   
                                User dapat akses  User upload ulang
```

---

## 🔄 Real-time Connection

### User → Admin (Real-time)
1. **User upload bukti pembayaran** → Langsung masuk database
2. **Admin refresh halaman** `/admin/payments` → Melihat payment baru dengan status "Pending"
3. Admin dapat langsung action tanpa delay

### Admin → User (Real-time)
1. **Admin approve/reject payment** → Update database
2. **User refresh halaman** `/pesanan-saya` → Melihat status baru
3. Status badge berubah otomatis:
   - `⏳ Menunggu Verifikasi` → `✓ Lunas` (jika approved)
   - `⏳ Menunggu Verifikasi` → `✗ Ditolak` (jika rejected)

---

## 🗂️ Database Schema

### Orders Table
```php
- order_number (string, unique) // ORD-20251007-ABC123
- user_id (foreign key)
- program_id (foreign key)
- amount (decimal)
- status (enum: pending, processing, completed, cancelled)
- notes (text, nullable) // Catatan dari user
```

### Payments Table
```php
- order_id (foreign key, unique)
- payment_method (enum: bank_transfer, ewallet, qris)
- amount (decimal)
- status (enum: pending, paid, rejected)
- proof_url (string) // storage/payment-proofs/xxx.jpg
- paid_at (datetime, nullable) // Waktu admin approve
- notes (text, nullable) // Catatan admin (alasan reject)
```

---

## 🎯 Status Flow

### Order Status
```
pending ──────> processing ──────> completed
   │                                    
   └─────────> cancelled (jika payment rejected)
```

### Payment Status
```
pending ──┬──> paid (admin approve)
          │
          └──> rejected (admin reject)
```

---

## 🔐 Routes & Controllers

### User Routes (Auth Required)
```php
GET  /order/{slug}                → OrderController@create
POST /order                       → OrderController@store
GET  /order/{orderNumber}/payment → OrderController@payment
POST /order/{orderNumber}/payment → OrderController@processPayment
GET  /order/{orderNumber}/success → OrderController@success
GET  /pesanan-saya                → OrderController@myOrders
```

### Admin Routes (Admin Middleware)
```php
GET  /admin/payments              → AdminPaymentController@index
GET  /admin/payments/{id}         → AdminPaymentController@show
POST /admin/payments/{id}/approve → AdminPaymentController@approve
POST /admin/payments/{id}/reject  → AdminPaymentController@reject
GET  /admin/payments/{id}/proof   → AdminPaymentController@viewProof
```

---

## 📊 Admin Dashboard Statistics

```php
$stats = [
    'pending' => Count pembayaran pending,
    'pending_amount' => Total Rp pembayaran pending,
    'confirmed_this_month' => Jumlah approved bulan ini,
    'confirmed_amount_this_month' => Total Rp approved bulan ini,
    'total_revenue' => Total pendapatan all time
];
```

---

## 🔍 Admin Features

### 1. Payment List (`/admin/payments`)
- ✅ Table dengan data real-time dari database
- ✅ Filter by status (pending, paid, rejected)
- ✅ Filter by date
- ✅ Pagination (20 per page)
- ✅ Summary cards (pending, confirmed, total revenue)

### 2. Payment Detail Modal
- ✅ Informasi order lengkap
- ✅ Informasi user (nama, email, phone)
- ✅ Metode pembayaran
- ✅ Bukti pembayaran (dapat diperbesar)
- ✅ Catatan dari user (jika ada)
- ✅ Tombol Approve/Reject

### 3. Approve Payment
```php
// Update payment
status: pending → paid
paid_at: now()
notes: "Pembayaran diverifikasi oleh admin"

// Update order
status: pending → processing
```

### 4. Reject Payment
```php
// Update payment
status: pending → rejected
notes: [alasan dari admin]

// Update order
status: pending → cancelled
```

---

## 🎨 User Interface Features

### Pesanan Saya (`/pesanan-saya`)
- ✅ List semua orders user
- ✅ Status badge dengan warna:
  - 🟡 Yellow: Menunggu Verifikasi
  - 🟢 Green: Lunas
  - 🔴 Red: Ditolak
  - ⚪ Gray: Belum Bayar
- ✅ Action buttons:
  - "Lanjut Bayar" (jika belum upload)
  - "Upload Ulang" (jika rejected)
  - "Akses Layanan" (jika paid)
  - "Hubungi Admin" (selalu ada)

### Success Page (`/order/{orderNumber}/success`)
- ✅ Icon animasi centang
- ✅ Detail order lengkap
- ✅ Next steps instructions
- ✅ Tombol ke "Layanan Saya"

---

## ⚡ Testing Flow

### Test 1: User Order Flow
```bash
1. Login sebagai user
2. Klik "Beli Sekarang" di halaman program
3. Submit form order
4. Pilih metode pembayaran
5. Upload bukti pembayaran (gambar)
6. Cek halaman "Pesanan Saya" → Status: ⏳ Pending
```

### Test 2: Admin Approval Flow
```bash
1. Login sebagai admin (email: admin@bimblefarmasi.com)
2. Buka /admin/payments
3. Lihat payment baru di list (status: Pending)
4. Klik "Lihat Bukti"
5. Review bukti pembayaran
6. Klik "Setujui Pembayaran"
7. Payment status → Paid
8. Order status → Processing
```

### Test 3: User See Approved Payment
```bash
1. Login kembali sebagai user
2. Buka halaman "Pesanan Saya"
3. Refresh page
4. Status berubah: ⏳ Pending → ✓ Lunas
5. Tombol berubah: "Menunggu verifikasi" → "Akses Layanan"
```

### Test 4: Admin Reject Flow
```bash
1. Admin buka payment detail
2. Klik "Tolak Pembayaran"
3. Input alasan (contoh: "Bukti tidak jelas")
4. Submit
5. Payment status → Rejected
6. Order status → Cancelled
7. User refresh → Status: ✗ Ditolak
8. User klik "Upload Ulang" → Kembali ke payment page
```

---

## 🛡️ Security & Validation

### Upload Validation
```php
'proof' => [
    'required',
    'image',           // Harus gambar
    'max:2048'         // Max 2MB
]
```

### Authorization
- User hanya bisa lihat ordernya sendiri
- Admin harus punya `is_admin = 1`
- Middleware `auth` untuk user routes
- Middleware `admin` untuk admin routes

---

## 📁 File Structure

```
app/
├── Http/Controllers/
│   ├── OrderController.php          # User order & payment
│   └── Admin/
│       └── AdminPaymentController.php # Admin approval

app/Models/
├── Order.php                        # Order model + relationships
├── Payment.php                      # Payment model
├── Program.php                      # Program model
└── User.php                         # User model

resources/views/
├── pages/order/
│   ├── create.blade.php            # Form order
│   ├── payment.blade.php           # Upload bukti
│   ├── success.blade.php           # Success page
│   └── my-orders.blade.php         # List orders user
└── admin/payments/
    ├── index.blade.php             # Admin payment list
    └── show.blade.php              # Payment detail modal

storage/app/public/
└── payment-proofs/                 # Folder bukti pembayaran
    ├── xxx.jpg
    └── yyy.png
```

---

## ✅ Features Implemented

### ✅ USER SIDE
- [x] Complete order flow (create → payment → success)
- [x] Upload bukti pembayaran dengan validasi
- [x] Real-time status di "Pesanan Saya"
- [x] Upload ulang jika ditolak
- [x] Button akses layanan jika approved
- [x] Catatan untuk admin (optional)

### ✅ ADMIN SIDE
- [x] Dashboard pembayaran real-time dari database
- [x] Filter by status & date
- [x] Statistics cards (pending, confirmed, revenue)
- [x] Modal detail pembayaran
- [x] View bukti pembayaran full-size
- [x] Approve payment (update order & payment status)
- [x] Reject payment dengan alasan
- [x] Pagination untuk banyak data

### ✅ SYSTEM
- [x] Database relationships (User → Order → Payment)
- [x] Order number generator (ORD-20251007-ABC123)
- [x] File upload ke storage/public
- [x] Transaction safety (DB::beginTransaction)
- [x] Middleware protection (auth, admin)
- [x] Success/error flash messages

---

## 🚀 Next Steps (Optional Enhancements)

1. **Email Notifications**
   - Send email ketika payment approved/rejected
   - Send email reminder jika pending > 24 jam

2. **WhatsApp Integration**
   - Auto message ke admin saat ada payment baru
   - Notif ke user saat approved/rejected

3. **Auto Reject**
   - Cron job: reject payment jika pending > 3 hari

4. **Export Reports**
   - Export payment history ke Excel/PDF
   - Monthly revenue reports

5. **Advanced Filters**
   - Filter by program
   - Filter by date range
   - Search by user name/email

---

## 📝 Notes

- Storage link sudah dibuat: `php artisan storage:link`
- Payment proof disimpan di: `storage/app/public/payment-proofs/`
- URL akses: `{{ asset('storage/payment-proofs/xxx.jpg') }}`
- Admin default: admin@bimblefarmasi.com / Admin123!

---

## 🎉 Result

**User dan Admin sudah terhubung secara real-time!**

✅ User upload → langsung masuk database → Admin langsung bisa lihat
✅ Admin approve → update database → User refresh langsung lihat status baru
✅ Tidak ada delay, semua real-time via database
✅ Payment flow lengkap dari awal sampai approved/rejected

---

**Created:** October 7, 2025
**System:** Bimble Farmasi 2.0
**Flow:** User Order → Payment → Admin Approval → Real-time Status Update
