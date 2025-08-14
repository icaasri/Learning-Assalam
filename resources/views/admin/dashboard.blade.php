<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-500">Total Siswa</h3>
                        <p class="mt-1 text-3xl font-semibold">{{ $totalSiswa }}</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-500">Total Guru</h3>
                        <p class="mt-1 text-3xl font-semibold">{{ $totalGuru }}</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-500">Total Mata Pelajaran</h3>
                        <p class="mt-1 text-3xl font-semibold">{{ $totalCourses }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>