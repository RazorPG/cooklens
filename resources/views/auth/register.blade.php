@extends('layouts.auth')

@section('title', 'Daftar')

@section('left')
    <section class="hidden lg:block">
        <div
            class="bg-orange-400 text-black px-4 py-2 rounded-full text-sm font-semibold border-3 border-black shadow-[5px_5px_0px_rgba(0,0,0,1)] inline-flex items-center justify-center gap-2">
            <x-hugeicons-ai-brain-03 /> AI Kitchen Assistant
        </div>

        <div class="mt-8 max-w-xl">
            <h1 class="text-4xl font-black tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                Mulai petualangan memasakmu
                <span class="block text-[#1a6b41]">dengan akun CookLens.</span>
            </h1>
            <p class="mt-5 text-lg leading-relaxed text-gray-600 sm:text-xl">
                Gabung untuk menyimpan resep favorit, melihat rekomendasi yang lebih personal, dan menjadikan bahan di
                dapurmu
                sebagai inspirasi menu harian.
            </p>
        </div>
    </section>
@endsection

@section('right')
    <section>
        <div
            class="mx-auto max-w-xl border-4 border-black bg-white/95 p-5 shadow-[12px_12px_0px_rgba(0,0,0,1)] backdrop-blur sm:p-8">
            <div class="flex flex-col items-center justify-center gap-4 border-b-2 border-dashed border-gray-300 pb-5">
                <img src="{{ asset('img/cooklens-app.png') }}" alt="CookLens" class="h-20 object-contain">
                <h2 class="text-2xl font-black text-gray-900">Buat akun baru</h2>
            </div>

            <form action="#" method="POST" class="mt-6 space-y-5">
                @csrf

                <div class="space-y-2">
                    <label for="name" class="text-sm font-bold text-gray-800">Nama Lengkap</label>
                    <div
                        class="flex items-center gap-3 border-3 border-black bg-[#faf7f2] px-4 py-3 shadow-[4px_4px_0px_rgba(0,0,0,1)] transition focus-within:-translate-y-0.5 focus-within:bg-white">
                        <x-heroicon-o-user class="h-5 w-5 shrink-0 text-gray-500" aria-hidden="true" />
                        <input id="name" name="name" type="text" autocomplete="name" placeholder="Siapa namamu?"
                            class="w-full border-0 bg-transparent p-0 text-base text-gray-900 outline-none placeholder:text-gray-400 focus:ring-0">
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="email" class="text-sm font-bold text-gray-800">Email</label>
                    <div
                        class="flex items-center gap-3 border-3 border-black bg-[#faf7f2] px-4 py-3 shadow-[4px_4px_0px_rgba(0,0,0,1)] transition focus-within:-translate-y-0.5 focus-within:bg-white">
                        <x-heroicon-o-envelope class="h-5 w-5 shrink-0 text-gray-500" aria-hidden="true" />
                        <input id="email" name="email" type="email" autocomplete="email" placeholder="namamu@email.com"
                            class="w-full border-0 bg-transparent p-0 text-base text-gray-900 outline-none placeholder:text-gray-400 focus:ring-0">
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="password" class="text-sm font-bold text-gray-800">Kata Sandi</label>
                    <div
                        class="flex items-center gap-3 border-3 border-black bg-[#faf7f2] px-4 py-3 shadow-[4px_4px_0px_rgba(0,0,0,1)] transition focus-within:-translate-y-0.5 focus-within:bg-white">
                        <x-heroicon-o-lock-closed class="h-5 w-5 shrink-0 text-gray-500" aria-hidden="true" />
                        <input id="password" name="password" type="password" autocomplete="new-password"
                            placeholder="Buat sandi yang kuat"
                            class="w-full border-0 bg-transparent p-0 text-base text-gray-900 outline-none placeholder:text-gray-400 focus:ring-0">
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="password_confirmation" class="text-sm font-bold text-gray-800">Konfirmasi Kata Sandi</label>
                    <div
                        class="flex items-center gap-3 border-3 border-black bg-[#faf7f2] px-4 py-3 shadow-[4px_4px_0px_rgba(0,0,0,1)] transition focus-within:-translate-y-0.5 focus-within:bg-white">
                        <x-heroicon-o-lock-closed class="h-5 w-5 shrink-0 text-gray-500" aria-hidden="true" />
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            autocomplete="new-password" placeholder="Ulangi sandimu"
                            class="w-full border-0 bg-transparent p-0 text-base text-gray-900 outline-none placeholder:text-gray-400 focus:ring-0">
                    </div>
                </div>

                <button type="submit"
                    class="group flex w-full items-center justify-center gap-3 border-3 border-black bg-[#22c55e] px-5 py-4 text-lg font-black text-white shadow-[6px_6px_0px_rgba(0,0,0,1)] transition-transform hover:-translate-y-0.5 hover:bg-[#16a34a]">
                    <span>Daftar Sekarang</span>
                    <span class="transition-transform group-hover:translate-x-1">→</span>
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                    class="font-bold text-[#1a6b41] underline decoration-2 underline-offset-4">Login
                    di sini</a>
            </p>
        </div>
    </section>
@endsection