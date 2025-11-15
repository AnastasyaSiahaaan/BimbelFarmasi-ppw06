<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing admin if any
        User::where('email', 'admin@bimbelfarmasi.com')->delete();

        // Create default admin account
        $admin = User::create([
            'name' => 'Admin Bimbel Farmasi',
            'email' => 'admin@bimbelfarmasi.com',
            'password' => Hash::make('admin123'),
            'is_admin' => 1,
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Admin account created successfully!');
        $this->command->info('📧 Email: admin@bimbelfarmasi.com');
        $this->command->info('🔑 Password: admin123');
        $this->command->info('👤 Name: ' . $admin->name);
        $this->command->info('🔐 Is Admin: ' . ($admin->is_admin ? 'Yes' : 'No'));
    }
}
