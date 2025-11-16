<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Program;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        // Buat beberapa user dummy untuk testimoni
        $testimonialData = [
            [
                'name' => 'Sarah Amelia',
                'email' => 'sarah.amelia@example.com',
                'program_slug' => 'bimbel-ukom-d3-farmasi',
                'rating' => 5,
                'comment' => 'Alhamdulillah lulus UKOM di percobaan pertama! Materi yang diberikan sangat lengkap dan mudah dipahami. Mentor juga sangat responsif menjawab pertanyaan. Terima kasih Bimbel Farmasi!',
                'university' => 'Universitas Indonesia'
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'program_slug' => 'cpns-p3k-farmasi',
                'rating' => 5,
                'comment' => 'Sangat membantu dalam persiapan CPNS! Soal-soal latihan mirip dengan soal aslinya. Alhamdulillah bisa lolos dan sekarang sudah PNS. Recommended banget!',
                'university' => 'Universitas Padjadjaran'
            ],
            [
                'name' => 'Rina Widya',
                'email' => 'rina.widya@example.com',
                'program_slug' => 'joki-tugas-farmasi',
                'rating' => 5,
                'comment' => 'Tugas kuliah saya dikerjakan dengan sangat baik dan tepat waktu. Penjelasannya juga detail sehingga saya bisa memahami materinya. Worth it!',
                'university' => 'Universitas Airlangga'
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@example.com',
                'program_slug' => 'bimbel-ukom-intensif',
                'rating' => 5,
                'comment' => 'Mentor sangat profesional dan sabar. Saya yang awalnya tidak percaya diri, sekarang lulus UKOM dengan nilai memuaskan! Program intensifnya sangat efektif.',
                'university' => 'Universitas Gadjah Mada'
            ],
            [
                'name' => 'Dewi Kartika',
                'email' => 'dewi.kartika@example.com',
                'program_slug' => 'cpns-p3k-skb',
                'rating' => 5,
                'comment' => 'Materinya update dan sesuai dengan kisi-kisi terbaru. Tryout online juga sangat membantu mengukur kemampuan saya. Sukses terus Bimbel Farmasi!',
                'university' => 'Universitas Hasanuddin'
            ],
            [
                'name' => 'Eko Prasetyo',
                'email' => 'eko.prasetyo@example.com',
                'program_slug' => 'bimbel-ukom-express',
                'rating' => 4,
                'comment' => 'Investasi terbaik untuk masa depan! Dengan mengikuti bimbel ini, saya jadi lebih siap dan yakin menghadapi UKOM. Program express cocok untuk yang butuh persiapan cepat.',
                'university' => 'Universitas Diponegoro'
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@example.com',
                'program_slug' => 'bimbel-ukom-d3-farmasi',
                'rating' => 5,
                'comment' => 'Sistem belajarnya fleksibel, cocok untuk yang masih kuliah. Materinya lengkap dan mudah dipahami. Alhamdulillah lulus dengan nilai bagus!',
                'university' => 'Universitas Brawijaya'
            ],
            [
                'name' => 'Rudi Hartono',
                'email' => 'rudi.hartono@example.com',
                'program_slug' => 'cpns-p3k-skd',
                'rating' => 5,
                'comment' => 'Bank soal SKD-nya sangat membantu! Prediksi soalnya akurat. Saya berhasil lolos passing grade dengan skor tinggi. Terima kasih!',
                'university' => 'Universitas Sumatera Utara'
            ],
        ];

        foreach ($testimonialData as $data) {
            // Buat atau ambil user
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => bcrypt('password123'),
                    'university' => $data['university'],
                    'phone' => '08' . rand(1000000000, 9999999999),
                ]
            );

            // Ambil program
            $program = Program::where('slug', $data['program_slug'])->first();

            if (!$program) {
                continue;
            }

            // Buat order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => $user->id,
                'program_id' => $program->id,
                'amount' => $program->price,
                'status' => 'completed',
            ]);

            // Buat payment
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'bank_transfer',
                'amount' => $program->price,
                'status' => 'paid',
                'paid_at' => now()->subDays(rand(7, 60)),
            ]);

            // Buat testimonial
            Testimonial::create([
                'user_id' => $user->id,
                'program_id' => $program->id,
                'order_id' => $order->id,
                'rating' => $data['rating'],
                'comment' => $data['comment'],
                'is_approved' => true,
            ]);
        }
    }
}
