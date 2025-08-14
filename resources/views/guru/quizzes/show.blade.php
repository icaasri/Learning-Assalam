<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Kuis: {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">Daftar Pertanyaan</h3>
                    <div class="mt-6 space-y-4">
                        @forelse($quiz->questions as $question)
                            <div class="p-4 border rounded-md">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold">{{ $loop->iteration }}. {{ $question->question_text }}</p>
                                        <ul class="mt-2 list-disc list-inside text-sm">
                                            @foreach($question->answers as $answer)
                                                <li class="{{ $answer->is_correct ? 'text-green-600 font-bold' : '' }}">
                                                    {{ $answer->answer_text }}
                                                    @if($answer->is_correct) (Jawaban Benar) @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="flex-shrink-0 ml-4">
                                        <a href="{{ route('guru.questions.edit', $question) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form action="{{ route('guru.questions.destroy', $question) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus pertanyaan ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">Belum ada pertanyaan untuk kuis ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            </div>
    </div>
</x-app-layout>