# ⚡ QUICK REFERENCE - MAINTENANCE GUIDE

## 🔧 COMMON TASKS

### 1. **Menambah Halaman Baru dengan SEO**

```blade
@extends('layouts.app')

@section('title', 'Judul Halaman')

@section('meta_description', 'Deskripsi lengkap untuk SEO (155-160 karakter)')

@section('meta_keywords', 'keyword1, keyword2, keyword3, keyword4')

@section('og_title', 'Judul untuk Social Media Share')

@section('og_description', 'Deskripsi untuk preview di Facebook/LinkedIn')

@section('og_image', asset('images/custom-og-image.jpg'))

@section('content')
    <!-- Konten halaman Anda -->
@endsection
```

---

### 2. **Menambah Success/Error Message**

**Di Controller:**
```php
// Success
return redirect()->back()->with('success', 'Data berhasil disimpan!');

// Error
return redirect()->back()->with('error', 'Terjadi kesalahan. Coba lagi.');

// Dengan input tetap
return redirect()->back()
    ->with('error', 'Validasi gagal')
    ->withInput();
```

**Toast akan muncul otomatis!** ✨

---

### 3. **Form dengan Loading State**

**Standard Form (dengan loading):**
```blade
<form method="POST" action="{{ route('submit.form') }}">
    @csrf
    <!-- Form fields -->
    <button type="submit">Submit</button>
</form>
```

**Form tanpa Loading (jika perlu):**
```blade
<form method="POST" action="..." data-no-loading>
    @csrf
    <!-- Form fields -->
</form>
```

---

### 4. **Validation dengan Error Messages**

**Di Blade:**
```blade
<input 
    type="text" 
    name="name" 
    value="{{ old('name') }}"
    class="@error('name') border-red-500 @enderror"
    required
>

@error('name')
    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
@enderror
```

**Di Controller:**
```php
$validated = $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:users,email',
    'phone' => 'nullable|string|max:20',
]);
```

---

### 5. **Styling Consistency**

**Buttons:**
```blade
<!-- Primary Button -->
<button class="w-full rounded-full bg-[#2D3C8C] px-6 py-3 font-semibold text-white transition hover:bg-blue-900">
    Button Text
</button>

<!-- Secondary Button -->
<button class="w-full rounded-full border-2 border-[#2D3C8C] px-6 py-3 font-semibold text-[#2D3C8C] transition hover:bg-blue-50">
    Button Text
</button>
```

**Input Fields:**
```blade
<input 
    type="text"
    class="mt-2 w-full rounded-2xl border border-blue-100 bg-white px-4 py-3 text-sm text-slate-700 focus:border-[#2D3C8C] focus:outline-none focus:ring-2 focus:ring-blue-200"
>
```

**Cards:**
```blade
<div class="rounded-3xl border border-blue-100 bg-white p-8 shadow-lg">
    <!-- Card content -->
</div>
```

---

### 6. **Navigation Active State**

```blade
<a 
    href="{{ route('home') }}" 
    class="@if(request()->routeIs('home')) font-semibold text-white @else text-white/80 hover:text-white @endif transition"
>
    Beranda
</a>
```

---

### 7. **Responsive Grid Layouts**

**2 Columns:**
```blade
<div class="grid gap-8 md:grid-cols-2">
    <div>Column 1</div>
    <div>Column 2</div>
</div>
```

**3 Columns:**
```blade
<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    <div>Column 1</div>
    <div>Column 2</div>
    <div>Column 3</div>
</div>
```

---

### 8. **Icons dengan Heroicons**

```blade
<!-- Checkmark -->
<svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>

<!-- X Mark -->
<svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
</svg>

<!-- Spinner -->
<svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
</svg>
```

---

## 🎨 DESIGN SYSTEM

### **Colors:**
- Primary: `#2D3C8C` (Navy Blue)
- Primary Hover: `blue-900`
- Background: `#F7F9FF` (Light Blue)
- Text Dark: `slate-800`, `gray-900`
- Text Light: `gray-600`, `slate-700`
- Success: `green-600`, `green-50`
- Error: `red-600`, `red-50`

### **Spacing:**
- Section Padding: `py-16` atau `py-20`
- Card Padding: `p-6` atau `p-8`
- Input Padding: `px-4 py-3`
- Button Padding: `px-6 py-3`
- Gap: `gap-4`, `gap-6`, `gap-8`

### **Border Radius:**
- Buttons: `rounded-full`
- Inputs: `rounded-2xl`
- Cards: `rounded-3xl`
- Pills/Badges: `rounded-full`
- Modals: `rounded-2xl`

### **Shadows:**
- Light: `shadow-sm`
- Medium: `shadow-lg`
- Heavy: `shadow-2xl`
- Custom: `shadow-soft` (defined in CSS)

### **Typography:**
- Font: `Poppins`
- Heading: `font-bold` atau `font-semibold`
- Body: `font-normal`
- Small: `text-sm`
- Regular: `text-base`
- Large: `text-lg`
- XL: `text-xl`, `text-2xl`, `text-3xl`, `text-4xl`

---

## 🚀 DEPLOYMENT CHECKLIST

### **Before Deploy:**
- [ ] Test all forms locally
- [ ] Check all links work
- [ ] Verify responsive design
- [ ] Test on multiple browsers
- [ ] Check console for errors
- [ ] Validate SEO meta tags
- [ ] Compress images (<100KB each)
- [ ] Update .env for production
- [ ] Set APP_DEBUG=false
- [ ] Set APP_ENV=production

### **After Deploy:**
- [ ] Test live URL
- [ ] Submit sitemap to Google
- [ ] Test contact form with real email
- [ ] Check SSL certificate
- [ ] Test page load speed
- [ ] Verify OG images show on social
- [ ] Setup Google Analytics (optional)
- [ ] Monitor error logs

---

## 🔍 DEBUG TIPS

### **Toast Not Working:**
```javascript
// Add to console
console.log('Alpine loaded:', typeof Alpine !== 'undefined');

// Check session
{{ session('success') }} // In blade
```

### **Loading Stuck:**
```javascript
// Add to form
console.log('Form submitting...');

// Check overlay
document.getElementById('loading-overlay').classList.add('hidden');
```

### **CSS Not Applied:**
```html
<!-- Check in Network tab -->
- Tailwind CDN loaded? ✓
- No 404 errors? ✓
- AdBlocker disabled? ✓
```

---

## 📱 RESPONSIVE BREAKPOINTS

```
sm:  640px  (Mobile Landscape)
md:  768px  (Tablet)
lg:  1024px (Desktop)
xl:  1280px (Large Desktop)
2xl: 1536px (Extra Large)
```

**Usage:**
```blade
<div class="text-sm md:text-base lg:text-lg">
    Responsive text size
</div>
```

---

## 🔐 SECURITY TIPS

1. **Always use @csrf:**
   ```blade
   <form method="POST">
       @csrf
       <!-- ... -->
   </form>
   ```

2. **Sanitize output:**
   ```blade
   {{ $variable }}  <!-- Auto-escaped -->
   {!! $html !!}    <!-- Raw HTML (careful!) -->
   ```

3. **Validate all inputs:**
   ```php
   $validated = $request->validate([
       'email' => 'required|email|max:255',
   ]);
   ```

4. **Use route names:**
   ```blade
   <a href="{{ route('home') }}">Home</a>
   <!-- Not: <a href="/home">Home</a> -->
   ```

---

## 📊 PERFORMANCE TIPS

1. **Lazy load images:**
   ```blade
   <img src="..." loading="lazy">
   ```

2. **Defer scripts:**
   ```blade
   <script defer src="..."></script>
   ```

3. **Minimize inline CSS:**
   - Use Tailwind classes instead

4. **Cache views:**
   ```bash
   php artisan view:cache
   ```

5. **Optimize images:**
   - Use tools like TinyPNG
   - Target: <100KB per image
   - Format: WebP or optimized JPG

---

## 🆘 COMMON ERRORS

### **Error: Route not defined**
```bash
php artisan route:list  # Check available routes
php artisan route:clear # Clear route cache
```

### **Error: Class not found**
```bash
composer dump-autoload
php artisan clear-compiled
```

### **Error: View not found**
```bash
php artisan view:clear
```

### **Error: Session not working**
```bash
php artisan session:table  # If using database sessions
php artisan migrate
```

---

## 💡 BEST PRACTICES

1. ✅ **Always test locally first**
2. ✅ **Use version control (Git)**
3. ✅ **Write descriptive commit messages**
4. ✅ **Keep code DRY (Don't Repeat Yourself)**
5. ✅ **Comment complex logic**
6. ✅ **Follow Laravel conventions**
7. ✅ **Validate user input**
8. ✅ **Handle errors gracefully**
9. ✅ **Keep dependencies updated**
10. ✅ **Document changes**

---

## 📞 NEED HELP?

**Laravel Documentation:** https://laravel.com/docs  
**Tailwind Documentation:** https://tailwindcss.com/docs  
**Alpine.js Documentation:** https://alpinejs.dev/  
**Heroicons:** https://heroicons.com/

---

**Quick Commands:**
```bash
# Start server
php artisan serve

# Clear all caches
php artisan optimize:clear

# Run migrations
php artisan migrate

# Create controller
php artisan make:controller NameController

# Create model
php artisan make:model ModelName -m

# Create middleware
php artisan make:middleware MiddlewareName
```

---

**Status:** ✅ Website Production Ready!  
**Version:** 1.0.0  
**Last Updated:** November 2025

---

*Keep this file handy for quick reference! 📚*
