@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')
    <section class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 py-12">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Pengaturan</h1>
                <p class="mt-2 text-gray-600">Kelola keamanan dan preferensi akun Anda</p>
            </div>

            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-100 border border-green-200 p-4 text-green-800 flex items-center gap-3">
                    <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Change Password Section -->
            <div class="mb-8 rounded-2xl bg-white p-8 shadow-lg">
                <div class="mb-6 flex items-center gap-3">
                    <div class="rounded-full bg-blue-100 p-3">
                        <svg class="h-6 w-6 text-[#2D3C8C]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Ubah Password</h2>
                        <p class="text-sm text-gray-500">Perbarui password Anda secara berkala untuk keamanan</p>
                    </div>
                </div>

                <form action="{{ route('user.password.update') }}" method="POST">
                    @csrf
                    <div class="space-y-5">
                        <!-- Current Password -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Password Saat Ini</label>
                            <input type="password" name="current_password" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:border-[#2D3C8C] focus:outline-none focus:ring-2 focus:ring-blue-200 @error('current_password') border-red-300 @enderror" required>
                            @error('current_password')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Password Baru</label>
                            <input type="password" name="password" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:border-[#2D3C8C] focus:outline-none focus:ring-2 focus:ring-blue-200 @error('password') border-red-300 @enderror" required>
                            @error('password')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
                        </div>

                        <!-- Confirm New Password -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:border-[#2D3C8C] focus:outline-none focus:ring-2 focus:ring-blue-200" required>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="rounded-lg bg-[#2D3C8C] px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-blue-900">
                            Ubah Password
                        </button>
                    </div>
                </form>
            </div>

            <!-- Notifications Section -->
            <div class="mb-8 rounded-2xl bg-white p-8 shadow-lg">
                <div class="mb-6 flex items-center gap-3">
                    <div class="rounded-full bg-purple-100 p-3">
                        <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Notifikasi</h2>
                        <p class="text-sm text-gray-500">Atur preferensi notifikasi Anda</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <label class="flex items-center justify-between rounded-lg border border-gray-200 p-4 transition hover:bg-gray-50">
                        <div>
                            <p class="font-medium text-gray-900">Notifikasi Email</p>
                            <p class="text-sm text-gray-500">Terima update program via email</p>
                        </div>
                        <input type="checkbox" checked class="h-5 w-5 rounded border-gray-300 text-[#2D3C8C] focus:ring-[#2D3C8C]">
                    </label>

                    <label class="flex items-center justify-between rounded-lg border border-gray-200 p-4 transition hover:bg-gray-50">
                        <div>
                            <p class="font-medium text-gray-900">Notifikasi WhatsApp</p>
                            <p class="text-sm text-gray-500">Reminder kelas dan jadwal via WA</p>
                        </div>
                        <input type="checkbox" checked class="h-5 w-5 rounded border-gray-300 text-[#2D3C8C] focus:ring-[#2D3C8C]">
                    </label>

                    <label class="flex items-center justify-between rounded-lg border border-gray-200 p-4 transition hover:bg-gray-50">
                        <div>
                            <p class="font-medium text-gray-900">Promosi & Penawaran</p>
                            <p class="text-sm text-gray-500">Info promo dan diskon khusus</p>
                        </div>
                        <input type="checkbox" class="h-5 w-5 rounded border-gray-300 text-[#2D3C8C] focus:ring-[#2D3C8C]">
                    </label>
                </div>

                <div class="mt-6">
                    <button class="rounded-lg bg-[#2D3C8C] px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-blue-900">
                        Simpan Preferensi
                    </button>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="rounded-2xl border-2 border-red-200 bg-red-50 p-8 shadow-lg">
                <div class="mb-6 flex items-center gap-3">
                    <div class="rounded-full bg-red-100 p-3">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-red-900">Zona Bahaya</h2>
                        <p class="text-sm text-red-700">Tindakan ini tidak dapat dibatalkan</p>
                    </div>
                </div>

                <div class="rounded-lg border border-red-300 bg-white p-6">
                    <h3 class="font-bold text-gray-900">Hapus Akun</h3>
                    <p class="mt-2 text-sm text-gray-600">Setelah akun dihapus, semua data Anda termasuk progres belajar, transaksi, dan akses program akan hilang secara permanen.</p>
                    
                    <button 
                        onclick="openDeleteModal()" 
                        class="mt-4 rounded-lg border-2 border-red-600 bg-white px-6 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-600 hover:text-white">
                        Hapus Akun Saya
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Delete Account Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4" onclick="closeDeleteModal(event)">
        <div class="w-full max-w-md rounded-2xl bg-white p-8 shadow-2xl" onclick="event.stopPropagation()">
            <div class="mb-6 flex items-center gap-3">
                <div class="rounded-full bg-red-100 p-3">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900">Konfirmasi Hapus Akun</h2>
            </div>

            <p class="mb-6 text-sm text-gray-600">Apakah Anda yakin ingin menghapus akun? Tindakan ini <strong>tidak dapat dibatalkan</strong>. Semua data Anda akan hilang permanen.</p>

            <form action="{{ route('user.account.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700">Masukkan Password untuk Konfirmasi</label>
                    <input type="password" name="password" class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-200" required>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeDeleteModal()" class="flex-1 rounded-lg border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 rounded-lg bg-red-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-red-700">
                        Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }

        function closeDeleteModal(event) {
            if (!event || event.target === event.currentTarget) {
                document.getElementById('deleteModal').classList.add('hidden');
                document.getElementById('deleteModal').classList.remove('flex');
            }
        }
    </script>
@endsection
