@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="flex flex-col gap-8">
    <!-- Welcome Section -->
    <div class="bg-white rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)]">
        <h2 class="text-3xl font-bold mb-6 text-gray-900">Selamat datang, {{ auth()->user()->name ?? 'Pengguna' }}!</h2>
        <p class="text-gray-600 text-lg">
            Siap untuk memasak sesuatu yang lezat hari ini? Mulai dengan mengunggah foto bahan makananmu atau lihat riwayat masakan sebelumnya.
        </p>
    </div>

    <!-- Quick Action: Analisis -->
    <div class="bg-green-400 rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)] flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <h3 class="text-2xl font-bold text-black mb-2 flex items-center gap-3">
                <span class="text-3xl">📸</span> Analisis Bahan Makanan Baru
            </h3>
            <p class="text-green-950 font-semibold text-lg">Punya sisa bahan di kulkas? Unggah fotonya dan biar AI kami menemukan resep lezat untukmu!</p>
        </div>
        <a href="#" class="shrink-0 bg-white text-black font-bold text-lg px-8 py-4 rounded-xl border-3 border-black shadow-[5px_5px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[7px_7px_0px_rgba(0,0,0,1)] transition-all flex items-center gap-2">
         <x-heroicon-o-camera class="w-7" /> Mulai Analisis 
        </a>
    </div>

    <!-- Recent Analysis Section -->
    <div class="bg-white rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)]">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
         Hasil Analisis Terakhir
        </h2>
        
        <div class="flex flex-col gap-4 mb-8">
            <!-- Dummy Item 1 -->
            <div class="flex flex-col md:flex-row items-start md:items-center gap-4 p-4 border-3 border-black rounded-xl bg-[#fcf9f8]">
                <div class="w-full md:w-24 h-40 md:h-24 bg-gray-200 border-2 border-black rounded-lg overflow-hidden shrink-0">
                    <img src="{{ asset('img/examp.jpg') }}" alt="Bahan Makanan" class="w-full h-full object-cover">
                </div>
                <div class="flex-grow w-full md:w-auto">
                    <h3 class="font-bold text-xl text-gray-900 mb-1">Ayam Bakar Bumbu Rujak</h3>
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="bg-green-300 text-green-900 text-xs font-bold px-3 py-1 border-2 border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]">Mudah</span>
                        <span class="text-sm text-gray-600 font-semibold flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            19 Juli 2026
                        </span>
                    </div>
                </div>
                <div class="w-full md:w-auto mt-2 md:mt-0">
                    <a href="#" class="block w-full md:w-auto text-center px-5 py-2.5 bg-yellow-400 font-bold border-2 border-black rounded-md shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[5px_5px_0px_rgba(0,0,0,1)] transition-all">Lihat Detail</a>
                </div>
            </div>

            <!-- Dummy Item 2 -->
            <div class="flex flex-col md:flex-row items-start md:items-center gap-4 p-4 border-3 border-black rounded-xl bg-[#fcf9f8]">
                <div class="w-full md:w-24 h-40 md:h-24 bg-blue-200 border-2 border-black rounded-lg overflow-hidden shrink-0 flex items-center justify-center text-4xl">
                    🥦
                </div>
                <div class="flex-grow w-full md:w-auto">
                    <h3 class="font-bold text-xl text-gray-900 mb-1">Tumis Brokoli Jamur Tiram</h3>
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="bg-orange-300 text-orange-900 text-xs font-bold px-3 py-1 border-2 border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]">Sedang</span>
                        <span class="text-sm text-gray-600 font-semibold flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            18 Juli 2026
                        </span>
                    </div>
                </div>
                <div class="w-full md:w-auto mt-2 md:mt-0">
                    <a href="#" class="block w-full md:w-auto text-center px-5 py-2.5 bg-yellow-400 font-bold border-2 border-black rounded-md shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[5px_5px_0px_rgba(0,0,0,1)] transition-all">Lihat Detail</a>
                </div>
            </div>

  
        </div>

        <div class="text-center">
            <a href="#" class="inline-flex items-center justify-center gap-2 bg-gray-900 text-white px-8 py-3 rounded-lg font-bold shadow-[5px_5px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[7px_7px_0px_rgba(0,0,0,1)] transition-all border-3 border-black">
                Lihat Semua Riwayat <span class="text-xl">→</span>
            </a>
        </div>
    </div>
</div>
@endsection
