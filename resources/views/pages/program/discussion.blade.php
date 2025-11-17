@extends('layouts.app')

@section('title', 'Forum Diskusi')

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
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Forum Diskusi</h1>
                    <p class="mt-2 text-gray-600">Diskusi dengan mentor dan peserta lainnya</p>
                </div>
                <button class="rounded-lg bg-[#2D3C8C] px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-900">
                    Buat Topik Baru
                </button>
            </div>
        </div>

        <!-- Discussion List -->
        <div class="space-y-4">
            @foreach($discussions as $discussion)
                <div class="rounded-xl bg-white p-6 shadow-md hover:shadow-lg transition-shadow cursor-pointer">
                    <div class="flex items-start justify-between">
                        <div class="flex gap-4 flex-1">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-[#2D3C8C] to-[#1e2761] text-white font-bold text-lg">
                                {{ substr($discussion['author'], 0, 1) }}
                            </div>
                            
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $discussion['topic'] }}</h3>
                                <p class="text-sm text-gray-600 mb-3">Dibuat oleh {{ $discussion['author'] }}</p>
                                
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <div class="flex items-center gap-1">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        <span>{{ $discussion['replies'] }} balasan</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Balasan terakhir {{ $discussion['lastReply'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        @if(count($discussions) === 0)
            <div class="rounded-2xl bg-white p-12 text-center shadow-lg">
                <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gray-100">
                    <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Belum Ada Diskusi</h3>
                <p class="mt-2 text-sm text-gray-600 mb-6">Jadilah yang pertama memulai diskusi!</p>
                <button class="rounded-lg bg-[#2D3C8C] px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-900">
                    Buat Topik Baru
                </button>
            </div>
        @endif
    </div>
</div>
@endsection
