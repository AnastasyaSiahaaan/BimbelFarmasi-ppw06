<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminClassController extends Controller
{
    public function index()
    {
        $programs = Program::withCount('orders')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.classes.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.classes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['slug'] = Str::slug($request->name);

        Program::create($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Program berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $program = Program::findOrFail($id);
        return view('admin.classes.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['slug'] = Str::slug($request->name);

        $program->update($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Program berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $program = Program::findOrFail($id);
        
        // Check if program has orders
        if ($program->orders()->count() > 0) {
            return redirect()->route('admin.classes.index')
                ->with('error', 'Tidak dapat menghapus program yang sudah memiliki pesanan!');
        }

        $program->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Program berhasil dihapus!');
    }
}
