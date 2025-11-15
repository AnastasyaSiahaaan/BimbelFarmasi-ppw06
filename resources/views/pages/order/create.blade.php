@extends('layouts.app')

@section('title', 'Beli ' . $program->name)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Back Button -->
            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-[#2D3C8C] hover:text-[#1e2761] mb-6 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Program Detail -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-[#2D3C8C] to-[#1e2761] flex items-center justify-center flex-shrink-0">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold mb-2">
                                    {{ ucfirst($program->type) }}
                                </span>
                                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $program->name }}</h1>
                                <p class="text-gray-600">{{ $program->description }}</p>
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="border-t pt-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Yang Kamu Dapatkan:</h3>
                            <ul class="space-y-3">
                                @foreach($program->features as $feature)
                                <li class="flex items-start gap-3">
                                    <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-gray-700">{{ $feature }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Program Info -->
                        @if($program->type !== 'joki')
                        <div class="border-t mt-6 pt-6 grid sm:grid-cols-2 gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#2D3C8C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Durasi</p>
                                    <p class="font-semibold text-gray-900">{{ $program->duration_months }} Bulan</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Total Sesi</p>
                                    <p class="font-semibold text-gray-900">{{ $program->total_sessions }} Pertemuan</p>
                                </div>
                            </div>
                        </div>
                        @else
                        <!-- For Joki Tugas: Project-based info -->
                        <div class="border-t mt-6 pt-6">
                            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <div class="text-sm">
                                        <p class="font-semibold text-gray-900 mb-1">Layanan Project-Based</p>
                                        <p class="text-gray-600">Harga dan durasi pengerjaan akan disesuaikan dengan kompleksitas tugas Anda. Tim kami akan menghubungi untuk diskusi detail project.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Order Form -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-24">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Form Pemesanan</h3>
                        
                        <!-- Price -->
                        <div class="bg-gradient-to-r from-[#2D3C8C] to-[#1e2761] rounded-xl p-4 mb-6">
                            <p class="text-white text-sm mb-1">Total Pembayaran</p>
                            <p class="text-white text-3xl font-bold">Rp {{ number_format($program->price, 0, ',', '.') }}</p>
                        </div>

                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="program_id" value="{{ $program->id }}">

                            <!-- Notes -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Catatan (Opsional)
                                </label>
                                <textarea 
                                    name="notes" 
                                    rows="4" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#2D3C8C] focus:border-transparent transition-all resize-none"
                                    placeholder="Tambahkan catatan khusus untuk pesanan Anda..."
                                >{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- User Info Notice -->
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-[#2D3C8C] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <div class="text-sm">
                                        <p class="font-semibold text-gray-900 mb-1">Informasi Pesanan</p>
                                        <p class="text-gray-600">Pesanan akan dikirim ke email: <span class="font-semibold">{{ Auth::user()->email }}</span></p>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-gradient-to-r from-[#2D3C8C] to-[#1e2761] text-white font-bold py-4 rounded-xl hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                Lanjut ke Pembayaran
                                <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </button>
                        </form>

                        <!-- Guarantee -->
                        <div class="mt-6 pt-6 border-t">
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <span>Pembayaran Aman & Terpercaya</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
