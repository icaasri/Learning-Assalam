<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Penugasan untuk: ') }} {{ $course->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.assignments.update', $course) }}">
                @csrf
                @method('PUT')
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-6">
                            <h3 class="text-lg font-medium">Guru</h3>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach($teachers as $teacher)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="users[]" value="{{ $teacher->id }}" class="rounded" @checked(in_array($teacher->id, $assignedUsers))>
                                        <span class="ml-2">{{ $teacher->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium">Siswa</h3>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach($students as $student)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="users[]" value="{{ $student->id }}" class="rounded" @checked(in_array($student->id, $assignedUsers))>
                                        <span class="ml-2">{{ $student->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>