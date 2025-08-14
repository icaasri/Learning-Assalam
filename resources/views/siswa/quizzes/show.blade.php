<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kuis: ') }} {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('siswa.quizzes.submit', $quiz) }}">
                        @csrf
                        <div class="space-y-8">
                            @foreach($quiz->questions as $question)
                                <div>
                                    <p class="font-semibold">{{ $loop->iteration }}. {{ $question->question_text }}</p>
                                    <div class="mt-4 space-y-2">
                                        @foreach($question->answers as $answer)
                                            <label for="answer-{{ $answer->id }}" class="flex items-center">
                                                <input type="radio" id="answer-{{ $answer->id }}" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                                <span class="ml-3 text-gray-700">{{ $answer->answer_text }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-8">
                            <x-primary-button>
                                {{ __('Selesai & Kirim Jawaban') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>