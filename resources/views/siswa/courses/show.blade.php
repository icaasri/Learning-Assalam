<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mata Pelajaran: {{ $course->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-gray-600 mb-6">{{ $course->description }}</p>

                    <h3 class="text-xl font-bold mb-4">Alur Pembelajaran</h3>
                    <div class="space-y-4">
                        @forelse($learningItems as $item)
                            @if($item instanceof \App\Models\Material)
                                <div class="flex items-center justify-between p-4 border rounded-lg">
                                    <div class="flex items-center">
                                        @if($completedMaterials->contains($item->id))
                                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <span class="font-medium text-gray-500">{{ $item->title }}</span>
                                        @else
                                            <svg class="w-6 h-6 text-gray-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                                            <span class="font-medium">{{ $item->title }}</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('siswa.materials.show', $item) }}" class="text-sm text-blue-600 hover:underline">Lihat Materi</a>
                                </div>
                            @elseif($item instanceof \App\Models\Quiz)
                                <div class="flex items-center justify-between p-4 border rounded-lg bg-blue-50">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-blue-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.546-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="font-medium text-blue-800">{{ $item->title }}</span>
                                    </div>
                                    <a href="{{ route('siswa.quizzes.show', $item) }}" class="text-sm text-blue-600 hover:underline">Kerjakan Kuis</a>
                                </div>
                            @endif
                        @empty
                            <p class="text-gray-500">Belum ada materi atau kuis di mata pelajaran ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>