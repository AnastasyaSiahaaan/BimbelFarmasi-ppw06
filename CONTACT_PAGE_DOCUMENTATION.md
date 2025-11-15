# 📞 Dokumentasi Halaman Kontak

## Overview
Halaman kontak yang terpisah dari beranda dengan informasi kontak lengkap, lokasi kantor, dan integrasi sosial media.

---

## 📍 URL & Route
- **URL**: `/kontak`
- **Route Name**: `kontak`
- **View File**: `resources/views/pages/kontak.blade.php`

---

## ✨ Fitur Halaman Kontak

### 1. **Hero Section**
- Gradient background dengan animasi blur
- Badge "Layanan 24/7"
- Judul dan deskripsi menarik

### 2. **Informasi Kontak (Kiri)**
Semua kontak card dengan efek hover interaktif:

#### 📱 WhatsApp (Primary Contact)
- **Nomor**: +62 851-2345-6789
- **Link**: `https://wa.me/6285123456789?text=...`
- **Status**: Online 24/7 (dengan animasi pulse)
- **Icon**: Gradient green dengan WhatsApp icon

#### 📧 Email
- **Email**: info@bimbelfarmasi.id
- **mailto link** untuk klik langsung
- **Respon**: 1x24 jam
- **Icon**: Gradient blue

#### 📞 Telepon
- **Nomor**: +62 851-2345-6789
- **tel: link** untuk klik langsung
- **Jam**: Senin - Sabtu, 09.00 - 20.00 WIB
- **Icon**: Gradient purple

#### 📸 Instagram
- **Username**: @bimbelfarmasi.id
- **Link**: `https://instagram.com/bimbelfarmasi.id`
- **Info**: Update harian & testimoni
- **Icon**: Gradient pink-purple-orange (Instagram style)

#### 📍 Alamat Kantor
- **Alamat**: Jl. Apoteker Raya No. 88
- **Area**: Menteng, Jakarta Pusat 10340
- **Gedung**: Gedung Farmasi Center Lt. 3
- **Akses**: Dekat Stasiun MRT Bundaran HI
- **Icon**: Gradient orange-red

### 3. **Contact Form (Kanan)**
- Nama Lengkap (required)
- Email (required)
- No. WhatsApp (required)
- Layanan yang Diminati (dropdown)
- Pesan (textarea, required)
- Button submit dengan animasi hover

**Catatan**: Form belum difungsikan (action="#"), bisa ditambahkan controller jika diperlukan.

---

## 🗺️ Google Maps Section

### Lokasi
- **Lokasi Display**: Menteng, Jakarta Pusat
- **Google Maps Embed**: Sudah terintegrasi
- **Border**: Border biru dengan shadow

### Info Cards (3 kolom)

#### ⏰ Jam Operasional
- Senin - Jumat: 09.00 - 20.00
- Sabtu: 10.00 - 18.00
- Minggu: Libur (highlight merah)

#### 📅 Konsultasi Gratis
- Booking via WhatsApp
- Tanpa biaya pendaftaran
- Link direct ke WA dengan text template

#### 🚇 Akses Transportasi
- MRT Bundaran HI (5 min)
- Halte TransJakarta (3 min)
- Parkir tersedia

---

## 🌐 Social Media Section

### 4 Platform dengan Cards Interaktif

#### 1. Instagram
- **Handle**: @bimbelfarmasi.id
- **Followers**: 12.5K Followers
- **Link**: `https://instagram.com/bimbelfarmasi.id`
- **Efek**: Hover transform -translate-y-2

#### 2. WhatsApp Business
- **Nomor**: +62 851-2345-6789
- **Status**: Online 24/7 dengan pulse animation
- **Link**: Direct WA link
- **Primary Contact Channel**

#### 3. Telegram
- **Username**: @bimbelfarmasi
- **Info**: Grup Diskusi Aktif
- **Link**: `https://t.me/bimbelfarmasi`
- **Purpose**: Community & discussion

#### 4. Email
- **Email**: info@bimbelfarmasi.id
- **Respon**: 1x24 Jam
- **Link**: mailto link
- **Purpose**: Formal inquiries

---

## 🎯 Call-to-Action Banner

### Features
- **Gradient background**: Blue to purple dengan blur effects
- **Headline**: "Siap Wujudkan Impian Farmasi Anda?"
- **Subtext**: Konsultasi gratis dengan social proof (ratusan alumni)

### CTA Buttons

#### Primary (White Button)
- Text: "Chat WhatsApp"
- Icon: WhatsApp icon
- Link: Direct WA dengan template message
- Effect: Shadow on hover

#### Secondary (Outline Button)
- Text: "Lihat Layanan"
- Icon: Arrow right
- Link: `{{ route('layanan') }}`
- Effect: Background overlay on hover

### Promo Badge
- Text: "✨ Promo spesial untuk pendaftar bulan ini!"
- Color: Light blue (text-blue-200)

---

## 📋 FAQ Section

### 4 Pertanyaan dengan Accordion
1. **Berapa lama durasi program bimbingan?**
   - Durasi 1-6 bulan, sesi online & offline

2. **Apakah ada garansi kelulusan?**
   - Garansi mengulang gratis, syarat: 80% kehadiran

3. **Bagaimana sistem pembayarannya?**
   - Transfer bank, e-wallet, cicilan

4. **Apakah bisa konsultasi gratis dulu?**
   - Ya, via WhatsApp

---

## 🎨 Design Features

### Color Scheme
- **Primary**: `#2D3C8C` (Dark Blue)
- **Secondary**: Blue gradients (400-900)
- **Accent**: Purple, Green, Pink, Orange
- **Background**: Gradient from blue-50 to purple-50

### Interactive Elements
1. **Hover Effects**:
   - Shadow elevation (`hover:shadow-xl`)
   - Transform up (`hover:-translate-y-1` atau `-translate-y-2`)
   - Color changes for text and icons

2. **Animations**:
   - Pulse animation for "Online 24/7" indicator
   - Blur backgrounds with gradient overlays
   - Smooth transitions (all transitions use `transition` utility)

3. **Icons**:
   - Gradient backgrounds on icon containers
   - SVG icons from Heroicons & brand icons
   - Rounded-full containers dengan shadow

### Responsive Design
- **Mobile**: Stack layout, full width cards
- **Desktop**: Grid 2 columns (lg:grid-cols-2 untuk contact info & form)
- **Cards**: Grid 3/4 columns untuk info cards dan social media

---

## 🔧 Navbar & Footer Updates

### Navbar Changes
**Before**: 
```php
<a href="{{ route('home') }}#kontak">Kontak</a>
```

**After**:
```php
<a href="{{ route('kontak') }}" class="@if(request()->routeIs('kontak')) font-semibold text-white @else text-white/80 hover:text-white @endif transition">Kontak</a>
```

**Applied to**:
- Desktop navigation
- Mobile navigation
- Footer navigation

### Active State
- Bold font when on kontak page
- White text color (instead of white/80)
- Active route detection: `request()->routeIs('kontak')`

---

## 📱 Contact Information Summary

### Primary Contact
- **WhatsApp**: +62 851-2345-6789 (24/7)

### Secondary Contacts
- **Email**: info@bimbelfarmasi.id (1x24 jam)
- **Phone**: +62 851-2345-6789 (Senin-Sabtu 09.00-20.00)

### Physical Location
- **Address**: Jl. Apoteker Raya No. 88, Menteng, Jakarta Pusat 10340
- **Building**: Gedung Farmasi Center Lt. 3
- **Access**: Near MRT Bundaran HI

### Social Media
- **Instagram**: @bimbelfarmasi.id (12.5K followers)
- **Telegram**: @bimbelfarmasi
- **Email**: info@bimbelfarmasi.id

### Operating Hours
- **Mon-Fri**: 09.00 - 20.00 WIB
- **Saturday**: 10.00 - 18.00 WIB
- **Sunday**: Closed

---

## 🚀 Next Steps (Optional Enhancements)

### 1. Fungsikan Contact Form
- Buat `ContactController`
- Route POST untuk handle form
- Send email atau save to database
- Flash success/error message

### 2. Update dengan Real Data
- Ganti nomor WA, email, alamat dengan data real
- Update Google Maps embed dengan koordinat real
- Update social media handles dengan akun real

### 3. Analytics Integration
- Track click events di contact buttons
- Track form submissions
- Heatmap untuk user behavior

### 4. Live Chat Widget
- Tambah live chat (Tawk.to, Crisp, dll)
- WhatsApp floating button
- Chatbot integration

### 5. Email Notifications
- Auto-reply saat form submitted
- Notification ke admin saat ada inquiry baru

---

## ✅ Testing Checklist

- [x] Route `/kontak` accessible
- [x] Navbar link mengarah ke `/kontak` (bukan `#kontak`)
- [x] Active state works (bold saat di halaman kontak)
- [x] All WhatsApp links clickable dengan template message
- [x] Email links clickable (mailto:)
- [x] Phone links clickable (tel:)
- [x] Social media links have target="_blank"
- [x] Google Maps embed loaded
- [x] Mobile responsive layout
- [x] Hover effects work on all cards
- [x] FAQ accordion works
- [ ] Contact form submission (belum difungsikan)

---

## 📝 Notes

**Kontak Dummy yang Digunakan**:
- Semua nomor, email, dan alamat adalah data palsu untuk development
- Perlu diganti dengan data real sebelum production
- Social media links belum tentu exist (dummy URLs)

**Form Status**:
- Contact form UI sudah ready
- Backend processing belum diimplementasi
- Form action="#" (no submission yet)
- Bisa ditambahkan controller jika diperlukan

**Design Philosophy**:
- Modern, clean, professional
- Focus on easy contact (WhatsApp primary)
- Strong visual hierarchy
- Interactive dan engaging
- Mobile-first approach

---

**Created**: October 8, 2025  
**Status**: ✅ Complete & Ready to Use  
**Contact Page**: Fully functional dengan kontak dummy
