<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hasil Kuis: {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <h3 class="text-2xl font-bold">Skor Anda</h3>
                    <p class="text-6xl font-extrabold mt-4 {{ $attempt->score >= 70 ? 'text-green-600' : 'text-red-600' }}">
                        {{ round($attempt->score) }}
                    </p>
                    <p class="text-gray-600 mt-2">dari 100</p>
                    <a href="{{ route('siswa.dashboard') }}" class="mt-8 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>