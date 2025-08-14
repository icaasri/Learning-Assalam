<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Menyimpan pertanyaan baru beserta jawabannya.
     */
    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question_text' => 'required|string',
            'answers' => 'required|array|min:2', // Pastikan ada minimal 2 jawaban
            'answers.*.text' => 'required|string', // Setiap jawaban harus punya teks
            'correct_answer' => 'required|integer', // Index dari jawaban yang benar
        ]);

        // 1. Buat Pertanyaan
        $question = $quiz->questions()->create([
            'question_text' => $request->question_text,
        ]);

        // 2. Simpan Pilihan Jawaban
        foreach ($request->answers as $index => $answerData) {
            $question->answers()->create([
                'answer_text' => $answerData['text'],
                'is_correct' => ($index == $request->correct_answer),
            ]);
        }

        return back()->with('success', 'Pertanyaan berhasil ditambahkan.');
    }
}