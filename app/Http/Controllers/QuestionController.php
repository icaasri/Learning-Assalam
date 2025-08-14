<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini

class QuestionController extends Controller
{
    // ... (method store tidak berubah)
    public function store(Request $request, Quiz $quiz)
    {
        // Otorisasi: Pastikan guru terdaftar di mata pelajaran kuis ini
        if (!Auth::user()->courses()->find($quiz->course_id)) {
            abort(403);
        }

        $request->validate([
            'question_text' => 'required|string',
            'answers' => 'required|array|min:2',
            'answers.*.text' => 'required|string',
            'correct_answer' => 'required|integer',
        ]);

        $question = $quiz->questions()->create([
            'question_text' => $request->question_text,
        ]);

        foreach ($request->answers as $index => $answerData) {
            $question->answers()->create([
                'answer_text' => $answerData['text'],
                'is_correct' => ($index == $request->correct_answer),
            ]);
        }

        return back()->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    // --- TAMBAHKAN METHOD BARU DI BAWAH INI ---

    public function edit(Question $question)
    {
        // Otorisasi
        if (!Auth::user()->courses()->find($question->quiz->course_id)) {
            abort(403);
        }

        $question->load('answers');
        return view('guru.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        // Otorisasi
        if (!Auth::user()->courses()->find($question->quiz->course_id)) {
            abort(403);
        }

        $request->validate([
            'question_text' => 'required|string',
            'answers' => 'required|array|min:2',
            'answers.*.text' => 'required|string',
            'correct_answer' => 'required|integer',
        ]);

        // Update pertanyaan
        $question->update(['question_text' => $request->question_text]);

        // Hapus jawaban lama dan buat yang baru (cara paling sederhana)
        $question->answers()->delete();

        foreach ($request->answers as $index => $answerData) {
            $question->answers()->create([
                'answer_text' => $answerData['text'],
                'is_correct' => ($index == $request->correct_answer),
            ]);
        }

        return redirect()->route('guru.quizzes.show', $question->quiz_id)->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroy(Question $question)
    {
        // Otorisasi
        if (!Auth::user()->courses()->find($question->quiz->course_id)) {
            abort(403);
        }

        $quizId = $question->quiz_id;
        $question->delete();

        return redirect()->route('guru.quizzes.show', $quizId)->with('success', 'Pertanyaan berhasil dihapus.');
    }
}