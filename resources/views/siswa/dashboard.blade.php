<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Mata Pelajaran</h3>
                    <div class="space-y-8">
                        @forelse($courses as $course)
                            <div class="p-4 border rounded-lg">
                                <h4 class="text-xl font-semibold">{{ $course->name }}</h4>

                                <div class="mt-4">
                                    <h5 class="font-bold">Materi:</h5>
                                    @if($course->materials->count() > 0)
                                        <ul class="mt-2 list-disc list-inside">
                                            @foreach($course->materials as $material)
                                                <li>
                                                    <a href="{{ route('siswa.materials.show', $material) }}" class="text-blue-600 hover:underline">
                                                        {{ $material->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-gray-500 text-sm">Belum ada materi untuk mata pelajaran ini.</p>
                                    @endif
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-bold">Kuis:</h5>
                                    @if($course->quizzes->count() > 0)
                                        <ul class="mt-2 list-disc list-inside">
                                            @foreach($course->quizzes as $quiz)
                                                <li>
                                                    <a href="{{ route('siswa.quizzes.show', $quiz) }}" class="text-blue-600 hover:underline">
                                                        {{ $quiz->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-gray-500 text-sm">Belum ada kuis untuk mata pelajaran ini.</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p>Belum ada mata pelajaran yang tersedia.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>