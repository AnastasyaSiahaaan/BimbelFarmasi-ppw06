@extends('layouts.app')

@section('title', 'Testimoni')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#2D3C8C] to-blue-900 py-20 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold sm:text-5xl">Testimoni Peserta</h1>
                <p class="mt-4 text-lg text-blue-100">Cerita sukses mereka yang telah bergabung bersama kami</p>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-white py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 sm:grid-cols-4">
                <div class="text-center">
                    <p class="text-4xl font-bold text-[#2D3C8C]">500+</p>
                    <p class="mt-2 text-sm text-gray-600">Peserta Lulus UKOM</p>
                </div>
                <div class="text-center">
                    <p class="text-4xl font-bold text-[#2D3C8C]">95%</p>
                    <p class="mt-2 text-sm text-gray-600">Tingkat Kelulusan</p>
                </div>
                <div class="text-center">
                    <p class="text-4xl font-bold text-[#2D3C8C]">200+</p>
                    <p class="mt-2 text-sm text-gray-600">Lolos CPNS/P3K</p>
                </div>
                <div class="text-center">
                    <p class="text-4xl font-bold text-[#2D3C8C]">4.9/5</p>
                    <p class="mt-2 text-sm text-gray-600">Rating Kepuasan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Grid -->
    <section class="bg-gradient-to-br from-blue-50 to-purple-50 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach([
                    [
                        'name' => 'Sarah Amelia',
                        'program' => 'Bimbel UKOM D3 Farmasi',
                        'university' => 'Universitas Indonesia',
                        'rating' => 5,
                        'text' => 'Alhamdulillah lulus UKOM di percobaan pertama! Materi yang diberikan sangat lengkap dan mudah dipahami. Mentor juga sangat responsif menjawab pertanyaan.',
                        'image' => 'https://ui-avatars.com/api/?name=Sarah+Amelia&background=2D3C8C&color=fff&size=100'
                    ],
                    [
                        'name' => 'Budi Santoso',
                        'program' => 'CPNS Farmasi',
                        'university' => 'Universitas Padjadjaran',
                        'rating' => 5,
                        'text' => 'Sangat membantu dalam persiapan CPNS! Soal-soal latihan mirip dengan soal aslinya. Alhamdulillah bisa lolos dan sekarang sudah PNS.',
                        'image' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=4F46E5&color=fff&size=100'
                    ],
                    [
                        'name' => 'Rina Widya',
                        'program' => 'Joki Tugas Akademik',
                        'university' => 'Universitas Airlangga',
                        'rating' => 5,
                        'text' => 'Tugas kuliah saya dikerjakan dengan sangat baik dan tepat waktu. Penjelasannya juga detail sehingga saya bisa memahami materinya.',
                        'image' => 'https://ui-avatars.com/api/?name=Rina+Widya&background=EC4899&color=fff&size=100'
                    ],
                    [
                        'name' => 'Ahmad Fauzi',
                        'program' => 'Bimbel UKOM D3 Farmasi',
                        'university' => 'Universitas Gadjah Mada',
                        'rating' => 5,
                        'text' => 'Mentor sangat profesional dan sabar. Saya yang awalnya tidak percaya diri, sekarang lulus UKOM dengan nilai memuaskan!',
                        'image' => 'https://ui-avatars.com/api/?name=Ahmad+Fauzi&background=10B981&color=fff&size=100'
                    ],
                    [
                        'name' => 'Dewi Kartika',
                        'program' => 'P3K Farmasi',
                        'university' => 'Universitas Hasanuddin',
                        'rating' => 5,
                        'text' => 'Materinya update dan sesuai dengan kisi-kisi terbaru. Tryout online juga sangat membantu mengukur kemampuan saya.',
                        'image' => 'https://ui-avatars.com/api/?name=Dewi+Kartika&background=F59E0B&color=fff&size=100'
                    ],
                    [
                        'name' => 'Eko Prasetyo',
                        'program' => 'Bimbel UKOM D3 Farmasi',
                        'university' => 'Universitas Diponegoro',
                        'rating' => 5,
                        'text' => 'Investasi terbaik untuk masa depan! Dengan mengikuti bimbel ini, saya jadi lebih siap dan yakin menghadapi UKOM.',
                        'image' => 'https://ui-avatars.com/api/?name=Eko+Prasetyo&background=8B5CF6&color=fff&size=100'
                    ],
                ] as $testimoni)
                    <div class="rounded-2xl bg-white p-6 shadow-lg transition hover:shadow-xl">
                        <div class="mb-4 flex items-center gap-4">
                            <img src="{{ $testimoni['image'] }}" alt="{{ $testimoni['name'] }}" class="h-16 w-16 rounded-full">
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $testimoni['name'] }}</h3>
                                <p class="text-sm text-gray-600">{{ $testimoni['university'] }}</p>
                                <p class="text-xs font-medium text-[#2D3C8C]">{{ $testimoni['program'] }}</p>
                            </div>
                        </div>

                        <!-- Rating -->
                        <div class="mb-3 flex gap-1">
                            @for($i = 0; $i < $testimoni['rating']; $i++)
                                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>

                        <p class="text-sm leading-relaxed text-gray-700">"{{ $testimoni['text'] }}"</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Video Testimonials -->
    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-gray-900">Video Testimoni</h2>
                <p class="mt-2 text-gray-600">Dengarkan langsung dari mereka</p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @for($i = 1; $i <= 3; $i++)
                    <div class="overflow-hidden rounded-2xl bg-gray-100 shadow-lg">
                        <div class="relative aspect-video bg-gradient-to-br from-blue-500 to-purple-600">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <button class="rounded-full bg-white p-4 shadow-2xl transition hover:scale-110">
                                    <svg class="h-8 w-8 text-[#2D3C8C]" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900">Testimoni Peserta #{{ $i }}</h3>
                            <p class="text-sm text-gray-600">Cerita sukses lulus UKOM</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-br from-[#2D3C8C] to-blue-900 py-16 text-white">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold">Siap Menjadi yang Berikutnya?</h2>
            <p class="mt-4 text-lg text-blue-100">Bergabunglah dengan ratusan peserta yang telah sukses bersama kami</p>
            <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('layanan') }}" class="inline-flex items-center gap-2 rounded-full bg-white px-8 py-4 text-base font-semibold text-[#2D3C8C] shadow-lg transition hover:bg-blue-50">
                    Lihat Program
                </a>
                <a href="{{ route('kontak') }}" class="inline-flex items-center gap-2 rounded-full border-2 border-white px-8 py-4 text-base font-semibold text-white transition hover:bg-white/10">
                    Konsultasi Gratis
                </a>
            </div>
        </div>
    </section>
@endsection
