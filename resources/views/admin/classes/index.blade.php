@extends('layouts.admin')

@section('title', 'Manajemen Kelas')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Kelas & Program</h1>
            <p class="mt-1 text-sm text-gray-500">Kelola semua program pembelajaran dan jadwal kelas</p>
        </div>
        <button class="inline-flex items-center gap-2 rounded-lg bg-[#2D3C8C] px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-900">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Program
        </button>
    </div>

    <!-- Classes Grid -->
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ([
            ['name' => 'UKOM D3 Farmasi - Reguler', 'students' => 45, 'tutor' => 'Dr. Ani Susanti, Apt.', 'schedule' => 'Sen & Rab, 19:00-21:00', 'status' => 'active'],
            ['name' => 'UKOM D3 Farmasi - Premium', 'students' => 28, 'tutor' => 'Dr. Budi Prasetyo, Apt.', 'schedule' => 'Sel & Kam, 19:00-21:00', 'status' => 'active'],
            ['name' => 'CPNS Farmasi - Paket Lengkap', 'students' => 30, 'tutor' => 'Prof. Dr. Dewi L, Apt.', 'schedule' => 'Rab & Jum, 20:00-22:00', 'status' => 'active'],
            ['name' => 'P3K Farmasi - Fast Track', 'students' => 18, 'tutor' => 'apt. Ahmad Fauzi, M.Farm', 'schedule' => 'Setiap Hari, 19:00-20:30', 'status' => 'active'],
        ] as $class)
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-start justify-between">
                <h3 class="font-semibold text-gray-900">{{ $class['name'] }}</h3>
                <span class="rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-700">{{ ucfirst($class['status']) }}</span>
            </div>
            <div class="space-y-3 text-sm">
                <div class="flex items-center gap-2 text-gray-600">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>{{ $class['students'] }} Peserta</span>
                </div>
                <div class="flex items-center gap-2 text-gray-600">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>{{ $class['tutor'] }}</span>
                </div>
                <div class="flex items-center gap-2 text-gray-600">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ $class['schedule'] }}</span>
                </div>
            </div>
            <div class="mt-4 flex gap-2">
                <button class="flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Edit</button>
                <button class="flex-1 rounded-lg bg-[#2D3C8C] px-3 py-2 text-sm font-medium text-white hover:bg-blue-900">Detail</button>
            </div>
        </div>
        @endforeach
    </div>
@endsection
