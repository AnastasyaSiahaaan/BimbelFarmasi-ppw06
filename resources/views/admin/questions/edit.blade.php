@extends('layouts.admin')

@section('title', 'Edit Soal')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.questions.index') }}" class="text-sm text-gray-600 hover:text-gray-900 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Bank Soal
        </a>
        <h1 class="mt-2 text-2xl font-bold text-gray-900">Edit Soal</h1>
        <p class="mt-1 text-sm text-gray-500">Perbarui informasi soal latihan</p>
    </div>

    @if($errors->any())
        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-red-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="flex-1">
                    <p class="text-sm font-medium text-red-800 mb-2">Terdapat kesalahan pada form:</p>
                    <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.questions.update', $question->id) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="rounded-xl bg-white shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">Informasi Soal</h2>

            <!-- Program -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Program <span class="text-red-500">*</span></label>
                <select name="program_id" required class="w-full rounded-lg border-gray-300">
                    <option value="">Pilih Program</option>
                    @foreach($programs as $program)
                        <option value="{{ $program->id }}" {{ (old('program_id', $question->program_id) == $program->id) ? 'selected' : '' }}>
                            {{ $program->name }}
                        </option>
                    @endforeach
                </select>
                @error('program_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <input type="text" 
                       name="category" 
                       value="{{ old('category', $question->category) }}"
                       placeholder="e.g., Farmakologi, Farmasetika, Kimia Farmasi"
                       class="w-full rounded-lg border-gray-300">
                <p class="mt-1 text-xs text-gray-500">Opsional - Kategori untuk mengelompokkan soal</p>
            </div>

            <!-- Question Text -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pertanyaan <span class="text-red-500">*</span></label>
                <textarea name="question" 
                          rows="4" 
                          required 
                          placeholder="Tuliskan pertanyaan soal di sini..."
                          class="w-full rounded-lg border-gray-300">{{ old('question', $question->question) }}</textarea>
                @error('question')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="rounded-xl bg-white shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">Pilihan Jawaban</h2>

            <!-- Option A -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan A <span class="text-red-500">*</span></label>
                <input type="text" 
                       name="option_a" 
                       value="{{ old('option_a', $question->option_a) }}"
                       required 
                       placeholder="Masukkan pilihan A"
                       class="w-full rounded-lg border-gray-300">
                @error('option_a')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Option B -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan B <span class="text-red-500">*</span></label>
                <input type="text" 
                       name="option_b" 
                       value="{{ old('option_b', $question->option_b) }}"
                       required 
                       placeholder="Masukkan pilihan B"
                       class="w-full rounded-lg border-gray-300">
                @error('option_b')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Option C -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan C <span class="text-red-500">*</span></label>
                <input type="text" 
                       name="option_c" 
                       value="{{ old('option_c', $question->option_c) }}"
                       required 
                       placeholder="Masukkan pilihan C"
                       class="w-full rounded-lg border-gray-300">
                @error('option_c')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Option D -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilihan D <span class="text-red-500">*</span></label>
                <input type="text" 
                       name="option_d" 
                       value="{{ old('option_d', $question->option_d) }}"
                       required 
                       placeholder="Masukkan pilihan D"
                       class="w-full rounded-lg border-gray-300">
                @error('option_d')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Correct Answer -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Jawaban Benar <span class="text-red-500">*</span></label>
                <select name="correct_answer" required class="w-full rounded-lg border-gray-300">
                    <option value="">Pilih jawaban yang benar</option>
                    <option value="A" {{ old('correct_answer', $question->correct_answer) == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('correct_answer', $question->correct_answer) == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('correct_answer', $question->correct_answer) == 'C' ? 'selected' : '' }}>C</option>
                    <option value="D" {{ old('correct_answer', $question->correct_answer) == 'D' ? 'selected' : '' }}>D</option>
                </select>
                @error('correct_answer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Explanation -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Penjelasan</label>
                <textarea name="explanation" 
                          rows="3" 
                          placeholder="Penjelasan mengapa jawaban tersebut benar (opsional)"
                          class="w-full rounded-lg border-gray-300">{{ old('explanation', $question->explanation) }}</textarea>
                <p class="mt-1 text-xs text-gray-500">Opsional - Penjelasan akan ditampilkan setelah siswa menjawab</p>
            </div>
        </div>

        <div class="rounded-xl bg-white shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">Pengaturan Soal</h2>

            <div class="grid sm:grid-cols-2 gap-6">
                <!-- Difficulty -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tingkat Kesulitan <span class="text-red-500">*</span></label>
                    <select name="difficulty" required class="w-full rounded-lg border-gray-300">
                        <option value="">Pilih tingkat kesulitan</option>
                        <option value="easy" {{ old('difficulty', $question->difficulty) == 'easy' ? 'selected' : '' }}>Mudah</option>
                        <option value="medium" {{ old('difficulty', $question->difficulty) == 'medium' ? 'selected' : '' }}>Sedang</option>
                        <option value="hard" {{ old('difficulty', $question->difficulty) == 'hard' ? 'selected' : '' }}>Sulit</option>
                    </select>
                    @error('difficulty')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full rounded-lg border-gray-300">
                        <option value="active" {{ old('status', $question->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $question->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    <p class="mt-1 text-xs text-gray-500">Soal nonaktif tidak akan ditampilkan ke peserta</p>
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" 
                    class="inline-flex items-center gap-2 px-6 py-3 bg-[#2D3C8C] text-white rounded-lg hover:bg-blue-900 font-semibold shadow-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Perbarui Soal
            </button>
            <a href="{{ route('admin.questions.index') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-semibold">
                Batal
            </a>
        </div>
    </form>
@endsection
