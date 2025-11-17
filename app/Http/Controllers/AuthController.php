<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Tampilkan form register
     */
    public function showRegisterForm()
    {
        // kamu tadi pakai view 'pages.register'
        return view('pages.register');
    }

    /**
     * Proses registrasi user baru (email + password biasa)
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'       => ['required', 'string', 'max:20'],
            'university'  => ['nullable', 'string', 'max:255'],
            'interest'    => ['nullable', 'string', 'max:255'],
            'password'    => ['required', 'confirmed', Password::min(8)],
        ], [
            'name.required'     => 'Nama lengkap wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Email sudah terdaftar.',
            'phone.required'    => 'Nomor handphone wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
            'password.min'      => 'Password minimal 8 karakter.',
        ]);

        // Buat user baru
        $user = User::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'phone'      => $validated['phone'],
            'university' => $validated['university'] ?? null,
            'interest'   => $validated['interest'] ?? null,
            'password'   => Hash::make($validated['password']),
            'is_admin'   => false,
        ]);

        // Auto login setelah daftar
        Auth::login($user);

        return redirect()->route('home')
            ->with('success', 'Pendaftaran berhasil! Selamat datang di Bimbel Farmasi.');
    }

    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        // kamu tadi pakai view 'pages.login'
        return view('pages.login');
    }

    /**
     * Proses login biasa (email + password)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Arahkan sesuai role
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended(route('home'))
                ->with('success', 'Selamat datang kembali!');
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak valid.',
        ])->onlyInput('email');
    }

    /**
     * LOGIN DENGAN GOOGLE
     * Step 1: redirect ke halaman OAuth Google
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * LOGIN DENGAN GOOGLE
     * Step 2: terima callback dari Google
     */
    public function handleGoogleCallback()
    {
        // Ambil data user dari Google
        $googleUser = Socialite::driver('google')->user();

        $email = $googleUser->getEmail();

        // Cek apakah email sudah pernah daftar (bisa dari register biasa atau Google)
        $user = User::where('email', $email)->first();

        if (! $user) {
            // Kalau belum ada, buat user baru minimal dengan name + email
            $user = User::create([
                'name'       => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Pengguna Google',
                'email'      => $email,
                'phone'      => null,
                'university' => null,
                'interest'   => null,
                // password random supaya field tidak kosong
                'password'   => Hash::make(Str::random(32)),
                'is_admin'   => false,
                // kalau kamu punya kolom google_id di tabel users, boleh tambahkan:
                // 'google_id'  => $googleUser->getId(),
            ]);
        } else {
            // Kalau mau, di sini kamu bisa update google_id tanpa mengganggu kolom lain
            // if (empty($user->google_id)) {
            //     $user->google_id = $googleUser->getId();
            //     $user->save();
            // }
        }

        // Login user
        Auth::login($user, true); // remember = true

        // Arahkan sama seperti login biasa
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->intended(route('home'))
            ->with('success', 'Berhasil login dengan Google!');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah keluar.');
    }
}
