@extends('layouts.admin')

@section('title', 'Detail Soal')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.questions.index') }}" class="text-sm text-gray-600 hover:text-gray-900 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Bank Soal
        </a>
        <div class="mt-2 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Soal #Q{{ $question->id }}</h1>
                <p class="mt-1 text-sm text-gray-500">Informasi lengkap soal latihan</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.questions.edit', $question->id) }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form method="POST" 
                      action="{{ route('admin.questions.destroy', $question->id) }}" 
                      onsubmit="return confirm('Yakin ingin menghapus soal ini?')" 
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <!-- Question Info -->
        <div class="rounded-xl bg-white shadow-sm border border-gray-200 p-6">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Soal</h2>
                    <p class="text-sm text-gray-500 mt-1">{{ $question->program->name }}</p>
                </div>
                <div class="flex items-center gap-2">
                    @if($question->category)
                        <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-800">
                            {{ $question->category }}
                        </span>
                    @endif
                    @if($question->difficulty === 'easy')
                        <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-800">Mudah</span>
                    @elseif($question->difficulty === 'medium')
                        <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-sm font-medium text-yellow-800">Sedang</span>
                    @else
                        <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-800">Sulit</span>
                    @endif
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium
                        {{ $question->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $question->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <p class="text-gray-900 text-base leading-relaxed">{{ $question->question }}</p>
            </div>
        </div>

        <!-- Answer Options -->
        <div class="rounded-xl bg-white shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">Pilihan Jawaban</h2>

            <div class="space-y-3">
                @foreach(['A' => $question->option_a, 'B' => $question->option_b, 'C' => $question->option_c, 'D' => $question->option_d] as $letter => $option)
                    <div class="flex items-start gap-3 p-4 rounded-lg border-2 transition-colors
                        {{ $question->correct_answer === $letter ? 'border-green-500 bg-green-50' : 'border-gray-200 bg-gray-50' }}">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center font-bold
                            {{ $question->correct_answer === $letter ? 'bg-green-500 text-white' : 'bg-gray-300 text-gray-700' }}">
                            {{ $letter }}
                        </div>
                        <div class="flex-1 pt-1">
                            <p class="text-gray-900">{{ $option }}</p>
                            @if($question->correct_answer === $letter)
                                <div class="flex items-center gap-1 mt-2">
                                    <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-sm font-semibold text-green-700">Jawaban Benar</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Explanation -->
        @if($question->explanation)
            <div class="rounded-xl bg-white shadow-sm border border-gray-200 p-6">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-lg font-semibold text-gray-900 mb-2">Penjelasan</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $question->explanation }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Metadata -->
        <div class="rounded-xl bg-white shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Tambahan</h2>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Program</p>
                    <p class="font-medium text-gray-900 mt-1">{{ $question->program->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kategori</p>
                    <p class="font-medium text-gray-900 mt-1">{{ $question->category ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Dibuat Pada</p>
                    <p class="font-medium text-gray-900 mt-1">{{ $question->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Terakhir Diperbarui</p>
                    <p class="font-medium text-gray-900 mt-1">{{ $question->updated_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
