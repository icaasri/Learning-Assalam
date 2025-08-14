<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <div class="flex">
                <aside class="w-64 bg-gray-800 text-white min-h-screen p-4 flex flex-col">
                    <div class="mb-8 text-center">
                        <a href="{{ route('dashboard') }}" class="flex flex-col items-center">
                           <img src="{{ asset('images/smk.png') }}" alt="Logo" class="w-20 h-20 mb-2">
                           <span class="text-lg font-semibold text-yellow-400">Learning As Salam</span>
                        </a>
                    </div>
                    <nav class="flex-grow">
                        @if(auth()->user()->role === 'admin')
                            @include('layouts.partials.admin-nav')
                        @elseif(auth()->user()->role === 'guru')
                            @include('layouts.partials.guru-nav')
                        @else
                            @include('layouts.partials.siswa-nav')
                        @endif
                    </nav>
                </aside>

                <div class="flex-1">
                    @include('layouts.navigation')

                    @if (isset($header))
                        <header class="bg-white shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endif

                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>