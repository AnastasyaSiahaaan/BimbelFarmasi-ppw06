@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Peserta Aktif</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">120</p>
                    <p class="mt-1 text-xs text-green-600">↑ 12% dari bulan lalu</p>
                </div>
                <div class="rounded-full bg-blue-100 p-3">
                    <svg class="h-8 w-8 text-[#2D3C8C]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Kelas Berjalan</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">4</p>
                    <p class="mt-1 text-xs text-gray-500">2 UKOM, 2 CPNS/P3K</p>
                </div>
                <div class="rounded-full bg-purple-100 p-3">
                    <svg class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Soal Tersedia</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">5,300</p>
                    <p class="mt-1 text-xs text-blue-600">↑ 150 soal ditambahkan</p>
                </div>
                <div class="rounded-full bg-green-100 p-3">
                    <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pendapatan Bulan Ini</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">Rp 180jt</p>
                    <p class="mt-1 text-xs text-green-600">↑ 8% dari target</p>
                </div>
                <div class="rounded-full bg-yellow-100 p-3">
                    <svg class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <!-- Activity Chart -->
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Aktivitas Mingguan</h3>
                <select class="rounded-lg border-gray-300 text-sm">
                    <option>7 Hari Terakhir</option>
                    <option>30 Hari Terakhir</option>
                    <option>3 Bulan Terakhir</option>
                </select>
            </div>
            <div class="relative h-64">
                <canvas id="activityChart"></canvas>
            </div>
        </div>

        <!-- Student Distribution -->
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Distribusi Peserta per Program</h3>
            </div>
            <div class="relative h-64">
                <canvas id="distributionChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Laporan & Statistik Section -->
    <div class="mt-8 mb-4">
        <h2 class="text-xl font-bold text-gray-900">Laporan & Statistik</h2>
        <p class="mt-1 text-sm text-gray-500">Analisis tren dan performa platform</p>
    </div>

    <!-- Statistics Charts Row 1 -->
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

    <!-- Statistics Charts Row 2 -->
    <div class="mb-6 grid gap-6 lg:grid-cols-2">
        <!-- Program Performance -->
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">Performa Program</h3>
            <div class="relative h-64">
                <canvas id="programPerformanceChart"></canvas>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">Statistik Kunci</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <span class="text-sm font-medium text-gray-700">Tingkat Kelulusan</span>
                    <span class="text-lg font-bold text-green-600">87.5%</span>
                </div>
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <span class="text-sm font-medium text-gray-700">Rata-rata Nilai</span>
                    <span class="text-lg font-bold text-blue-600">82.3</span>
                </div>
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <span class="text-sm font-medium text-gray-700">Tingkat Penyelesaian</span>
                    <span class="text-lg font-bold text-purple-600">78.4%</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700">Kepuasan Peserta</span>
                    <span class="text-lg font-bold text-yellow-600">4.6/5</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Pending Actions -->
    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <!-- Recent Students -->
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Pendaftar Terbaru</h3>
                <a href="{{ route('admin.students.index') }}" class="text-sm font-medium text-[#2D3C8C] hover:underline">Lihat Semua →</a>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Siti+Rahma&background=random" alt="" class="h-10 w-10 rounded-full">
                        <div>
                            <p class="font-medium text-gray-900">Siti Rahma</p>
                            <p class="text-xs text-gray-500">UKOM D3 Farmasi</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">Aktif</span>
                </div>
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random" alt="" class="h-10 w-10 rounded-full">
                        <div>
                            <p class="font-medium text-gray-900">Budi Santoso</p>
                            <p class="text-xs text-gray-500">CPNS Farmasi</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">Pending</span>
                </div>
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Dewi+Lestari&background=random" alt="" class="h-10 w-10 rounded-full">
                        <div>
                            <p class="font-medium text-gray-900">Dewi Lestari</p>
                            <p class="text-xs text-gray-500">Joki Tugas</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">Aktif</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Fauzi&background=random" alt="" class="h-10 w-10 rounded-full">
                        <div>
                            <p class="font-medium text-gray-900">Ahmad Fauzi</p>
                            <p class="text-xs text-gray-500">P3K Farmasi</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">Aktif</span>
                </div>
            </div>
        </div>

        <!-- Pending Payments -->
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Pembayaran Pending</h3>
                <a href="{{ route('admin.payments.index') }}" class="text-sm font-medium text-[#2D3C8C] hover:underline">Lihat Semua →</a>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <div>
                        <p class="font-medium text-gray-900">Rina Wijaya</p>
                        <p class="text-xs text-gray-500">UKOM D3 - Paket Reguler</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900">Rp 1.250.000</p>
                        <button class="mt-1 text-xs font-medium text-[#2D3C8C] hover:underline">Konfirmasi</button>
                    </div>
                </div>
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <div>
                        <p class="font-medium text-gray-900">Budi Santoso</p>
                        <p class="text-xs text-gray-500">CPNS - Paket Lengkap</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900">Rp 2.050.000</p>
                        <button class="mt-1 text-xs font-medium text-[#2D3C8C] hover:underline">Konfirmasi</button>
                    </div>
                </div>
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <div>
                        <p class="font-medium text-gray-900">Fitri Handayani</p>
                        <p class="text-xs text-gray-500">Joki Tugas - Complete Writing</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900">Rp 2.450.000</p>
                        <button class="mt-1 text-xs font-medium text-[#2D3C8C] hover:underline">Konfirmasi</button>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-900">Anton Prasetyo</p>
                        <p class="text-xs text-gray-500">UKOM D3 - Paket Premium</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900">Rp 1.950.000</p>
                        <button class="mt-1 text-xs font-medium text-[#2D3C8C] hover:underline">Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Activity Chart
        const activityCtx = document.getElementById('activityChart');
        if (activityCtx) {
            new Chart(activityCtx, {
                type: 'line',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    datasets: [{
                        label: 'Login Peserta',
                        data: [65, 78, 85, 81, 92, 88, 70],
                        borderColor: '#2D3C8C',
                        backgroundColor: 'rgba(45, 60, 140, 0.1)',
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Soal Dikerjakan',
                        data: [45, 62, 70, 65, 75, 68, 55],
                        borderColor: '#8b5cf6',
                        backgroundColor: 'rgba(139, 92, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Distribution Chart
        const distributionCtx = document.getElementById('distributionChart');
        if (distributionCtx) {
            new Chart(distributionCtx, {
                type: 'doughnut',
                data: {
                    labels: ['UKOM D3', 'CPNS Farmasi', 'P3K Farmasi', 'Joki Tugas'],
                    datasets: [{
                        data: [45, 30, 18, 27],
                        backgroundColor: ['#2D3C8C', '#8b5cf6', '#10b981', '#f59e0b'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Enrollment Trend Chart
        const enrollmentCtx = document.getElementById('enrollmentChart');
        if (enrollmentCtx) {
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
        }

        // Revenue Trend Chart
        const revenueCtx = document.getElementById('revenueChart');
        if (revenueCtx) {
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
        }

        // Program Performance Chart
        const programCtx = document.getElementById('programPerformanceChart');
        if (programCtx) {
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
        }
    });
</script>
@endpush
