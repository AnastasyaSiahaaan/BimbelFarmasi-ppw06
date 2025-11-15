# Joki Tugas - Project-Based Service Update

## Changes Made

### Overview
Joki Tugas telah diubah dari sistem direct purchase menjadi **consultation-based flow** karena sifatnya yang project-based dengan harga dan durasi custom per project.

## Key Differences

### Before (Direct Purchase)
- User langsung beli dengan harga fixed
- Ada durasi (1 bulan) dan sesi (1 pertemuan)
- Sama seperti UKOM dan CPNS

### After (Consultation Flow)
- User request konsultasi gratis dulu
- Harga dan durasi disesuaikan per project
- Tidak ada durasi/sesi fixed
- Tim akan hubungi untuk diskusi detail

## Updated Files

### 1. **joki-tugas.blade.php**
- ✅ Semua button "Beli Sekarang" → "Konsultasi Gratis"
- ✅ Harga display: "Rp950.000" → "Mulai Rp950.000"
- ✅ Link redirect ke halaman Kontak (bukan order page)

### 2. **ProgramSeeder.php**
- ✅ `duration_months`: 1 → **0** (tidak pakai durasi)
- ✅ `total_sessions`: 1 → **0** (tidak pakai sesi)
- ✅ Description updated: menyebutkan "Harga disesuaikan dengan kompleksitas project"
- ✅ Features added: "Harga custom per project" dan "Konsultasi & quote gratis"

### 3. **Migration: create_programs_table.php**
- ✅ `duration_months`: `default(1)` → **nullable()**
- ✅ `total_sessions`: `default(0)` → **nullable()**
- ✅ Comment: "Nullable for project-based services"

### 4. **order/create.blade.php** (Order Form)
- ✅ Conditional display dengan `@if($program->type !== 'joki')`
- ✅ Jika bimbel/cpns: tampilkan durasi & sesi
- ✅ Jika joki: tampilkan notice project-based:
  ```
  ⚠️ Layanan Project-Based
  Harga dan durasi pengerjaan akan disesuaikan dengan 
  kompleksitas tugas Anda. Tim kami akan menghubungi 
  untuk diskusi detail project.
  ```

### 5. **order/success.blade.php** (Success Page)
- ✅ Conditional display program info
- ✅ Jika bimbel/cpns: "Durasi X bulan • Y pertemuan"
- ✅ Jika joki: "Layanan Project-Based • Harga & durasi custom"

### 6. **order/my-orders.blade.php** (Order History)
- ✅ Conditional display order details
- ✅ Jika bimbel/cpns: tampilkan durasi & sesi icons
- ✅ Jika joki: tampilkan badge "📋 Project-Based" dengan text "Harga & durasi custom"

## User Flow Comparison

### UKOM & CPNS (Direct Purchase)
```
1. Lihat detail program
2. Klik "Beli Sekarang"
3. Login (jika belum)
4. Isi form order
5. Pilih metode pembayaran
6. Upload bukti
7. Menunggu verifikasi
8. Akses layanan
```

### Joki Tugas (Consultation Flow)
```
1. Lihat detail program
2. Klik "Konsultasi Gratis"
3. Isi form kontak dengan detail tugas
4. Tim akan hubungi via WhatsApp/Email
5. Diskusi kompleksitas & deadline
6. Terima quotation (harga & durasi)
7. Jika setuju → proses order manual oleh admin
8. Pembayaran & pengerjaan dimulai
```

## Database Schema

### programs Table
```php
'duration_months' => 0,      // NULL untuk joki tugas
'total_sessions' => 0,       // NULL untuk joki tugas
'type' => 'joki',           // Identifier untuk conditional logic
```

### Sample Data
```php
// UKOM
duration_months: 3, total_sessions: 24

// CPNS
duration_months: 4, total_sessions: 32

// Joki Tugas
duration_months: 0, total_sessions: 0  // NULL
```

## Pricing Display

### Service Pages
- **Starter Guidance**: Rp950.000 → **Mulai Rp950.000**
- **Complete Writing**: Rp2.450.000 → **Mulai Rp2.450.000**
- **Publishing Pro**: Rp3.050.000 → **Mulai Rp3.050.000**

"Mulai" indicates starting price, actual price depends on project scope.

## Admin Workflow for Joki Tugas

1. **Receive Consultation Request**
   - User submits form dari halaman Kontak
   - Admin receives notification

2. **Initial Contact**
   - Admin hubungi user via WhatsApp/Email
   - Diskusi detail tugas:
     - Jenis tugas (paper, laporan, TA, jurnal)
     - Jumlah halaman / bab
     - Deadline
     - Kompleksitas topik
     - Referensi yang dibutuhkan

3. **Quotation**
   - Calculate price based on complexity
   - Estimate working days
   - Send quotation to user

4. **Order Creation (Manual by Admin)**
   - If user agrees, admin creates order manually
   - Custom price dapat diinput
   - Notes field untuk detail project

5. **Payment & Execution**
   - User upload payment proof
   - Admin verifies
   - Start working on project
   - Deliver & revision if needed

## Benefits

### For Users
- ✅ Harga transparan sesuai kebutuhan
- ✅ Tidak bayar lebih untuk tugas sederhana
- ✅ Diskusi detail sebelum komitmen
- ✅ Flexible deadline negotiation

### For Business
- ✅ Pricing lebih fair & akurat
- ✅ Avoid under/over pricing
- ✅ Better project management
- ✅ Customer satisfaction (expectation management)

## Testing Checklist

- [x] Joki tugas page buttons redirect to Kontak
- [x] Order form shows project-based notice for joki
- [x] Success page shows correct info for joki
- [x] My Orders shows project-based badge for joki
- [x] Database nullable fields working
- [x] Migration fresh with new schema
- [x] Seeder populates correct data

## Future Enhancements

- [ ] Admin panel: Custom order creation form for joki tugas
- [ ] Quotation system (send quote, user approve, auto-create order)
- [ ] Project milestone tracking
- [ ] File upload for user (send assignment docs)
- [ ] Progress updates (draft review, revision tracking)
- [ ] Deadline reminder notifications

## Notes

⚠️ **Important**: Joki tugas orders should be created MANUALLY by admin after quotation approval. The order system supports this but requires admin intervention.

🔄 **Workflow**: User Request → Admin Contact → Quotation → Manual Order Creation → Payment → Execution

📊 **Analytics**: Track consultation-to-order conversion rate to optimize pricing strategy.
