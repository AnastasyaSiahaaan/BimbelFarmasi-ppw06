<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuizBank;
use App\Models\QuizQuestion;
use App\Models\Order;
use App\Models\User;

class QuizBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user yang sudah ada
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
                    'program_id' => 1,
                    'amount' => 500000,
                    'status' => 'completed',
                    'notes' => 'Order untuk demo quiz',
                ]);
            }

            // Bank Soal 1: Farmakologi
            $quiz1 = QuizBank::create([
                'order_id' => $order->id,
                'user_id' => $user->id,
                'title' => 'Ujian Farmakologi - UKOM D3 Farmasi',
                'description' => 'Bank soal farmakologi untuk persiapan UKOM D3 Farmasi',
                'category' => 'Farmakologi',
                'total_questions' => 10,
                'duration_minutes' => 30,
                'passing_score' => 70,
            ]);

            // Soal-soal Farmakologi
            $questions1 = [
                [
                    'question' => 'Apa yang dimaksud dengan farmakokinetik?',
                    'option_a' => 'Efek obat terhadap tubuh',
                    'option_b' => 'Perjalanan obat dalam tubuh (ADME)',
                    'option_c' => 'Interaksi obat dengan reseptor',
                    'option_d' => 'Mekanisme kerja obat',
                    'option_e' => 'Dosis obat yang tepat',
                    'correct_answer' => 'B',
                    'explanation' => 'Farmakokinetik adalah perjalanan obat dalam tubuh yang meliputi Absorpsi, Distribusi, Metabolisme, dan Ekskresi (ADME)',
                ],
                [
                    'question' => 'Organ utama yang berperan dalam metabolisme obat adalah?',
                    'option_a' => 'Ginjal',
                    'option_b' => 'Jantung',
                    'option_c' => 'Hati',
                    'option_d' => 'Paru-paru',
                    'option_e' => 'Limpa',
                    'correct_answer' => 'C',
                    'explanation' => 'Hati adalah organ utama metabolisme obat melalui enzim sitokrom P450',
                ],
                [
                    'question' => 'Rute pemberian obat yang memberikan onset tercepat adalah?',
                    'option_a' => 'Oral',
                    'option_b' => 'Intravena (IV)',
                    'option_c' => 'Intramuskular (IM)',
                    'option_d' => 'Subkutan',
                    'option_e' => 'Topikal',
                    'correct_answer' => 'B',
                    'explanation' => 'Pemberian IV langsung masuk ke aliran darah sehingga memberikan onset paling cepat',
                ],
                [
                    'question' => 'Yang termasuk antagonis kompetitif adalah?',
                    'option_a' => 'Obat yang mengikat reseptor secara irreversibel',
                    'option_b' => 'Obat yang bersaing dengan agonis pada situs yang sama',
                    'option_c' => 'Obat yang bekerja tanpa reseptor',
                    'option_d' => 'Obat yang menghambat enzim',
                    'option_e' => 'Obat yang meningkatkan neurotransmiter',
                    'correct_answer' => 'B',
                    'explanation' => 'Antagonis kompetitif bersaing dengan agonis pada situs pengikatan yang sama di reseptor',
                ],
                [
                    'question' => 'Bioavailabilitas obat oral biasanya lebih rendah karena?',
                    'option_a' => 'Absorpsi yang buruk',
                    'option_b' => 'Efek first-pass metabolism di hati',
                    'option_c' => 'pH lambung',
                    'option_d' => 'Semua benar',
                    'option_e' => 'Tidak ada yang benar',
                    'correct_answer' => 'D',
                    'explanation' => 'Bioavailabilitas oral dipengaruhi oleh absorpsi, first-pass metabolism, dan pH saluran cerna',
                ],
            ];

            foreach ($questions1 as $q) {
                QuizQuestion::create(array_merge(['quiz_bank_id' => $quiz1->id], $q));
            }

            // Bank Soal 2: Farmasi Klinik
            $quiz2 = QuizBank::create([
                'order_id' => $order->id,
                'user_id' => $user->id,
                'title' => 'Ujian Farmasi Klinik - UKOM D3 Farmasi',
                'description' => 'Bank soal farmasi klinik untuk persiapan UKOM D3 Farmasi',
                'category' => 'Farmasi Klinik',
                'total_questions' => 10,
                'duration_minutes' => 30,
                'passing_score' => 70,
            ]);

            $questions2 = [
                [
                    'question' => 'Apa yang dimaksud dengan Pharmaceutical Care?',
                    'option_a' => 'Pelayanan farmasi di apotek',
                    'option_b' => 'Tanggung jawab farmasis untuk mencapai outcome terapi optimal',
                    'option_c' => 'Penjualan obat bebas',
                    'option_d' => 'Pembuatan obat',
                    'option_e' => 'Distribusi obat',
                    'correct_answer' => 'B',
                    'explanation' => 'Pharmaceutical care adalah tanggung jawab langsung farmasis dalam pelayanan terkait obat untuk mencapai outcome yang meningkatkan kualitas hidup pasien',
                ],
                [
                    'question' => 'DRP (Drug Related Problem) yang paling sering terjadi adalah?',
                    'option_a' => 'Obat tidak tersedia',
                    'option_b' => 'Dosis tidak tepat',
                    'option_c' => 'Ketidakpatuhan pasien (non-adherence)',
                    'option_d' => 'Obat mahal',
                    'option_e' => 'Efek samping ringan',
                    'correct_answer' => 'C',
                    'explanation' => 'Non-adherence atau ketidakpatuhan pasien adalah DRP yang paling sering terjadi dan memengaruhi outcome terapi',
                ],
                [
                    'question' => 'Dalam konseling pasien diabetes, informasi penting yang harus disampaikan adalah?',
                    'option_a' => 'Cara penyimpanan insulin',
                    'option_b' => 'Penggunaan alat monitoring gula darah',
                    'option_c' => 'Tanda-tanda hipoglikemia',
                    'option_d' => 'Diet dan olahraga',
                    'option_e' => 'Semua benar',
                    'correct_answer' => 'E',
                    'explanation' => 'Konseling diabetes komprehensif mencakup semua aspek: penyimpanan insulin, monitoring, deteksi hipoglikemia, dan gaya hidup',
                ],
                [
                    'question' => 'Monitoring efek samping antibiotik golongan aminoglikosida yang penting adalah?',
                    'option_a' => 'Fungsi hati',
                    'option_b' => 'Fungsi ginjal dan pendengaran',
                    'option_c' => 'Fungsi jantung',
                    'option_d' => 'Tekanan darah',
                    'option_e' => 'Kadar gula darah',
                    'correct_answer' => 'B',
                    'explanation' => 'Aminoglikosida bersifat nefrotoksik dan ototoksik, sehingga monitoring fungsi ginjal dan pendengaran sangat penting',
                ],
                [
                    'question' => 'Interaksi obat warfarin dengan aspirin dapat menyebabkan?',
                    'option_a' => 'Penurunan efek antikoagulan',
                    'option_b' => 'Peningkatan risiko perdarahan',
                    'option_c' => 'Tidak ada interaksi',
                    'option_d' => 'Gangguan fungsi hati',
                    'option_e' => 'Hipertensi',
                    'correct_answer' => 'B',
                    'explanation' => 'Kombinasi warfarin dan aspirin meningkatkan risiko perdarahan karena efek antiplatelet aspirin',
                ],
            ];

            foreach ($questions2 as $q) {
                QuizQuestion::create(array_merge(['quiz_bank_id' => $quiz2->id], $q));
            }

            // Bank Soal 3: Farmakognosi
            $quiz3 = QuizBank::create([
                'order_id' => $order->id,
                'user_id' => $user->id,
                'title' => 'Ujian Farmakognosi - Obat Bahan Alam',
                'description' => 'Bank soal farmakognosi tentang obat dari bahan alam',
                'category' => 'Farmakognosi',
                'total_questions' => 5,
                'duration_minutes' => 20,
                'passing_score' => 70,
            ]);

            $questions3 = [
                [
                    'question' => 'Alkaloid kafein banyak terdapat pada tanaman?',
                    'option_a' => 'Jahe',
                    'option_b' => 'Kopi dan teh',
                    'option_c' => 'Kunyit',
                    'option_d' => 'Sirih',
                    'option_e' => 'Lidah buaya',
                    'correct_answer' => 'B',
                    'explanation' => 'Kafein adalah alkaloid yang banyak terdapat pada biji kopi dan daun teh',
                ],
                [
                    'question' => 'Senyawa kurkumin yang berkhasiat sebagai antiinflamasi terdapat pada?',
                    'option_a' => 'Temulawak',
                    'option_b' => 'Kunyit',
                    'option_c' => 'Jahe',
                    'option_d' => 'Lengkuas',
                    'option_e' => 'Kencur',
                    'correct_answer' => 'B',
                    'explanation' => 'Kurkumin adalah senyawa aktif utama dalam kunyit (Curcuma longa) yang memiliki efek antiinflamasi',
                ],
                [
                    'question' => 'Metode ekstraksi yang paling sederhana adalah?',
                    'option_a' => 'Destilasi',
                    'option_b' => 'Kromatografi',
                    'option_c' => 'Maserasi',
                    'option_d' => 'Soxhletasi',
                    'option_e' => 'Refluks',
                    'correct_answer' => 'C',
                    'explanation' => 'Maserasi adalah metode ekstraksi paling sederhana dengan cara merendam simplisia dalam pelarut pada suhu ruang',
                ],
                [
                    'question' => 'Glikosida jantung digitoksin berasal dari tanaman?',
                    'option_a' => 'Kina',
                    'option_b' => 'Belladona',
                    'option_c' => 'Digitalis',
                    'option_d' => 'Opium',
                    'option_e' => 'Kamfer',
                    'correct_answer' => 'C',
                    'explanation' => 'Digitoksin adalah glikosida jantung yang diekstrak dari tanaman Digitalis purpurea',
                ],
                [
                    'question' => 'Simplisia adalah?',
                    'option_a' => 'Obat jadi',
                    'option_b' => 'Bahan obat alami yang telah dikeringkan',
                    'option_c' => 'Ekstrak tanaman',
                    'option_d' => 'Senyawa murni',
                    'option_e' => 'Obat sintetik',
                    'correct_answer' => 'B',
                    'explanation' => 'Simplisia adalah bahan alamiah yang digunakan sebagai obat yang belum mengalami pengolahan apapun juga, kecuali pengeringan',
                ],
            ];

            foreach ($questions3 as $q) {
                QuizQuestion::create(array_merge(['quiz_bank_id' => $quiz3->id], $q));
            }
        }

        $this->command->info('✅ Quiz Bank seeder berhasil dijalankan!');
        $this->command->info('📝 Total quiz banks: ' . QuizBank::count());
        $this->command->info('❓ Total questions: ' . QuizQuestion::count());
    }
}
