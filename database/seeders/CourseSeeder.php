<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil beberapa order yang sudah ada atau buat order dummy
        $users = User::where('is_admin', 0)->take(3)->get();
        
        if ($users->isEmpty()) {
            $this->command->warn('⚠️ Tidak ada user biasa. Buat user dulu atau jalankan UserSeeder');
            return;
        }

        foreach ($users as $user) {
            // Cari order user ini atau buat order dummy
            $order = Order::where('user_id', $user->id)->first();
            
            if (!$order) {
                // Buat order dummy untuk demo
                $order = Order::create([
                    'order_number' => 'ORD-' . strtoupper(uniqid()),
                    'user_id' => $user->id,
                    'program_id' => 1, // Asumsikan program dengan ID 1 ada
                    'amount' => 500000,
                    'status' => 'completed',
                    'notes' => 'Order untuk demo course',
                ]);
            }

            // Buat 3-5 course untuk setiap user
            $courses = [
                [
                    'title' => 'Farmakologi Dasar - Pengantar Obat',
                    'description' => 'Mempelajari konsep dasar farmakologi, mekanisme kerja obat, dan farmakokinetik',
                    'content' => "# Farmakologi Dasar\n\n## Pengantar\nFarmakologi adalah ilmu yang mempelajari tentang obat dan interaksinya dengan sistem biologis.\n\n## Materi:\n1. Definisi dan Ruang Lingkup Farmakologi\n2. Farmakokinetik (ADME)\n   - Absorpsi\n   - Distribusi\n   - Metabolisme\n   - Ekskresi\n3. Farmakodinamik\n   - Mekanisme kerja obat\n   - Reseptor obat\n4. Interaksi Obat\n\n## Tujuan Pembelajaran:\n- Memahami konsep dasar farmakologi\n- Mengetahui proses ADME obat\n- Memahami mekanisme kerja obat",
                    'video_url' => 'https://youtube.com/watch?v=example1',
                    'duration_minutes' => 45,
                    'status' => 'not_started',
                ],
                [
                    'title' => 'Farmasi Klinik - Pelayanan Farmasi Rumah Sakit',
                    'description' => 'Memahami peran farmasis dalam pelayanan kesehatan di rumah sakit',
                    'content' => "# Farmasi Klinik\n\n## Pengantar\nFarmasi klinik adalah praktik farmasi yang berfokus pada pelayanan pasien.\n\n## Materi:\n1. Konsep Pharmaceutical Care\n2. Medication Therapy Management (MTM)\n3. Drug Related Problems (DRP)\n4. Konseling Pasien\n5. Monitoring Efek Terapi\n\n## Kompetensi:\n- Mampu melakukan konseling obat\n- Identifikasi DRP\n- Memberikan rekomendasi terapi",
                    'video_url' => 'https://youtube.com/watch?v=example2',
                    'duration_minutes' => 60,
                    'status' => 'not_started',
                ],
                [
                    'title' => 'Farmakognosi - Obat dari Alam',
                    'description' => 'Mempelajari bahan obat yang berasal dari alam (tumbuhan, hewan, mineral)',
                    'content' => "# Farmakognosi\n\n## Pengantar\nFarmakognosi mempelajari obat-obatan yang berasal dari sumber alam.\n\n## Materi:\n1. Metabolit Sekunder Tanaman\n2. Alkaloid\n3. Flavonoid\n4. Terpenoid\n5. Ekstraksi dan Isolasi\n6. Standarisasi Simplisia\n\n## Praktikum:\n- Identifikasi simplisia\n- Ekstraksi bahan alam\n- Skrining fitokimia",
                    'video_url' => null,
                    'duration_minutes' => 90,
                    'status' => 'not_started',
                ],
                [
                    'title' => 'Kimia Medisinal - Struktur dan Aktivitas Obat',
                    'description' => 'Memahami hubungan struktur kimia dengan aktivitas biologis obat',
                    'content' => "# Kimia Medisinal\n\n## Pengantar\nKimia medisinal mempelajari desain, sintesis, dan mekanisme kerja obat.\n\n## Materi:\n1. Hubungan Struktur-Aktivitas (SAR)\n2. Gugus Fungsional Obat\n3. Bioavaibilitas dan Lipofisitas\n4. Prodrug dan Drug Targeting\n5. Metabolisme Obat\n\n## Kasus Studi:\n- Analisis struktur antibiotik\n- Modifikasi struktur untuk meningkatkan aktivitas",
                    'video_url' => 'https://youtube.com/watch?v=example3',
                    'duration_minutes' => 75,
                    'status' => 'not_started',
                ],
                [
                    'title' => 'Teknologi Farmasi - Sediaan Obat',
                    'description' => 'Mempelajari formulasi dan teknologi pembuatan sediaan farmasi',
                    'content' => "# Teknologi Farmasi\n\n## Pengantar\nTeknologi farmasi adalah ilmu dan seni pembuatan sediaan obat.\n\n## Materi:\n1. Bentuk Sediaan Obat\n   - Tablet\n   - Kapsul\n   - Sirup\n   - Salep\n   - Injeksi\n2. Eksipien dan Fungsinya\n3. Proses Pembuatan Tablet\n4. Quality Control\n5. Stabilitas Sediaan\n\n## Praktikum:\n- Formulasi tablet\n- Uji disolusi\n- Uji kekerasan tablet",
                    'video_url' => 'https://youtube.com/watch?v=example4',
                    'duration_minutes' => 120,
                    'status' => 'not_started',
                ],
            ];

            // Pilih 3 course random
            $selectedCourses = array_rand($courses, 3);
            
            foreach ($selectedCourses as $index) {
                Course::create([
                    'order_id' => $order->id,
                    'user_id' => $user->id,
                    'title' => $courses[$index]['title'],
                    'description' => $courses[$index]['description'],
                    'content' => $courses[$index]['content'],
                    'video_url' => $courses[$index]['video_url'],
                    'duration_minutes' => $courses[$index]['duration_minutes'],
                    'status' => $courses[$index]['status'],
                ]);
            }
        }

        $this->command->info('✅ Course seeder berhasil dijalankan!');
        $this->command->info('📚 Total courses: ' . Course::count());
    }
}
