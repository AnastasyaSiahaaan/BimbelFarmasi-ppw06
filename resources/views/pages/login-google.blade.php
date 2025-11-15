@extends('layouts.app')

@section('title', 'Masuk dengan Google')

@section('content')
    <section class="bg-white min-h-screen flex items-center justify-center">
        <div class="mx-auto max-w-lg px-4 py-16 sm:px-6 lg:px-8 w-full">
            <!-- Form Login Google (Tengah, Mirip Google) -->
            <div class="rounded-3xl border border-gray-200 bg-white p-10 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex w-full flex-col gap-8">
                    <!-- Logo dan Header -->
                    <div class="text-center">
                        <img src="https://www.gstatic.com/images/branding/product/2x/google_g_48dp.png" alt="Google" class="mx-auto h-12 w-12">
                        <h1 class="mt-4 text-2xl font-normal text-gray-900">Masuk</h1>
                        <p class="mt-2 text-sm text-gray-600">Gunakan akun Google Anda</p>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('login.google') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="text-sm font-medium text-gray-700">Email atau nomor telepon</label>
                            <input type="email" id="email" name="email" class="mt-2 w-full rounded border border-gray-300 px-4 py-3 text-sm text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all duration-200" placeholder="Email atau nomor telepon" required aria-label="Email atau nomor telepon">
                        </div>
                        <div class="flex justify-between text-sm">
                            <a href="#" class="text-blue-600 hover:underline">Lupa email?</a>
                        </div>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            Bukan komputer Anda? Gunakan mode tamu untuk login secara privat. 
                            <a href="#" class="text-blue-600 hover:underline">Pelajari lebih lanjut</a>
                        </p>
                        <div class="flex items-center justify-between">
                            <a href="{{ route('register') }}" class="text-sm font-medium text-blue-600 hover:underline">Buat akun</a>
                            <button type="submit" class="inline-flex items-center rounded bg-blue-600 px-6 py-2 text-sm font-medium text-white shadow hover:bg-blue-700 transition-colors duration-200" aria-label="Berikutnya">Berikutnya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection