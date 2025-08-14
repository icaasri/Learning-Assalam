<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pertanyaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('guru.questions.update', $question) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="question_text" :value="__('Teks Pertanyaan')" />
                            <textarea id="question_text" name="question_text" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('question_text', $question->question_text) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('question_text')" />
                        </div>

                        <div>
                            <x-input-label :value="__('Pilihan Jawaban')" />
                            <div class="mt-2 space-y-2">
                                @foreach($question->answers as $index => $answer)
                                <div class="flex items-center space-x-2">
                                    <input type="radio" name="correct_answer" value="{{ $index }}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" required @checked($answer->is_correct)>
                                    <x-text-input type="text" name="answers[{{ $index }}][text]" class="block w-full" value="{{ $answer->answer_text }}" required />
                                </div>
                                @endforeach
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('answers')" />
                            <x-input-error class="mt-2" :messages="$errors->get('correct_answer')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Pertanyaan') }}</x-primary-button>
                            <a href="{{ route('guru.quizzes.show', $question->quiz_id) }}" class="text-gray-600 hover:underline">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>