<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'name' => 'Bimbel UKOM D3 Farmasi',
                'slug' => 'bimbel-ukom-d3-farmasi',
                'type' => 'bimbel',
                'description' => 'Program bimbingan belajar intensif untuk persiapan UKOM D3 Farmasi dengan materi lengkap dan try out berkala.',
                'features' => [
                    'Materi lengkap sesuai kisi-kisi UKOM terbaru',
                    'Try out mingguan dengan pembahasan detail',
                    'Konsultasi langsung dengan mentor berpengalaman',
                    'Video pembelajaran on-demand',
                    'Bank soal 1000+ pertanyaan',
                    'Grup diskusi eksklusif',
                    'Sertifikat kelulusan',
                    'Akses e-learning 24/7',
                ],
                'price' => 1250000,
                'duration_months' => 3,
                'total_sessions' => 24,
                'is_active' => true,
            ],
            [
                'name' => 'CPNS & P3K Farmasi Paket Lengkap',
                'slug' => 'cpns-p3k-farmasi',
                'type' => 'cpns',
                'description' => 'Persiapan lengkap untuk menghadapi tes CPNS dan P3K bidang farmasi dengan materi TWK, TIU, TKP, dan farmasi.',
                'features' => [
                    'Materi TWK, TIU, TKP lengkap',
                    'Materi khusus bidang farmasi',
                    'Try out CAT system',
                    'Pembahasan soal interaktif',
                    'Prediksi soal berdasarkan trend',
                    'Konsultasi strategi belajar',
                    'Update informasi CPNS/P3K terbaru',
                    'Simulasi wawancara',
                    'E-book dan modul eksklusif',
                ],
                'price' => 2050000,
                'duration_months' => 4,
                'total_sessions' => 32,
                'is_active' => true,
            ],
            [
                'name' => 'Joki Tugas Farmasi',
                'slug' => 'joki-tugas-farmasi',
                'type' => 'joki',
                'description' => 'Layanan bantuan pengerjaan tugas kuliah farmasi oleh ahli berpengalaman dengan jaminan kualitas terbaik. Harga disesuaikan dengan kompleksitas project.',
                'features' => [
                    'Dikerjakan oleh ahli farmasi berpengalaman',
                    'Plagiarism check dijamin lolos',
                    'Revisi unlimited hingga puas',
                    'On-time delivery guarantee',
                    'Konsultasi materi gratis',
                    'Referensi jurnal terpercaya',
                    'Format sesuai kampus',
                    'Confidential & aman',
                    'Harga custom per project',
                    'Konsultasi & quote gratis',
                ],
                'price' => 500000,
                'duration_months' => 0,
                'total_sessions' => 0,
                'is_active' => true,
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}
