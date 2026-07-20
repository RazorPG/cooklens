<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CookLens - @yield('title', 'Dashboard')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-[#fcf9f8] text-gray-900 font-['Nunito_Sans'] min-h-screen flex flex-col">

    <x-alert floating type="success" :message="session('status')" />

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 bg-[#fcf9f8] border-b-3 border-gray-400 z-50 px-4 md:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto py-2 md:py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('img/cooklens-app.png') }}" alt="CookLens" class="md:h-15 h-10">
                    </a>
                </div>

                <div class="flex items-center gap-6 text-sm md:text-base">
                    <a href="{{ route('dashboard') }}"
                        class="font-bold text-gray-700 hover:text-green-500 {{ request()->routeIs('dashboard') ? 'text-green-500' : '' }}">Dashboard</a>
                    <a href="{{ route('analisis') }}"
                        class="font-bold text-gray-700 hover:text-green-500 {{ request()->routeIs('analisis') ? 'text-green-500' : '' }}">Analisis</a>
                    <a href="{{ route('riwayat') }}"
                        class="font-bold text-gray-700 hover:text-green-500 {{ request()->routeIs('riwayat*') ? 'text-green-500' : '' }}">Riwayat</a>

                    <form method="POST" action="{{ route('logout') }}" class="inline m-0">
                        @csrf
                        <button type="submit"
                            class="text-white rounded-md text-sm font-bold bg-red-500 hover:bg-red-600 px-4 py-2 shadow-[5px_5px_0px_rgba(0,0,0,1)] border-3 border-black transition-all active:shadow-none active:translate-y-1 active:translate-x-1">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-32 pb-16 px-4 sm:px-6 lg:px-8 flex-1">
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 px-4 sm:px-6 lg:px-8">
        <p class="text-center text-sm">
            &copy; {{ date('Y') }} CookLens. All rights reserved.
        </p>
    </footer>

    @stack('scripts')
</body>

</html>