<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Program;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::with('program');

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by program
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        // Filter by difficulty
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('question', 'like', '%' . $request->search . '%');
        }

        $questions = $query->orderBy('created_at', 'desc')->paginate(10);
        $programs = Program::where('is_active', true)->get();

        // Statistics
        $stats = [
            'total' => Question::count(),
            'farmakologi' => Question::where('category', 'Farmakologi')->count(),
            'farmasetika' => Question::where('category', 'Farmasetika')->count(),
            'kimia_farmasi' => Question::where('category', 'Kimia Farmasi')->count(),
        ];

        return view('admin.questions.index', compact('questions', 'programs', 'stats'));
    }

    public function create()
    {
        $programs = Program::where('is_active', true)->get();
        return view('admin.questions.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:A,B,C,D',
            'explanation' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'difficulty' => 'required|in:easy,medium,hard',
            'status' => 'required|in:active,inactive',
        ]);

        Question::create($validated);

        return redirect()->route('admin.questions.index')
            ->with('success', 'Soal berhasil ditambahkan!');
    }

    public function show($id)
    {
        $question = Question::with('program')->findOrFail($id);
        return view('admin.questions.show', compact('question'));
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $programs = Program::where('is_active', true)->get();
        return view('admin.questions.edit', compact('question', 'programs'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:A,B,C,D',
            'explanation' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'difficulty' => 'required|in:easy,medium,hard',
            'status' => 'required|in:active,inactive',
        ]);

        $question->update($validated);

        return redirect()->route('admin.questions.index')
            ->with('success', 'Soal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('admin.questions.index')
            ->with('success', 'Soal berhasil dihapus!');
    }
}
