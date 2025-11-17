@extends('layouts.app')

@section('title', $tryout['title'])

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 py-8">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <!-- Header with Timer -->
        <div class="mb-6 rounded-xl bg-white p-6 shadow-lg sticky top-4 z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold text-gray-900">{{ $tryout['title'] }}</h1>
                    <p class="text-sm text-gray-600">{{ $tryout['total_questions'] }} Soal</p>
                </div>
                <div class="flex items-center gap-6">
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Waktu Tersisa</p>
                        <p id="timer" class="text-2xl font-bold text-[#2D3C8C]">{{ $tryout['duration'] }}:00</p>
                    </div>
                    <button type="button" onclick="confirmSubmit()" class="rounded-lg bg-green-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-green-700">
                        Selesai
                    </button>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="mt-4">
                <div class="flex items-center justify-between text-sm mb-2">
                    <span class="text-gray-600">Progress: <span id="progress">0</span>/{{ $tryout['total_questions'] }}</span>
                    <span class="text-gray-600"><span id="percentage">0</span>%</span>
                </div>
                <div class="h-2 w-full overflow-hidden rounded-full bg-gray-200">
                    <div id="progressBar" class="h-full rounded-full bg-gradient-to-r from-blue-500 to-purple-600 transition-all" style="width: 0%"></div>
                </div>
            </div>
        </div>

        <!-- Navigation Numbers -->
        <div class="mb-6 rounded-xl bg-white p-6 shadow-md">
            <p class="text-sm font-semibold text-gray-700 mb-3">Navigasi Soal:</p>
            <div class="grid grid-cols-10 gap-2">
                @for($i = 1; $i <= $tryout['total_questions']; $i++)
                    <button type="button" onclick="scrollToQuestion({{ $i }})" id="nav-{{ $i }}" class="aspect-square rounded-lg border-2 border-gray-300 text-sm font-semibold text-gray-700 transition hover:border-[#2D3C8C] hover:bg-blue-50">
                        {{ $i }}
                    </button>
                @endfor
            </div>
        </div>

        <!-- Form -->
        <form id="tryoutForm" action="{{ route('program.tryout.submit', ['id' => $programId, 'tryoutId' => $tryout['id']]) }}" method="POST">
            @csrf
            
            <!-- Questions -->
            <div class="space-y-6">
                @foreach($questions as $index => $question)
                    <div id="question-{{ $question['id'] }}" class="rounded-xl bg-white p-6 shadow-md">
                        <div class="mb-4">
                            <span class="inline-block rounded-full bg-[#2D3C8C] px-3 py-1 text-xs font-semibold text-white">
                                Soal {{ $index + 1 }}
                            </span>
                        </div>
                        
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $question['question'] }}</h3>
                        
                        <div class="space-y-3">
                            @foreach($question['options'] as $key => $option)
                                <label class="flex items-start gap-3 p-4 rounded-lg border-2 border-gray-200 cursor-pointer transition hover:border-[#2D3C8C] hover:bg-blue-50">
                                    <input type="radio" name="answers[{{ $question['id'] }}]" value="{{ $key }}" onchange="updateProgress()" class="mt-1 h-4 w-4 text-[#2D3C8C] focus:ring-[#2D3C8C]">
                                    <span class="flex-1 text-gray-700">
                                        <span class="font-semibold">{{ $key }}.</span> {{ $option }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <div class="mt-8 rounded-xl bg-white p-6 shadow-lg sticky bottom-4">
                <div class="flex items-center justify-between">
                    <a href="{{ route('program.tryouts', $programId) }}" class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <button type="button" onclick="confirmSubmit()" class="rounded-lg bg-green-600 px-8 py-3 font-semibold text-white transition hover:bg-green-700">
                        Selesai & Lihat Hasil
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const totalQuestions = {{ $tryout['total_questions'] }};
    
    // Timer countdown
    let timeLeft = {{ $tryout['duration'] }} * 60;
    
    function updateTimer() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        document.getElementById('timer').textContent = 
            `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        if (timeLeft <= 0) {
            alert('Waktu habis! Jawaban Anda akan otomatis dikumpulkan.');
            document.getElementById('tryoutForm').submit();
            return;
        }
        
        if (timeLeft <= 600) {
            document.getElementById('timer').classList.add('text-red-600');
            document.getElementById('timer').classList.remove('text-[#2D3C8C]');
        }
        
        timeLeft--;
        setTimeout(updateTimer, 1000);
    }
    
    updateTimer();
    
    // Update progress
    function updateProgress() {
        const answered = document.querySelectorAll('input[type="radio"]:checked').length;
        document.getElementById('progress').textContent = answered;
        const percentage = Math.round((answered / totalQuestions) * 100);
        document.getElementById('percentage').textContent = percentage;
        document.getElementById('progressBar').style.width = percentage + '%';
        
        // Update navigation
        document.querySelectorAll('input[type="radio"]:checked').forEach(input => {
            const questionId = input.name.match(/\d+/)[0];
            const navButton = Array.from(document.querySelectorAll('[id^="nav-"]'))
                .find(btn => btn.textContent.trim() === questionId);
            if (navButton) {
                navButton.classList.add('bg-green-500', 'text-white', 'border-green-500');
            }
        });
    }
    
    // Scroll to question
    function scrollToQuestion(num) {
        const question = document.getElementById('question-' + num);
        if (question) {
            question.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
    
    // Confirm submit
    function confirmSubmit() {
        const answered = document.querySelectorAll('input[type="radio"]:checked').length;
        const unanswered = totalQuestions - answered;
        
        let message = 'Apakah Anda yakin ingin mengumpulkan jawaban?';
        if (unanswered > 0) {
            message = `Masih ada ${unanswered} soal yang belum dijawab. Apakah Anda yakin ingin mengumpulkan?`;
        }
        
        if (confirm(message)) {
            document.getElementById('tryoutForm').submit();
        }
    }
    
    // Warn before leaving
    window.addEventListener('beforeunload', function (e) {
        e.preventDefault();
        e.returnValue = '';
    });
</script>
@endsection
