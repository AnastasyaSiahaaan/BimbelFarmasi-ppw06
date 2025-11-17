@extends('layouts.app')

@section('title', 'Latihan Soal')

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
            <h1 class="text-3xl font-bold text-gray-900">Latihan Soal</h1>
            <p class="mt-2 text-gray-600">Asah kemampuan dengan bank soal per topik</p>
        </div>

        <!-- Stats -->
        <div class="mb-8 grid gap-6 sm:grid-cols-3">
            <div class="rounded-xl bg-white p-6 shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Latihan</p>
                        <p class="mt-2 text-3xl font-bold text-[#2D3C8C]">{{ count($exercises) }}</p>
                    </div>
                    <div class="rounded-full bg-blue-100 p-3">
                        <svg class="h-6 w-6 text-[#2D3C8C]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Sudah Selesai</p>
                        <p class="mt-2 text-3xl font-bold text-green-600">{{ count(array_filter($exercises, fn($e) => $e['completed'])) }}</p>
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
                        <p class="text-sm text-gray-500">Rata-rata Nilai</p>
                        <p class="mt-2 text-3xl font-bold text-purple-600">
                            @php
                                $completed = array_filter($exercises, fn($e) => $e['completed']);
                                $avg = count($completed) > 0 ? round(array_sum(array_column($completed, 'score')) / count($completed)) : 0;
                            @endphp
                            {{ $avg }}
                        </p>
                    </div>
                    <div class="rounded-full bg-purple-100 p-3">
                        <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Exercises List -->
        <div class="space-y-4">
            @foreach($exercises as $exercise)
                <div class="rounded-xl bg-white p-6 shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-start justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-lg font-bold text-gray-900">{{ $exercise['title'] }}</h3>
                                @if($exercise['difficulty'] === 'easy')
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">
                                        Mudah
                                    </span>
                                @elseif($exercise['difficulty'] === 'medium')
                                    <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">
                                        Sedang
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">
                                        Sulit
                                    </span>
                                @endif
                                @if($exercise['completed'])
                                    <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Selesai
                                    </span>
                                @endif
                            </div>
                            
                            <p class="text-sm text-gray-600 mb-4">{{ $exercise['description'] }}</p>
                            
                            <div class="flex items-center gap-6 text-sm text-gray-500">
                                <div class="flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $exercise['total_questions'] }} Soal</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $exercise['duration'] }} menit</span>
                                </div>
                                @if($exercise['completed'])
                                    <div class="flex items-center gap-2 font-semibold text-[#2D3C8C]">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                        <span>Nilai: {{ $exercise['score'] }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <a href="{{ route('program.exercise.start', ['id' => $programId, 'exerciseId' => $exercise['id']]) }}" class="inline-block rounded-lg bg-[#2D3C8C] px-6 py-3 text-sm font-semibold text-white text-center transition hover:bg-blue-900 whitespace-nowrap">
                                @if($exercise['completed'])
                                    Kerjakan Lagi
                                @else
                                    Mulai Latihan
                                @endif
                            </a>
                            @if($exercise['completed'])
                                <a href="{{ route('program.result', ['id' => $programId, 'resultId' => $exercise['id']]) }}" class="inline-block rounded-lg border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-700 text-center transition hover:bg-gray-50 whitespace-nowrap">
                                    Lihat Hasil
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
