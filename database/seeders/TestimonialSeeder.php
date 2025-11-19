<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Models\User;
use App\Models\Program;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        // === Buat user dummy dari kedua versi ===
        $users = [
            [
                'email' => 'sarah.amelia@example.com',
                'name' => 'Sarah Amelia',
                'university' => 'Universitas Indonesia',
                'phone' => '081234567000'
            ],
            [
                'email' => 'budi.santoso@example.com',
                'name' => 'Budi Santoso',
                'university' => 'Universitas Padjadjaran',
                'phone' => '081234567001'
            ],
            [
                'email' => 'rina.widya@example.com',
                'name' => 'Rina Widya',
                'university' => 'Universitas Airlangga',
                'phone' => '081234567002'
            ],
            [
                'email' => 'ahmad.fauzi@example.com',
                'name' => 'Ahmad Fauzi',
                'university' => 'Universitas Gadjah Mada',
                'phone' => '081234567003'
            ],
            [
                'email' => 'dewi.kartika@example.com',
                'name' => 'Dewi Kartika',
                'university' => 'Universitas Hasanuddin',
                'phone' => '081234567004'
            ],
            [
                'email' => 'eko.prasetyo@example.com',
                'name' => 'Eko Prasetyo',
                'university' => 'Universitas Diponegoro',
                'phone' => '081234567005'
            ],
            [
                'email' => 'siti.nurhaliza@example.com',
                'name' => 'Siti Nurhaliza',
                'university' => 'Universitas Brawijaya',
                'phone' => '081234567006'
            ],
            [
                'email' => 'rudi.hartono@example.com',
                'name' => 'Rudi Hartono',
                'university' => 'Universitas Sumatera Utara',
                'phone' => '081234567007'
            ],
        ];

        $createdUsers = [];

        foreach ($users as $u) {
            $createdUsers[] = User::firstOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => bcrypt('password123'),
                    'phone' => $u['phone'],
                    'university' => $u['university'] ?? null,
                ]
            );
        }

        // === Data testimoni (gabungan layanan + main) ===
        $testimonials = [
            [
                'email' => 'sarah.amelia@example.com',
                'program_slug' => 'bimbel-ukom-d3-farmasi',
                'rating' => 5,
                'comment' => 'Alhamdulillah lulus UKOM di percobaan pertama! Materinya lengkap dan mudah dipahami.',
            ],
            [
                'email' => 'budi.santoso@example.com',
                'program_slug' => 'cpns-p3k-farmasi',
                'rating' => 5,
                'comment' => 'Sangat membantu persiapan CPNS! Soal mirip aslinya.',
            ],
            [
                'email' => 'rina.widya@example.com',
                'program_slug' => 'joki-tugas-farmasi',
                'rating' => 5,
                'comment' => 'Tugas dikerjakan sangat baik dan tepat waktu.',
            ],
            [
                'email' => 'ahmad.fauzi@example.com',
                'program_slug' => 'bimbel-ukom-intensif',
                'rating' => 5,
                'comment' => 'Mentor profesional dan sabar. Lulus UKOM!',
            ],
            [
                'email' => 'dewi.kartika@example.com',
                'program_slug' => 'cpns-p3k-skb',
                'rating' => 5,
                'comment' => 'Materi update dan sesuai kisi-kisi terbaru.',
            ],
            [
                'email' => 'eko.prasetyo@example.com',
                'program_slug' => 'bimbel-ukom-express',
                'rating' => 4,
                'comment' => 'Investasi terbaik untuk masa depan.',
            ],
            [
                'email' => 'siti.nurhaliza@example.com',
                'program_slug' => 'bimbel-ukom-d3-farmasi',
                'rating' => 5,
                'comment' => 'Sistem belajar fleksibel dan mudah dipahami.',
            ],
            [
                'email' => 'rudi.hartono@example.com',
                'program_slug' => 'cpns-p3k-skd',
                'rating' => 5,
                'comment' => 'Bank soal SKD sangat membantu! Lolos passing grade.',
            ],
        ];

        foreach ($testimonials as $t) {
            $user = User::where('email', $t['email'])->first();
            $program = Program::where('slug', $t['program_slug'])->first();

            if (!$program || !$user) {
                continue;
            }

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'program_id' => $program->id,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'amount' => $program->price,
                'status' => 'completed',
            ]);

            // Create payment
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'bank_transfer',
                'amount' => $program->price,
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            // Create testimonial
            Testimonial::create([
                'user_id' => $user->id,
                'program_id' => $program->id,
                'order_id' => $order->id,
                'rating' => $t['rating'],
                'comment' => $t['comment'],
                'is_approved' => true,
            ]);
        }

        $this->command->info('Testimonials seeded successfully!');
    }
}
