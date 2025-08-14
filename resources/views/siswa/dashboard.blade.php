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
                    <h3 class="text-2xl font-bold mb-4">Mata Pelajaran Anda</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($courses as $course)
                            <div class="p-6 border rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                                <h4 class="text-xl font-semibold">{{ $course->name }}</h4>
                                <p class="text-gray-600 mt-2 h-16">{{ Str::limit($course->description, 100) }}</p>
                                <div class="mt-4">
                                    <a href="{{ route('siswa.courses.show', $course) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                                        Masuk Kelas
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-3 text-center text-gray-500">Anda belum ditugaskan ke mata pelajaran manapun.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>