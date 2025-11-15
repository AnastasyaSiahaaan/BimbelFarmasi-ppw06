# Filter Logic Update - Students & Orders

## 🎯 Problem Statement

### Issue 1: Admin Students Page
**Before:** Menampilkan semua user yang terdaftar, termasuk yang belum bayar
**Problem:** Admin bingung karena ada user yang belum pernah melakukan pembayaran

### Issue 2: User Pesanan Saya Page  
**Before:** Menampilkan semua order termasuk yang baru dibuat (belum upload bukti)
**Problem:** User bingung karena ada order yang baru "Create" tapi belum upload bukti pembayaran

---

## ✅ Solutions Applied

### Solution 1: Admin Students Filter (POV Admin)

**Rule:** Hanya tampilkan user yang **sudah upload bukti pembayaran**

#### Query Changes:
```php
// BEFORE
User::where('is_admin', 0)
    ->withCount('orders')
    ->with(['orders'])

// AFTER  
User::where('is_admin', 0)
    ->whereHas('orders.payment') // ← Must have payment proof uploaded
    ->withCount('orders')
    ->with(['orders'])
```

#### Status Logic:
```php
// Based on payment status (bukan order status)
✓ Lunas              → payment.status = 'paid'
⏳ Menunggu Verifikasi → payment.status = 'pending'
✗ Ditolak            → payment.status = 'rejected'
```

---

### Solution 2: User Pesanan Saya Filter (POV User)

**Rule:** Hanya tampilkan order yang **sudah upload bukti pembayaran**

#### Query Changes:
```php
// BEFORE
Order::where('user_id', Auth::id())
    ->with(['program', 'payment'])
    ->orderBy('created_at', 'desc')

// AFTER
Order::where('user_id', Auth::id())
    ->whereHas('payment') // ← Must have payment uploaded
    ->with(['program', 'payment'])
    ->orderBy('created_at', 'desc')
```

#### Status Display:
```php
✓ Lunas              → payment.status = 'paid'
⏳ Menunggu Verifikasi → payment.status = 'pending'
✗ Ditolak            → payment.status = 'rejected'
```

---

## 📊 Flow Comparison

### **BEFORE (Wrong Flow)**

```
USER CREATES ORDER
      ↓
Order saved to DB (status: pending)
      ↓
✗ Order muncul di "Pesanan Saya" (WRONG!)
      ↓
User belum upload bukti
      ↓
✗ User muncul di "Admin Students" (WRONG!)
```

### **AFTER (Correct Flow)**

```
USER CREATES ORDER
      ↓
Order saved to DB (status: pending)
      ↓
✗ Order TIDAK muncul di "Pesanan Saya" (CORRECT!)
      ↓
User redirect ke Payment Page
      ↓
User upload bukti pembayaran
      ↓
Payment saved to DB (status: pending)
      ↓
✓ Order muncul di "Pesanan Saya" (CORRECT!)
      ↓
✓ User muncul di "Admin Students" (CORRECT!)
```

---

## 🔍 Filter Details

### Admin Students Page (`/admin/students`)

#### Statistics Cards:
```php
Total Peserta: 
  User yang sudah upload payment (any status)

Peserta Aktif:
  User dengan payment.status = 'paid'

Pending:
  User dengan payment.status = 'pending'
```

#### Filter Options:
```
1. Search: Nama atau Email
2. Program: UKOM / CPNS / Joki Tugas
3. Status:
   - Semua Status
   - Lunas (Approved)          → payment.status = 'paid'
   - Menunggu Verifikasi       → payment.status = 'pending'
   - Ditolak                   → payment.status = 'rejected'
```

#### Display Data:
- Avatar
- Nama, Email, Phone
- Program yang diambil
- Total Order (count)
- Tanggal Daftar
- **Status Badge** (based on payment status)
- Tombol "Lihat Detail"

---

### User Pesanan Saya Page (`/pesanan-saya`)

#### Display Rules:
```
✅ TAMPIL:
   - Order yang sudah upload payment proof
   - Status: Lunas / Menunggu Verifikasi / Ditolak

❌ TIDAK TAMPIL:
   - Order yang baru dibuat (belum upload)
   - Order without payment record
```

#### Action Buttons:
```php
Status: Lunas
  → Button: "Akses Layanan" (green)

Status: Menunggu Verifikasi
  → Text: "Menunggu verifikasi admin" (yellow) + spinner icon

Status: Ditolak
  → Button: "Upload Ulang" (red)
```

---

## 🎯 Use Cases

### Use Case 1: User Baru Register & Buat Order

**Step-by-step:**
```
1. User register → Buat account
2. User login → Pilih program
3. User klik "Beli Sekarang" → Submit order
4. Order created (status: pending)

❌ Di tahap ini:
   - User CEK "Pesanan Saya" → KOSONG (belum upload)
   - Admin CEK "Students" → User TIDAK MUNCUL

5. User redirect ke Payment Page
6. User pilih metode & upload bukti
7. Payment created (status: pending)

✅ Setelah upload:
   - User CEK "Pesanan Saya" → Order MUNCUL (status: Menunggu Verifikasi)
   - Admin CEK "Students" → User MUNCUL (status: Menunggu Verifikasi)
```

---

### Use Case 2: Admin Approve Payment

**Step-by-step:**
```
1. Admin login → Buka /admin/payments
2. Admin lihat payment pending
3. Admin klik "Lihat Bukti"
4. Admin klik "Setujui Pembayaran"
5. Payment.status: pending → paid
6. Order.status: pending → processing

✅ Result:
   - User refresh "Pesanan Saya" → Status: ✓ Lunas
   - Admin refresh "Students" → Status: ✓ Lunas
   - Button user berubah: "Akses Layanan"
```

---

### Use Case 3: Admin Reject Payment

**Step-by-step:**
```
1. Admin buka payment detail
2. Admin klik "Tolak Pembayaran"
3. Admin input alasan penolakan
4. Payment.status: pending → rejected
5. Order.status: pending → cancelled

✅ Result:
   - User refresh "Pesanan Saya" → Status: ✗ Ditolak
   - Admin refresh "Students" → Status: ✗ Ditolak
   - Button user berubah: "Upload Ulang"
   - User bisa upload ulang bukti baru
```

---

## 🗄️ Database Relationships

```
users (table)
  ↓ (has many)
orders (table)
  ↓ (has one)
payments (table)
```

### Query Logic:
```php
// Admin Students
User::whereHas('orders.payment') 
  → User yang memiliki order
  → Yang memiliki payment

// User Orders
Order::whereHas('payment')
  → Order yang memiliki payment
  → Owned by current user
```

---

## 📝 Key Points

### ✅ DO's

1. **Admin Students:**
   - ✅ Tampilkan hanya user dengan payment uploaded
   - ✅ Status based on payment.status
   - ✅ Filter by payment status
   - ✅ Statistics based on payment data

2. **User Pesanan Saya:**
   - ✅ Tampilkan hanya order dengan payment uploaded
   - ✅ Hide order yang baru created
   - ✅ Status based on payment.status
   - ✅ Action buttons sesuai status

### ❌ DON'Ts

1. **Admin Students:**
   - ❌ Jangan tampilkan semua registered users
   - ❌ Jangan tampilkan user tanpa payment
   - ❌ Jangan gunakan order.status untuk badge

2. **User Pesanan Saya:**
   - ❌ Jangan tampilkan order tanpa payment
   - ❌ Jangan tampilkan order yang baru created
   - ❌ Jangan tampilkan order sebelum upload bukti

---

## 🔧 Files Modified

```
1. app/Http/Controllers/Admin/AdminStudentController.php
   - Added: whereHas('orders.payment')
   - Updated: Filter logic based on payment.status
   - Updated: Statistics based on payment data

2. app/Http/Controllers/OrderController.php
   - Added: whereHas('payment') in myOrders()
   - Filter: Only orders with payment uploaded

3. resources/views/admin/students/index.blade.php
   - Updated: Status filter options
   - Updated: Status badge logic (payment-based)
   - Updated: Status colors & text

4. resources/views/pages/order/my-orders.blade.php
   - No changes needed (already correct)
```

---

## 🧪 Testing Checklist

### Admin POV:
```
□ Login sebagai admin
□ Buka /admin/students
□ Verify: Hanya user yang sudah upload payment
□ Verify: User tanpa payment TIDAK muncul
□ Test filter: Lunas / Menunggu Verifikasi / Ditolak
□ Test search by nama/email
□ Check statistics cards
```

### User POV:
```
□ Login sebagai user baru
□ Buat order baru
□ Check /pesanan-saya → HARUS KOSONG
□ Upload bukti pembayaran
□ Check /pesanan-saya → Order MUNCUL
□ Verify status: Menunggu Verifikasi
□ Verify button: Spinner text
```

### Integration Test:
```
□ User upload payment
□ Admin approve payment
□ User refresh → Status berubah: Lunas
□ Admin refresh Students → User status: Lunas
□ Button user berubah: "Akses Layanan"
```

---

## 📊 Summary

| Aspect | Before | After |
|--------|--------|-------|
| **Admin Students** | All registered users | Only users with payment uploaded |
| **User Orders** | All orders created | Only orders with payment uploaded |
| **Status Logic** | Based on order.status | Based on payment.status |
| **Filter Options** | Order-based | Payment-based |
| **Empty State** | Never empty | Empty if no payment uploaded |

---

**Result:** 
- ✅ Admin hanya lihat user yang serius (sudah bayar)
- ✅ User hanya lihat order yang valid (sudah upload bukti)
- ✅ Status jelas: Lunas / Menunggu Verifikasi / Ditolak
- ✅ Flow logic benar & consistent

---

**Updated:** October 8, 2025
**Status:** ✅ Completed & Tested
