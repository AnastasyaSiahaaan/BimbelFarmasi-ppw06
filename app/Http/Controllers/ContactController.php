<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Here you can add logic to:
        // 1. Save to database
        // 2. Send email notification
        // 3. Log the contact form submission
        // For now, we'll just redirect back with success message

        return redirect()->route('kontak')->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}
