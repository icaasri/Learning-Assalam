<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Kuis: {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">Daftar Pertanyaan</h3>
                    <div class="mt-6 space-y-4">
                        @forelse($quiz->questions as $question)
                            <div class="p-4 border rounded-md">
                                <p class="font-semibold">{{ $loop->iteration }}. {{ $question->question_text }}</p>
                                <ul class="mt-2 list-disc list-inside">
                                    @foreach($question->answers as $answer)
                                        <li class="{{ $answer->is_correct ? 'text-green-600 font-bold' : '' }}">
                                            {{ $answer->answer_text }}
                                            @if($answer->is_correct)
                                                (Jawaban Benar)
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @empty
                            <p class="text-gray-500">Belum ada pertanyaan untuk kuis ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">Tambah Pertanyaan Baru</h3>

                    <form method="POST" action="{{ route('guru.quizzes.questions.store', $quiz) }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="question_text" :value="__('Teks Pertanyaan')" />
                            <textarea id="question_text" name="question_text" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('question_text') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('question_text')" />
                        </div>

                        <div>
                            <x-input-label :value="__('Pilihan Jawaban')" />
                            <div class="mt-2 space-y-2" id="answers-container">
                                <div class="flex items-center space-x-2">
                                    <input type="radio" name="correct_answer" value="0" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" required>
                                    <x-text-input type="text" name="answers[0][text]" class="block w-full" placeholder="Pilihan Jawaban 1" required />
                                </div>
                                <div class="flex items-center space-x-2">
                                    <input type="radio" name="correct_answer" value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                    <x-text-input type="text" name="answers[1][text]" class="block w-full" placeholder="Pilihan Jawaban 2" required />
                                </div>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('answers')" />
                            <x-input-error class="mt-2" :messages="$errors->get('correct_answer')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Pertanyaan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>