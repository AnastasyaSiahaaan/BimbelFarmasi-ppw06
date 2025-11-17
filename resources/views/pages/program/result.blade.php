@extends('layouts.app')

@section('title', 'Hasil ' . $result['title'])

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 py-12">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">Hasil {{ ucfirst($result['type']) }}</h1>
            <p class="mt-2 text-gray-600">{{ $result['title'] }}</p>
        </div>

        <!-- Score Card -->
        <div class="mb-8 rounded-2xl bg-gradient-to-br from-[#2D3C8C] to-[#1e2761] p-8 text-center shadow-xl">
            <div class="mb-4">
                @if($result['score'] >= $result['passing_grade'])
                    <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-green-500">
                        <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">Selamat! Anda Lulus</h2>
                @else
                    <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-yellow-500">
                        <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">Terus Semangat!</h2>
                @endif
            </div>
            
            <div class="mb-6">
                <p class="text-6xl font-bold text-white">{{ $result['score'] }}</p>
                <p class="text-lg text-blue-100">Nilai Anda</p>
            </div>
            
            <div class="grid grid-cols-3 gap-4 text-white">
                <div>
                    <p class="text-2xl font-bold">{{ $result['correct_answers'] }}</p>
                    <p class="text-sm text-blue-100">Jawaban Benar</p>
                </div>
                <div>
                    <p class="text-2xl font-bold">{{ $result['total_questions'] - $result['correct_answers'] }}</p>
                    <p class="text-sm text-blue-100">Jawaban Salah</p>
                </div>
                <div>
                    <p class="text-2xl font-bold">{{ $result['duration_spent'] }}</p>
                    <p class="text-sm text-blue-100">Menit</p>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="mb-8 grid gap-6 sm:grid-cols-2">
            <div class="rounded-xl bg-white p-6 shadow-md">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100">
                        <svg class="h-6 w-6 text-[#2D3C8C]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Waktu Pengerjaan</p>
                        <p class="text-lg font-bold text-gray-900">{{ $result['duration_spent'] }} menit</p>
                    </div>
                </div>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-md">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-green-100">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Passing Grade</p>
                        <p class="text-lg font-bold text-gray-900">{{ $result['passing_grade'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Breakdown by Category -->
        <div class="mb-8 rounded-xl bg-white p-6 shadow-md">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Breakdown Per Kategori</h3>
            
            <div class="space-y-4">
                @foreach($breakdown as $category)
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-semibold text-gray-700">{{ $category['category'] }}</span>
                            <span class="text-sm font-semibold text-gray-900">
                                {{ $category['correct'] }}/{{ $category['total'] }} ({{ $category['percentage'] }}%)
                            </span>
                        </div>
                        <div class="h-3 w-full overflow-hidden rounded-full bg-gray-200">
                            <div class="h-full rounded-full transition-all {{ $category['percentage'] >= 70 ? 'bg-green-500' : ($category['percentage'] >= 50 ? 'bg-yellow-500' : 'bg-red-500') }}" style="width: {{ $category['percentage'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recommendations -->
        <div class="mb-8 rounded-xl bg-blue-50 border border-blue-200 p-6">
            <div class="flex gap-3">
                <svg class="w-6 h-6 text-[#2D3C8C] flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                </svg>
                <div>
                    <p class="font-semibold text-gray-900 mb-2">Rekomendasi:</p>
                    <ul class="text-sm text-gray-700 space-y-1 list-disc list-inside">
                        @if($result['score'] >= 90)
                            <li>Pertahankan performa Anda yang sangat baik!</li>
                            <li>Coba tingkatkan kecepatan mengerjakan soal</li>
                            <li>Bantu teman yang kesulitan di forum diskusi</li>
                        @elseif($result['score'] >= 70)
                            <li>Performa bagus! Pelajari kembali materi dengan nilai rendah</li>
                            <li>Perbanyak latihan soal untuk kategori yang lemah</li>
                            <li>Diskusikan pembahasan dengan mentor</li>
                        @else
                            <li>Fokus pelajari kembali materi fundamental</li>
                            <li>Ikuti kelas tambahan jika tersedia</li>
                            <li>Konsultasi dengan mentor untuk strategi belajar</li>
                            <li>Perbanyak latihan soal secara bertahap</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4">
            <a href="{{ route('program.access', $programId) }}" class="flex-1 rounded-lg border-2 border-[#2D3C8C] px-6 py-3 text-center font-semibold text-[#2D3C8C] transition hover:bg-blue-50">
                Kembali ke Dashboard
            </a>
            <a href="{{ $result['type'] === 'tryout' ? route('program.tryouts', $programId) : route('program.exercises', $programId) }}" class="flex-1 rounded-lg bg-[#2D3C8C] px-6 py-3 text-center font-semibold text-white transition hover:bg-blue-900">
                @if($result['type'] === 'tryout')
                    Lihat Try Out Lainnya
                @else
                    Lihat Latihan Lainnya
                @endif
            </a>
        </div>
    </div>
</div>
@endsection
