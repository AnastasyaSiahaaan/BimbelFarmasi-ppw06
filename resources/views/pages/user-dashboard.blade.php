@extends('layouts.app')

@section('title', 'Dashboard Peserta')

@section('content')
    <section class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="mb-8 rounded-2xl bg-white p-8 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                        <p class="mt-2 text-gray-600">Semangat belajar hari ini! Mari lanjutkan progres belajarmu.</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="rounded-lg bg-red-500 px-6 py-2 text-sm font-semibold text-white transition hover:bg-red-600">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="mb-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-xl bg-white p-6 shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Kelas Aktif</p>
                            <p class="mt-2 text-3xl font-bold text-[#2D3C8C]">3</p>
                        </div>
                        <div class="rounded-full bg-blue-100 p-3">
                            <svg class="h-8 w-8 text-[#2D3C8C]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Progress</p>
                            <p class="mt-2 text-3xl font-bold text-green-600">67%</p>
                        </div>
                        <div class="rounded-full bg-green-100 p-3">
                            <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Skor Terakhir</p>
                            <p class="mt-2 text-3xl font-bold text-purple-600">85</p>
                        </div>
                        <div class="rounded-full bg-purple-100 p-3">
                            <svg class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl bg-white p-6 shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Hari Streak</p>
                            <p class="mt-2 text-3xl font-bold text-orange-600">12</p>
                        </div>
                        <div class="rounded-full bg-orange-100 p-3">
                            <svg class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mb-8">
                <h2 class="mb-4 text-xl font-bold text-gray-900">Aksi Cepat</h2>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <button class="rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 p-4 text-left text-white shadow-lg transition hover:shadow-xl">
                        <p class="text-sm font-medium">Lanjutkan Belajar</p>
                        <p class="mt-1 text-xs opacity-90">Modul terakhir: Farmakologi</p>
                    </button>
                    <button class="rounded-xl bg-gradient-to-r from-green-500 to-green-600 p-4 text-left text-white shadow-lg transition hover:shadow-xl">
                        <p class="text-sm font-medium">Latihan Soal</p>
                        <p class="mt-1 text-xs opacity-90">50+ soal baru tersedia</p>
                    </button>
                    <button class="rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 p-4 text-left text-white shadow-lg transition hover:shadow-xl">
                        <p class="text-sm font-medium">Jadwal Kelas</p>
                        <p class="mt-1 text-xs opacity-90">Live class besok pukul 19:00</p>
                    </button>
                    <button class="rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 p-4 text-left text-white shadow-lg transition hover:shadow-xl">
                        <p class="text-sm font-medium">Konsultasi</p>
                        <p class="mt-1 text-xs opacity-90">Chat dengan mentor</p>
                    </button>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="rounded-2xl bg-white p-8 shadow-lg">
                <h2 class="mb-6 text-xl font-bold text-gray-900">Aktivitas Terbaru</h2>
                <div class="space-y-4">
                    <div class="flex items-center gap-4 rounded-lg border border-gray-100 p-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">Menyelesaikan Modul: Farmakologi Dasar</p>
                            <p class="text-sm text-gray-500">2 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 rounded-lg border border-gray-100 p-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">Mengerjakan 30 Soal Latihan</p>
                            <p class="text-sm text-gray-500">Kemarin, 20:15</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 rounded-lg border border-gray-100 p-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-purple-100">
                            <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">Mengikuti Live Class: Kimia Farmasi</p>
                            <p class="text-sm text-gray-500">3 hari yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
