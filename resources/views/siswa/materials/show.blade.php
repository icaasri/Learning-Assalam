<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $material->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">{{ $material->title }}</h3>
                    <p class="text-sm text-gray-500 mb-4">Mata Pelajaran: {{ $material->course->name }}</p>

                    <div class="prose max-w-none">
                        {!! nl2br(e($material->content)) !!}
                    </div>

                    @if($material->video_url)
                        <div class="mt-8">
                            <h4 class="text-xl font-semibold mb-2">Video Pembelajaran</h4>
                            @php
                                $embedUrl = str_replace('watch?v=', 'embed/', $material->video_url);
                            @endphp
                            <iframe class="w-full aspect-video rounded-lg" src="{{ $embedUrl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    @endif

                    @if($material->file_path)
                        <div class="mt-8">
                            <h4 class="text-xl font-semibold mb-2">File Lampiran</h4>
                            <a href="{{ asset('storage/' . $material->file_path) }}" download class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                                Download Materi
                            </a>
                        </div>
                    @endif

                    <div class="mt-8 flex justify-between items-center">
                        <a href="{{ route('siswa.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Kembali ke Dashboard
                        </a>

                        @if(!$isCompleted)
                            <form method="POST" action="{{ route('siswa.materials.complete', $material) }}">
                                @csrf
                                <x-primary-button>
                                    {{ __('Tandai Telah Dibaca') }}
                                </x-primary-button>
                            </form>
                        @else
                            <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 text-xs font-medium rounded-md">
                                ✓ Sudah Selesai
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>