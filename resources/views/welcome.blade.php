<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CookLens - Ubah Bahan Makanan Menjadi Masakan Lezat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-[#fcf9f8] text-gray-900 font-['Nunito_Sans']">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 bg-[#fcf9f8] border-b-3 border-gray-400 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 md:py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('img/cooklens-app.png') }}" alt="CookLens" class="h-15">
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('register') }}"
                        class="text-white rounded-md text-sm font-bold bg-green-500 px-4 py-2 shadow-[5px_5px_0px_rgba(0,0,0,1)] border-3 border-black">
                        Register
                    </a>
                    <a href="{{ route('login') }}"
                        class="text-white rounded-md text-sm font-bold bg-green-500 px-4 py-2 shadow-[5px_5px_0px_rgba(0,0,0,1)] border-3 border-black  ">
                        Log in
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-16 px-4 sm:px-6 lg:px-8 h-screen">
        <div class="max-w-6xl mx-auto h-full flex justify-center">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-12 items-center">
                <!-- Hero Content -->
                <div class="flex flex-col items-end md:items-start w-full order-2 md:order-1">
                    <div
                        class="bg-orange-400 text-black px-4 py-2 rounded-full text-sm font-semibold mb-6 border-3 border-black shadow-[5px_5px_0px_rgba(0,0,0,1)] flex items-center justify-center gap-2">
                        <x-hugeicons-ai-brain-03 /> AI Kitchen Assistant
                    </div>

                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Ubah <span class="text-green-500">Bahan Makanan</span> Menjadi Masakan Lezat
                    </h1>

                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Unggah foto bahan makananmu dan biarkan AI kami menemukanmu resep yang bisa langsung dimasak.
                        Tidak perlu lagi binggu mau masak apa hari ini!
                    </p>

                    <div class="self-start">
                        <a href="{{ route('login') }}"
                            class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-md font-bold shadow-[5px_5px_0px_rgba(0,0,0,1)] border-3 border-black  text-center flex items-center gap-2">
                            <x-heroicon-o-camera class="w-7" />Analisis Bahan
                        </a>
                    </div>
                </div>

                <!-- Hero Image -->
                <div
                    class="rounded-2xl flex items-center justify-center aspect-square max-w-90 md:max-w-full w-full overflow-hidden border-4 border-black shadow-[5px_5px_0px_rgba(0,0,0,1)] mx-auto order-1 md:order-2">
                    <img src="{{ asset('img/hero.png') }}" alt="Hero Image" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <hr class="border-gray-400 border-3">

    <!-- Features Section -->
    <section id="features" class="py-16 md:py-32 px-4 sm:px-6 lg:px-8 bg-[#fcf9f8]">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center mb-4">Fitur Andalan CookLens</h2>
            <p class="text-center text-gray-600 mb-12 text-lg">Tiga langkah mudah menuju perut kenyang.</p>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div
                    class="bg-white rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)] text-center">
                    <div
                        class="w-16 h-16 bg-green-400 border-3 border-black shadow-[4px_4px_0px_rgba(0,0,0,1)] rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-3xl">📸</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Unggah Bahan</h3>
                    <p class="text-gray-600">
                        Foto isi kulkas atau bahan yang ada di mejamu. Semakin banyak, semakin seru!
                    </p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="bg-white rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)] text-center">
                    <div
                        class="w-16 h-16 bg-orange-400 border-3 border-black shadow-[4px_4px_0px_rgba(0,0,0,1)] rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-3xl">🤖</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">AI Memahami Bahan</h3>
                    <p class="text-gray-600">
                        CookLens mengenali setiap tomat dan wortel dengan presisi ajaib.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="bg-white rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)] text-center">
                    <div
                        class="w-16 h-16 bg-pink-400 border-3 border-black shadow-[4px_4px_0px_rgba(0,0,0,1)] rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-3xl">🍳</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Rekomendasi Resep</h3>
                    <p class="text-gray-600">
                        Dapatkan daftar resep lezat yang bisa langsung kamu masak tanpa belanja lagi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <hr class="border-gray-400 border-3">

    <!-- How It Works Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-[#fcf9f8]">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <!-- Timeline -->
                <div class="relative order-2 md:order-1">
                    <div
                        class="bg-white rounded-3xl border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)] py-10 pr-8 pl-14 ml-6">
                        <div class="flex flex-col gap-10">

                            <!-- Step 1 -->
                            <div class="flex items-center gap-5 relative">
                                <div
                                    class="absolute -left-19 w-10 h-10 bg-[#1a6b41] border-3 border-black rounded-full flex items-center justify-center shadow-[3px_3px_0px_rgba(0,0,0,1)] text-white font-bold">
                                    1
                                </div>
                                <div
                                    class="bg-white border-3 border-black shadow-[4px_4px_0px_rgba(0,0,0,1)] rounded-xl p-3 flex items-center gap-4 w-full">
                                    <div
                                        class="w-12 h-12 rounded-lg border-2 border-black shadow-[2px_2px_0px_rgba(0,0,0,1)] overflow-hidden shrink-0">
                                        <img src="{{ asset('img/hero.png') }}" alt="Unggah Foto"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-900">Unggah Foto</h3>
                                        <p class="text-gray-600 text-sm">Jepret bahan makananmu.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="flex items-center gap-5 relative">
                                <div
                                    class="absolute -left-19 w-10 h-10 bg-[#fbbd23] border-3 border-black rounded-full flex items-center justify-center shadow-[3px_3px_0px_rgba(0,0,0,1)] text-black font-bold">
                                    2
                                </div>
                                <div
                                    class="bg-white border-3 border-black shadow-[4px_4px_0px_rgba(0,0,0,1)] rounded-xl p-3 flex items-center gap-4 w-full">
                                    <div
                                        class="w-12 h-12 bg-[#ffe6cc] rounded-lg border-2 border-black shadow-[2px_2px_0px_rgba(0,0,0,1)] flex items-center justify-center text-2xl shrink-0">
                                        <span class="text-[#b46b2b]">🧠</span>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-900">AI Deteksi</h3>
                                        <p class="text-gray-600 text-sm">Sistem mengenali 5 bahan dasar.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div class="flex items-center gap-5 relative">
                                <div
                                    class="absolute -left-19 w-10 h-10 bg-[#ff8a8a] border-3 border-black rounded-full flex items-center justify-center shadow-[3px_3px_0px_rgba(0,0,0,1)] text-black font-bold">
                                    3
                                </div>
                                <div
                                    class="bg-white border-3 border-black shadow-[4px_4px_0px_rgba(0,0,0,1)] rounded-xl p-3 flex items-center gap-4 w-full">
                                    <div
                                        class="w-12 h-12 bg-[#86efac] rounded-lg border-2 border-black flex items-center justify-center shadow-[2px_2px_0px_rgba(0,0,0,1)] text-2xl shrink-0">
                                        🍴
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-900">Temukan Resep</h3>
                                        <p class="text-gray-600 text-sm">Siap dimasak dalam 15 menit!</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Text Content -->
                <div class="pl-4 order-1 md:order-2">
                    <h2 class="text-5xl font-bold mb-6 text-gray-900 leading-tight">Cara Kerja</h2>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                        Hanya butuh beberapa detik dari foto bahan makanan hingga menemukan resep yang menggugah selera.
                        Asisten AI kami bekerja di balik layar untuk memastikan kamu memasak hidangan terbaik.
                    </p>
                    <a href="#"
                        class="inline-flex items-center gap-2 bg-[#2a2a2a] text-white px-6 py-3 rounded-lg font-bold shadow-[4px_4px_0px_rgba(0,0,0,1)] hover:-translate-y-1 transition-transform border-2 border-black">
                        Cobain Sekarang <span class="text-xl">→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 px-4 sm:px-6 lg:px-8">

        <p class="text-center text-sm">
            &copy; 2026 CookLens. All rights reserved.
        </p>
    </footer>
</body>

</html>