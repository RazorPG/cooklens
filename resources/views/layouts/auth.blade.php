<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @hasSection('title')
            @yield('title') | {{ config('app.name', 'CookLens') }}
        @else
            {{ config('app.name', 'CookLens') }}
        @endif
    </title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @stack('styles')
</head>

<body class="flex min-h-screen flex-col overflow-hidden bg-[#f9fafb] text-gray-900 font-['Nunito_Sans']">
    <main class="relative flex justify-center items-center flex-1 overflow-hidden">

        <div class="relative mx-auto flex h-full w-full max-w-7xl items-center px-4 py-8">
            <div class="grid w-full gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                @yield('left')

                @yield('right')
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="shrink-0 bg-gray-900 px-4 py-8 text-gray-400 sm:px-6 lg:px-8">
        <p class="text-center text-sm">
            &copy; 2026 CookLens. All rights reserved.
        </p>
    </footer>

    @stack('scripts')
</body>

</html>