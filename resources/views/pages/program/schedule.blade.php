@extends('layouts.app')

@section('title', 'Jadwal Kelas')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 py-12">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('program.access', $programId) }}" class="inline-flex items-center gap-2 text-[#2D3C8C] hover:text-[#1e2761] mb-4 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Dashboard
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Jadwal Kelas</h1>
            <p class="mt-2 text-gray-600">Jadwal pertemuan dan sesi pembelajaran</p>
        </div>

        <!-- Schedule List -->
        <div class="space-y-4">
            @foreach($schedules as $schedule)
                <div class="rounded-xl bg-white p-6 shadow-md">
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center justify-center rounded-lg bg-gradient-to-br from-[#2D3C8C] to-[#1e2761] px-4 py-3 text-white">
                                <span class="text-2xl font-bold">{{ \Carbon\Carbon::parse($schedule['date'])->format('d') }}</span>
                                <span class="text-xs uppercase">{{ \Carbon\Carbon::parse($schedule['date'])->format('M') }}</span>
                            </div>
                            
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $schedule['topic'] }}</h3>
                                    @if($schedule['status'] === 'upcoming')
                                        <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">
                                            Akan Datang
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">
                                            Selesai
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="space-y-1 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $schedule['time'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span>{{ $schedule['mentor'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($schedule['status'] === 'upcoming')
                            <button class="rounded-lg bg-[#2D3C8C] px-6 py-2 text-sm font-semibold text-white transition hover:bg-blue-900">
                                Join Kelas
                            </button>
                        @else
                            <button class="rounded-lg border border-gray-300 px-6 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                                Lihat Rekaman
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
