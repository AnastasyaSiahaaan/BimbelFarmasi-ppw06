# Fix Upload Bukti Pembayaran

## 🔧 Masalah yang Diperbaiki
User tidak bisa upload bukti pembayaran di halaman payment. Error menunjukkan "Bukti pembayaran wajib diupload" meskipun file sudah dipilih.

## 🎯 Solusi yang Diterapkan

### 1. **Perbaikan HTML Form (payment.blade.php)**

#### ❌ Masalah Lama:
- Input file dibungkus dalam label yang nested, membuat klik tidak reliable
- Tidak ada validasi client-side untuk file type dan size
- Preview image kurang informatif

#### ✅ Perbaikan:
```blade
<!-- Upload area yang lebih baik -->
<div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-[#2D3C8C] transition-colors cursor-pointer" 
     onclick="document.getElementById('proof-input').click()">
    <input type="file" 
           name="proof" 
           accept="image/*,image/png,image/jpeg,image/jpg" 
           class="hidden" 
           id="proof-input" 
           onchange="previewImage(event)" 
           required>
    <!-- Preview and placeholder -->
</div>
```

**Perubahan kunci:**
- `onclick` pada div container untuk trigger file input
- `accept` attribute lebih spesifik dengan multiple MIME types
- `required` attribute untuk validasi HTML5
- Menampilkan nama file dan ukuran setelah dipilih

### 2. **Perbaikan JavaScript (Preview Function)**

#### ❌ Masalah Lama:
```javascript
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('preview-container').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
```

#### ✅ Perbaikan:
```javascript
function previewImage(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const fileNameDisplay = document.getElementById('file-name');
    
    if (file) {
        // Validate file type
        if (!file.type.match('image.*')) {
            alert('File harus berupa gambar!');
            event.target.value = '';
            return;
        }
        
        // Validate file size (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file maksimal 2MB!');
            event.target.value = '';
            return;
        }
        
        // Show preview with file info
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.classList.remove('hidden');
            uploadPlaceholder.classList.add('hidden');
            fileNameDisplay.textContent = '✓ File: ' + file.name + ' (' + (file.size / 1024).toFixed(2) + ' KB)';
        }
        reader.readAsDataURL(file);
    }
}
```

**Fitur baru:**
- ✅ Validasi tipe file sebelum upload
- ✅ Validasi ukuran file (max 2MB)
- ✅ Menampilkan nama file dan ukuran
- ✅ Clear error handling dengan alert
- ✅ Reset input jika file invalid

### 3. **Perbaikan Controller (OrderController.php)**

#### ❌ Masalah Lama:
```php
$validated = $request->validate([
    'payment_method' => ['required', 'in:bank_transfer,ewallet,qris'],
    'proof' => ['required', 'image', 'max:2048'],
]);

$proofPath = $request->file('proof')->store('payment-proofs', 'public');
```

#### ✅ Perbaikan:
```php
$validated = $request->validate([
    'payment_method' => ['required', 'in:bank_transfer,ewallet,qris'],
    'proof' => ['required', 'file', 'mimes:jpeg,jpg,png', 'max:2048'],
], [
    'proof.required' => 'Bukti pembayaran wajib diupload.',
    'proof.file' => 'File bukti pembayaran tidak valid.',
    'proof.mimes' => 'File harus berupa gambar (JPG, JPEG, atau PNG).',
    'proof.max' => 'Ukuran file maksimal 2MB.',
]);

try {
    $proofPath = $request->file('proof')->store('payment-proofs', 'public');
    
    Payment::updateOrCreate(
        ['order_id' => $order->id],
        [
            'payment_method' => $validated['payment_method'],
            'amount' => $order->amount,
            'status' => 'pending',
            'proof_url' => $proofPath,
        ]
    );
    
    return redirect()->route('order.success', $orderNumber)
        ->with('success', 'Bukti pembayaran berhasil diupload!');
} catch (\Exception $e) {
    return redirect()->back()
        ->withInput()
        ->withErrors(['proof' => 'Gagal mengupload. Error: ' . $e->getMessage()]);
}
```

**Perubahan kunci:**
- Menggunakan `'file'` dan `'mimes:jpeg,jpg,png'` lebih spesifik daripada `'image'`
- Custom error messages untuk setiap validasi
- Try-catch block untuk error handling
- Menampilkan pesan error spesifik jika upload gagal

### 4. **Perbaikan Permission Folder**

```powershell
icacls "storage\app\public\payment-proofs" /grant Everyone:F /T
```

Memastikan folder `payment-proofs` memiliki write permission yang cukup.

## 📋 Checklist Verifikasi

- [x] Form memiliki `enctype="multipart/form-data"`
- [x] Input file memiliki `name="proof"` yang sesuai dengan controller
- [x] Input file memiliki `accept` attribute untuk filter file
- [x] JavaScript validasi file type dan size di client-side
- [x] Controller validasi file type dan size di server-side
- [x] Error handling dengan try-catch
- [x] Custom error messages yang jelas
- [x] Folder `storage/app/public/payment-proofs` memiliki write permission
- [x] Symlink `public/storage` sudah dibuat (`php artisan storage:link`)
- [x] Preview image berfungsi dengan baik
- [x] Menampilkan informasi file yang dipilih

## 🧪 Cara Testing

1. **Jalankan aplikasi:**
   ```bash
   php artisan serve
   ```

2. **Buat order baru:**
   - Login sebagai user
   - Pilih program dan buat order
   - Akan redirect ke halaman payment

3. **Test upload:**
   - Pilih metode pembayaran
   - Klik area upload
   - Pilih file gambar (JPG/PNG, max 2MB)
   - Preview akan muncul
   - Nama file dan ukuran akan ditampilkan
   - Klik "Kirim Bukti Pembayaran"

4. **Test validasi:**
   - Coba upload file non-image → akan muncul alert
   - Coba upload file > 2MB → akan muncul alert
   - Coba submit tanpa pilih file → error "Bukti pembayaran wajib diupload"
   - Coba submit tanpa pilih metode → error "Metode pembayaran wajib dipilih"

## 📁 File yang Diubah

1. `resources/views/pages/order/payment.blade.php`
   - Perbaikan struktur HTML upload area
   - Perbaikan JavaScript preview function
   - Tambahan validasi client-side

2. `app/Http/Controllers/OrderController.php`
   - Perbaikan validasi rules
   - Tambahan try-catch error handling
   - Custom error messages

## 🎨 UI/UX Improvements

1. **Klik area lebih responsif** - Seluruh area dashed border bisa diklik
2. **Validasi real-time** - Alert langsung muncul jika file invalid
3. **Preview yang lebih baik** - Menampilkan gambar, nama file, dan ukuran
4. **Visual feedback** - Border berubah warna saat hover
5. **Error message jelas** - Pesan error spesifik untuk setiap masalah

## 🔍 Troubleshooting

### Problem: "Bukti pembayaran wajib diupload" meskipun sudah pilih file

**Solusi:**
1. Pastikan form memiliki `enctype="multipart/form-data"`
2. Periksa console browser untuk JavaScript error
3. Clear cache: `php artisan cache:clear`
4. Restart PHP server

### Problem: File gagal di-upload ke storage

**Solusi:**
1. Periksa permission folder: `storage/app/public/payment-proofs`
2. Pastikan symlink sudah dibuat: `php artisan storage:link`
3. Periksa log Laravel: `storage/logs/laravel.log`

### Problem: Preview image tidak muncul

**Solusi:**
1. Periksa JavaScript console untuk error
2. Pastikan browser support FileReader API
3. Coba dengan browser berbeda

## ✅ Status

**FIXED** - Upload bukti pembayaran sekarang berfungsi dengan baik dengan validasi yang lebih robust dan user experience yang lebih baik.

---

**Tanggal Fix:** 13 November 2025
**Version:** 1.0
