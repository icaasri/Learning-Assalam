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
                    <p class="mt-1 text-sm text-gray-600">
                        Di bawah ini adalah daftar pertanyaan untuk kuis ini.
                    </p>

                    <div class="mt-6">
                        {{-- Daftar pertanyaan akan ditampilkan di sini nanti --}}
                        @forelse($quiz->questions as $question)
                            <div class="mt-4 p-4 border rounded-md">
                                <p>{{ $loop->iteration }}. {{ $question->question_text }}</p>
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
                    {{-- Form untuk menambah pertanyaan akan kita buat di tahap selanjutnya --}}
                    <p class="mt-4 text-gray-500">Fitur untuk menambah pertanyaan akan diimplementasikan pada tahap berikutnya.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>