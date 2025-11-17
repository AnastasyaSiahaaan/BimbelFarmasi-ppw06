@extends('layouts.app')

@section('title', 'Try Out')

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
            <h1 class="text-3xl font-bold text-gray-900">Try Out</h1>
            <p class="mt-2 text-gray-600">Simulasi ujian lengkap dengan sistem penilaian komprehensif</p>
        </div>

        <!-- Stats -->
        <div class="mb-8 grid gap-6 sm:grid-cols-3">
            <div class="rounded-xl bg-white p-6 shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Try Out</p>
                        <p class="mt-2 text-3xl font-bold text-[#2D3C8C]">{{ count($tryouts) }}</p>
                    </div>
                    <div class="rounded-full bg-blue-100 p-3">
                        <svg class="h-6 w-6 text-[#2D3C8C]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Sudah Dikerjakan</p>
                        <p class="mt-2 text-3xl font-bold text-green-600">{{ count(array_filter($tryouts, fn($t) => $t['completed'])) }}</p>
                    </div>
                    <div class="rounded-full bg-green-100 p-3">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Nilai Tertinggi</p>
                        <p class="mt-2 text-3xl font-bold text-purple-600">
                            @php
                                $completed = array_filter($tryouts, fn($t) => $t['completed']);
                                $highest = count($completed) > 0 ? max(array_column($completed, 'score')) : 0;
                            @endphp
                            {{ $highest }}
                        </p>
                    </div>
                    <div class="rounded-full bg-purple-100 p-3">
                        <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Try Out List -->
        <div class="space-y-4">
            @foreach($tryouts as $tryout)
                <div class="rounded-xl bg-white p-6 shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-start justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-lg font-bold text-gray-900">{{ $tryout['title'] }}</h3>
                                @if($tryout['status'] === 'available')
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">
                                        Tersedia
                                    </span>
                                @elseif($tryout['status'] === 'upcoming')
                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">
                                        Akan Datang
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">
                                        Berakhir
                                    </span>
                                @endif
                                @if($tryout['completed'])
                                    <span class="inline-flex items-center gap-1 rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-800">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Sudah Dikerjakan
                                    </span>
                                @endif
                            </div>
                            
                            <p class="text-sm text-gray-600 mb-4">{{ $tryout['description'] }}</p>
                            
                            <div class="flex items-center gap-6 text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                    <span>{{ $tryout['total_questions'] }} Soal</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $tryout['duration'] }} menit</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($tryout['start_date'])->format('d M') }} - {{ \Carbon\Carbon::parse($tryout['end_date'])->format('d M Y') }}</span>
                                </div>
                                @if($tryout['completed'])
                                    <div class="flex items-center gap-2 font-semibold text-[#2D3C8C]">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                        <span>Nilai: {{ $tryout['score'] }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            @if($tryout['status'] === 'available')
                                <a href="{{ route('program.tryout.start', ['id' => $programId, 'tryoutId' => $tryout['id']]) }}" class="inline-block rounded-lg bg-[#2D3C8C] px-6 py-3 text-sm font-semibold text-white text-center transition hover:bg-blue-900 whitespace-nowrap">
                                    @if($tryout['completed'])
                                        Kerjakan Lagi
                                    @else
                                        Mulai Try Out
                                    @endif
                                </a>
                                @if($tryout['completed'])
                                    <a href="{{ route('program.result', ['id' => $programId, 'resultId' => $tryout['id'] + 100]) }}" class="inline-block rounded-lg border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-700 text-center transition hover:bg-gray-50 whitespace-nowrap">
                                        Lihat Hasil
                                    </a>
                                @endif
                            @elseif($tryout['status'] === 'upcoming')
                                <button disabled class="rounded-lg bg-gray-300 px-6 py-3 text-sm font-semibold text-gray-500 cursor-not-allowed whitespace-nowrap">
                                    Segera Tersedia
                                </button>
                            @else
                                <button disabled class="rounded-lg bg-gray-300 px-6 py-3 text-sm font-semibold text-gray-500 cursor-not-allowed whitespace-nowrap">
                                    Sudah Berakhir
                                </button>
                            @endif
                        </div>
                    </div>

                    @if($tryout['status'] === 'available' && !$tryout['completed'])
                        <div class="mt-4 rounded-lg bg-yellow-50 border border-yellow-200 p-4">
                            <div class="flex gap-3">
                                <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900 mb-1">Tips Mengerjakan Try Out:</p>
                                    <ul class="text-gray-600 space-y-1 list-disc list-inside">
                                        <li>Pastikan koneksi internet stabil</li>
                                        <li>Siapkan waktu sesuai durasi try out</li>
                                        <li>Kerjakan di tempat yang tenang</li>
                                        <li>Jawaban akan otomatis tersimpan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
