@extends('layouts.admin')

@section('title', 'Statistik & Laporan')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Statistik & Laporan</h1>
        <p class="mt-1 text-sm text-gray-500">Analisis data dan performa platform</p>
    </div>

    <!-- Date Filter -->
    <div class="mb-6 flex gap-2">
        <button class="rounded-lg bg-[#2D3C8C] px-4 py-2 text-sm font-medium text-white">Bulan Ini</button>
        <button class="rounded-lg bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">3 Bulan</button>
        <button class="rounded-lg bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">6 Bulan</button>
        <button class="rounded-lg bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">1 Tahun</button>
    </div>

    <!-- Charts Row 1 -->
    <div class="mb-6 grid gap-6 lg:grid-cols-2">
        <!-- Enrollment Trend -->
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">Tren Pendaftaran</h3>
            <div class="relative h-64">
                <canvas id="enrollmentChart"></canvas>
            </div>
        </div>

        <!-- Revenue Trend -->
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">Pendapatan</h3>
            <div class="relative h-64">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="mb-6 grid gap-4 sm:grid-cols-4">
        <div class="rounded-xl bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Tingkat Kelulusan</p>
            <p class="mt-2 text-3xl font-bold text-green-600">87.5%</p>
            <p class="mt-1 text-xs text-gray-500">↑ 5.2% dari bulan lalu</p>
        </div>
        <div class="rounded-xl bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Rata-rata Nilai</p>
            <p class="mt-2 text-3xl font-bold text-blue-600">82.3</p>
            <p class="mt-1 text-xs text-gray-500">↑ 2.1 poin</p>
        </div>
        <div class="rounded-xl bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Tingkat Penyelesaian</p>
            <p class="mt-2 text-3xl font-bold text-purple-600">78.4%</p>
            <p class="mt-1 text-xs text-gray-500">↑ 3.8% dari bulan lalu</p>
        </div>
        <div class="rounded-xl bg-white p-4 shadow-sm">
            <p class="text-sm text-gray-500">Kepuasan Peserta</p>
            <p class="mt-2 text-3xl font-bold text-yellow-600">4.6/5</p>
            <p class="mt-1 text-xs text-gray-500">Dari 156 review</p>
        </div>
    </div>

    <!-- Charts Row 2 -->
    <div class="mb-6 grid gap-6 lg:grid-cols-2">
        <!-- Program Performance -->
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">Performa Program</h3>
            <div class="relative h-64">
                <canvas id="programPerformanceChart"></canvas>
            </div>
        </div>

        <!-- Top Categories -->
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">Kategori Soal Terpopuler</h3>
            <div class="space-y-4">
                @foreach([
                    ['name' => 'Farmakologi', 'count' => 1850, 'percentage' => 85],
                    ['name' => 'Farmasetika', 'count' => 1420, 'percentage' => 68],
                    ['name' => 'Etika & Hukum Farmasi', 'count' => 980, 'percentage' => 52],
                    ['name' => 'Farmasi Klinik', 'count' => 750, 'percentage' => 40],
                    ['name' => 'Manajemen Farmasi', 'count' => 300, 'percentage' => 25],
                ] as $category)
                <div>
                    <div class="mb-1 flex justify-between text-sm">
                        <span class="font-medium text-gray-700">{{ $category['name'] }}</span>
                        <span class="text-gray-500">{{ number_format($category['count']) }} soal</span>
                    </div>
                    <div class="h-2 rounded-full bg-gray-200">
                        <div class="h-2 rounded-full bg-[#2D3C8C]" style="width: {{ $category['percentage'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Latest Activity Table -->
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h3 class="mb-4 text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Peserta</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Program</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Aktivitas</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Nilai</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-600">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach([
                        ['name' => 'Siti Rahma', 'program' => 'UKOM D3', 'activity' => 'Menyelesaikan kuis', 'score' => '92', 'time' => '5 menit lalu'],
                        ['name' => 'Budi Santoso', 'program' => 'CPNS', 'activity' => 'Menonton video', 'score' => '-', 'time' => '15 menit lalu'],
                        ['name' => 'Dewi Lestari', 'program' => 'P3K', 'activity' => 'Mengumpulkan tugas', 'score' => '88', 'time' => '1 jam lalu'],
                        ['name' => 'Ahmad Rizki', 'program' => 'UKOM D3', 'activity' => 'Try Out', 'score' => '76', 'time' => '2 jam lalu'],
                        ['name' => 'Rina Wijaya', 'program' => 'Joki Tugas', 'activity' => 'Mengajukan tugas', 'score' => '-', 'time' => '3 jam lalu'],
                    ] as $activity)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($activity['name']) }}&background=random" class="h-8 w-8 rounded-full">
                                <span class="font-medium text-gray-900">{{ $activity['name'] }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $activity['program'] }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $activity['activity'] }}</td>
                        <td class="px-4 py-3">
                            @if($activity['score'] !== '-')
                                <span class="font-semibold text-gray-900">{{ $activity['score'] }}</span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $activity['time'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    <script>
        // Enrollment Trend Chart
        const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
        new Chart(enrollmentCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt'],
                datasets: [{
                    label: 'Peserta Baru',
                    data: [12, 19, 15, 25, 22, 30, 28, 35, 32, 40],
                    borderColor: '#2D3C8C',
                    backgroundColor: 'rgba(45, 60, 140, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Revenue Trend Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt'],
                datasets: [{
                    label: 'Pendapatan (Juta Rp)',
                    data: [15, 24, 20, 32, 28, 38, 35, 42, 38, 50],
                    backgroundColor: '#10b981',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Program Performance Chart
        const programCtx = document.getElementById('programPerformanceChart').getContext('2d');
        new Chart(programCtx, {
            type: 'radar',
            data: {
                labels: ['UKOM D3', 'CPNS', 'P3K', 'Joki Tugas'],
                datasets: [{
                    label: 'Tingkat Kelulusan (%)',
                    data: [88, 82, 90, 85],
                    borderColor: '#2D3C8C',
                    backgroundColor: 'rgba(45, 60, 140, 0.2)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    </script>
    @endpush
@endsection
