<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Show user profile page
     */
    public function profile()
    {
        return view('pages.profile', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'max:20'],
            'university' => ['nullable', 'string', 'max:255'],
            'interest' => ['nullable', 'string', 'max:255'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'phone.required' => 'Nomor handphone wajib diisi.',
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Show my services page (purchased programs)
     */
    public function myServices()
    {
        // TODO: Get user's enrolled programs from database
        // For now, using sample data
        $enrollments = [
            [
                'id' => 1,
                'program' => 'Bimbel UKOM D3 Farmasi - Reguler',
                'status' => 'active',
                'start_date' => '2025-09-15',
                'end_date' => '2026-01-15',
                'progress' => 65,
                'total_sessions' => 24,
                'completed_sessions' => 16,
            ],
            [
                'id' => 2,
                'program' => 'CPNS & P3K Farmasi - Paket Lengkap',
                'status' => 'active',
                'start_date' => '2025-10-01',
                'end_date' => '2026-03-01',
                'progress' => 30,
                'total_sessions' => 30,
                'completed_sessions' => 9,
            ],
            [
                'id' => 3,
                'program' => 'Joki Tugas - Basic Package',
                'status' => 'completed',
                'start_date' => '2025-08-01',
                'end_date' => '2025-08-31',
                'progress' => 100,
                'total_sessions' => 5,
                'completed_sessions' => 5,
            ],
        ];

        return view('pages.my-services', compact('enrollments'));
    }

    /**
     * Show transaction history
     */
    public function transactions()
    {
        // TODO: Get user's transactions from database
        // For now, using sample data
        $transactions = [
            [
                'id' => 'TRX-2025-001',
                'date' => '2025-10-01',
                'program' => 'CPNS & P3K Farmasi - Paket Lengkap',
                'amount' => 2050000,
                'status' => 'paid',
                'payment_method' => 'Bank Transfer',
                'invoice_url' => '#',
            ],
            [
                'id' => 'TRX-2025-002',
                'date' => '2025-09-15',
                'program' => 'Bimbel UKOM D3 Farmasi - Reguler',
                'amount' => 1250000,
                'status' => 'paid',
                'payment_method' => 'E-Wallet',
                'invoice_url' => '#',
            ],
            [
                'id' => 'TRX-2025-003',
                'date' => '2025-08-01',
                'program' => 'Joki Tugas - Basic Package',
                'amount' => 500000,
                'status' => 'paid',
                'payment_method' => 'Bank Transfer',
                'invoice_url' => '#',
            ],
        ];

        return view('pages.transactions', compact('transactions'));
    }

    /**
     * Show settings page
     */
    public function settings()
    {
        return view('pages.settings', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }

    /**
     * Delete account
     */
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ], [
            'password.required' => 'Password wajib diisi untuk konfirmasi.',
            'password.current_password' => 'Password tidak sesuai.',
        ]);

        /** @var User $user */
        $user = Auth::user();
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $user->delete();

        return redirect()->route('home')->with('success', 'Akun Anda telah dihapus.');
    }
}
