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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('img/cooklens-app.png') }}" alt="CookLens" class="h-15">
                </div>

                <div class="flex items-center gap-4">
                    <a href="#"
                        class="text-white rounded-md text-sm font-bold bg-green-500 px-4 py-2 shadow-[5px_5px_0px_rgba(0,0,0,1)] border-3 border-black">
                        Register
                    </a>
                    <a href="#"
                        class="text-white rounded-md text-sm font-bold bg-green-500 px-4 py-2 shadow-[5px_5px_0px_rgba(0,0,0,1)] border-3 border-black  ">
                        Log in
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Hero Content -->
                <div>
                    <div
                        class="inline-block bg-orange-400 text-black px-4 py-2 rounded-full text-sm font-semibold mb-6 border-3 border-black shadow-[5px_5px_0px_rgba(0,0,0,1)]">
                        ⚡ AI Kitchen Assistant
                    </div>

                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Ubah <span class="text-green-500">Bahan Makanan</span> Menjadi Masakan Lezat
                    </h1>

                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Unggah foto bahan makananmu dan biarkan AI kami menemukanmu resep yang bisa langsung dimasak.
                        Tidak perlu lagi binggu mau masak apa hari ini!
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#"
                            class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-md font-bold shadow-[5px_5px_0px_rgba(0,0,0,1)] border-3 border-black  text-center">
                            Analisis Bahan
                        </a>
                    </div>
                </div>

                <!-- Hero Image -->
                <div
                    class="rounded-2xl flex items-center justify-center aspect-square overflow-hidden border-4 border-black shadow-[5px_5px_0px_rgba(0,0,0,1)]">
                    <img src="{{ asset('img/hero.png') }}" alt="Hero Image" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center mb-4">Fitur Andalanku CookLens</h2>
            <p class="text-center text-gray-600 mb-12 text-lg">Tiga langkah mudah menuju perut yang senang</p>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                        <span class="text-3xl">📸</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Unggah Bahan</h3>
                    <p class="text-gray-600">
                        Foto id kulkas atau bahan yang ada di dapur. Semakin banyak, semakin seru!
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-6">
                        <span class="text-3xl">🤖</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">AI Memahami Bahan</h3>
                    <p class="text-gray-600">
                        CookLens menganalisis setiap tomati dan wortel dengan presisi ajaib.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-6">
                        <span class="text-3xl">🍽️</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Rekomendasi Resep</h3>
                    <p class="text-gray-600">
                        Dapatkan daftar resep lezat yang bisa langsung dimasak tanpa belanja lagi!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12">Cara Kerja yang Ajaib</h2>

            <div class="bg-white rounded-2xl p-12 shadow-lg">
                <div class="grid md:grid-cols-4 gap-8">
                    <!-- Step 1 -->
                    <div class="text-center">
                        <div
                            class="w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">
                            1
                        </div>
                        <h3 class="font-bold text-lg mb-2">Unggah Foto</h3>
                        <p class="text-gray-600 text-sm">
                            Ambil foto bahan makananmu
                        </p>
                    </div>

                    <!-- Arrow -->
                    <div class="flex items-center justify-center">
                        <div class="text-green-500 text-3xl hidden md:block">→</div>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center">
                        <div
                            class="w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">
                            2
                        </div>
                        <h3 class="font-bold text-lg mb-2">AI Deteksi</h3>
                        <p class="text-gray-600 text-sm">
                            Sistem mengenali 5 bahan dasar
                        </p>
                    </div>

                    <!-- Arrow -->
                    <div class="flex items-center justify-center">
                        <div class="text-green-500 text-3xl hidden md:block">→</div>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center">
                        <div
                            class="w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">
                            3
                        </div>
                        <h3 class="font-bold text-lg mb-2">Temukan Resep</h3>
                        <p class="text-gray-600 text-sm">
                            Siap dimasak dalam 15 menit!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-12">Alur Penggunaan CookLens</h2>

            <div class="space-y-8">
                <!-- Timeline Item 1 -->
                <div class="flex gap-6">
                    <div class="flex flex-col items-center">
                        <div
                            class="w-12 h-12 bg-green-500 text-white rounded-full flex items-center justify-center font-bold">
                            ✓
                        </div>
                        <div class="w-1 h-12 bg-green-200 mt-4"></div>
                    </div>
                    <div class="pb-8">
                        <h3 class="text-lg font-bold mb-2">Unggah Foto</h3>
                        <p class="text-gray-600">
                            Ambil foto bahan makananmu dari kulkas atau yang ada di dapur. Semakin banyak bahan, semakin
                            banyak pilihan resep!
                        </p>
                    </div>
                </div>

                <!-- Timeline Item 2 -->
                <div class="flex gap-6">
                    <div class="flex flex-col items-center">
                        <div
                            class="w-12 h-12 bg-green-500 text-white rounded-full flex items-center justify-center font-bold">
                            ✓
                        </div>
                        <div class="w-1 h-12 bg-green-200 mt-4"></div>
                    </div>
                    <div class="pb-8">
                        <h3 class="text-lg font-bold mb-2">AI Deteksi</h3>
                        <p class="text-gray-600">
                            Sistem AI kami menganalisis setiap item dalam foto dan mengenali jenis bahan makanannya
                            dengan akurasi tinggi.
                        </p>
                    </div>
                </div>

                <!-- Timeline Item 3 -->
                <div class="flex gap-6">
                    <div class="flex flex-col items-center">
                        <div
                            class="w-12 h-12 bg-green-500 text-white rounded-full flex items-center justify-center font-bold">
                            ✓
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-2">Temukan Resep</h3>
                        <p class="text-gray-600">
                            Dapatkan daftar resep yang bisa dibuat dengan bahan-bahan yang sudah terdeteksi. Pilih yang
                            paling menarik dan masak!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-green-500 to-green-600">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Siap Mulai Memasak?</h2>
            <p class="text-xl text-green-50 mb-8">
                Bergabunglah dengan ribuan pengguna yang sudah mencoba CookLens
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#"
                    class="bg-white text-green-600 hover:bg-gray-100 px-8 py-4 rounded-full font-semibold transition text-center">
                    Daftar Sekarang
                </a>
                <a href="#features"
                    class="border-2 border-white text-white hover:bg-green-700 px-8 py-4 rounded-full font-semibold transition text-center">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 px-4 sm:px-6 lg:px-8">

        <p class="text-center text-sm">
            &copy; 2026 CookLens. All rights reserved.
        </p>
    </footer>
</body>

</html>