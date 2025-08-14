<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Siswa') }}
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
                    <h3 class="text-2xl font-bold mb-4">Mata Pelajaran</h3>
                    <div class="space-y-8">
                        @php
                            $completedMaterials = auth()->user()->materialProgresses->pluck('material_id');
                        @endphp
                        @forelse($courses as $course)
                            <div class="p-4 border rounded-lg">
                                <h4 class="text-xl font-semibold">{{ $course->name }}</h4>

                                <div class="mt-4">
                                    <h5 class="font-bold">Materi:</h5>
                                    @if($course->materials->count() > 0)
                                        <ul class="mt-2 list-inside space-y-1">
                                            @foreach($course->materials as $material)
                                                <li class="flex items-center">
                                                    @if($completedMaterials->contains($material->id))
                                                        <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        <span class="text-gray-500">{{ $material->title }}</span>
                                                    @else
                                                        <a href="{{ route('siswa.materials.show', $material) }}" class="text-blue-600 hover:underline">
                                                            {{ $material->title }}
                                                        </a>
                                                    @endif
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