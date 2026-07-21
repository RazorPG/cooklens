@extends('layouts.app')

@section('title', 'Detail Analisis')

@section('content')
    <div class="flex flex-col gap-8">
        <div class="bg-white rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)]">
            <div class="flex flex-wrap items-start justify-between gap-4 mb-2">
                <h2 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                    <x-heroicon-o-document-text class="w-8 h-8" /> Detail Analisis
                </h2>
                <a href="{{ route('riwayat') }}"
                    class="inline-flex items-center gap-1 text-sm font-bold text-gray-600 hover:text-gray-900 transition-all">
                    <x-heroicon-o-arrow-left class="w-4 h-4" /> Kembali ke Riwayat
                </a>
            </div>
            <p class="text-gray-500 text-sm">
                Dianalisis pada {{ $analysis->created_at->format('d M Y, H:i') }}
            </p>
        </div>

        <div class="bg-white rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)]">
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="w-full lg:w-80 shrink-0">
                    <img src="{{ $analysis->image_path }}" alt="Bahan Makanan"
                        class="w-full h-56 lg:h-48 object-cover rounded-xl border-3 border-black">
                </div>
                <div class="grow">
                    <h3 class="text-xl font-bold mb-4 text-gray-900 flex items-center gap-2">
                        <x-heroicon-o-square-3-stack-3d class="w-6 h-6 text-green-600" />
                        Bahan-bahan yang Terdeteksi
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($analysis->detected_ingredients as $ingredient)
                            <span class="bg-green-100 text-green-800 text-sm font-bold px-4 py-1.5 border-2 border-green-600 rounded-full shadow-[2px_2px_0px_rgba(0,0,0,1)]">
                                {{ $ingredient }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @php $count = $analysis->recommendations->count(); @endphp

        @if ($count > 1)
            <div class="flex gap-3 overflow-x-auto flex-nowrap pb-2">
                @foreach ($analysis->recommendations as $i => $rec)
                    <button type="button" data-tab="{{ $i }}"
                        class="tab-btn px-6 py-3 rounded-xl font-bold border-3 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)] transition-all bg-[#fcf9f8] text-gray-700 hover:bg-green-50"
                        data-active-class="bg-green-500 text-white shadow-[5px_5px_0px_rgba(0,0,0,1)]">
                        <span class="flex items-center gap-2">
                            <x-heroicon-o-star class="w-5 h-5" />
                            {{ $rec->recipe_name }}
                        </span>
                    </button>
                @endforeach
            </div>
        @endif

        @foreach ($analysis->recommendations as $i => $rec)
            <div id="recipe-{{ $i }}" class="recipe-card bg-white rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)] {{ $i > 0 ? 'hidden' : '' }}">
                <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $rec->recipe_name }}</h3>
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="bg-green-500 text-white text-sm font-bold px-3 py-1 border-2 border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]">
                                {{ $rec->match_percentage }}% Cocok
                            </span>
                            <span class="text-sm font-bold px-3 py-1 border-2 border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                @switch($rec->difficulty)
                                    @case('Mudah') bg-green-200 text-green-900 @break
                                    @case('Sedang') bg-yellow-200 text-yellow-900 @break
                                    @case('Sulit') bg-red-200 text-red-900 @break
                                    @default bg-gray-200 text-gray-900
                                @endswitch">
                                {{ $rec->difficulty }}
                            </span>
                            <span class="text-sm text-gray-600 font-semibold flex items-center gap-1">
                                <x-heroicon-o-clock class="w-4 h-4" /> {{ $rec->cooking_time }} menit
                            </span>
                        </div>
                    </div>
                </div>

                <div class="bg-amber-50 rounded-xl p-5 border-2 border-amber-300 mb-8">
                    <p class="text-gray-800 font-medium">{{ $rec->reason }}</p>
                </div>

                <div class="grid lg:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-lg font-bold mb-4 text-gray-900 flex items-center gap-2">
                            <x-heroicon-o-cube class="w-5 h-5 text-green-600" /> Bahan-bahan
                        </h4>
                        <ul class="space-y-2">
                            @foreach ($rec->recipe_data['ingredients'] ?? [] as $ingredient)
                                <li class="flex items-start gap-3 p-3 bg-[#fcf9f8] border-2 border-gray-200 rounded-lg">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mt-2 shrink-0"></span>
                                    <span class="text-gray-800 font-medium">{{ $ingredient }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-lg font-bold mb-4 text-gray-900 flex items-center gap-2">
                            <x-heroicon-o-list-bullet class="w-5 h-5 text-green-600" /> Langkah Memasak
                        </h4>
                        <ol class="space-y-3">
                            @foreach ($rec->recipe_data['steps'] ?? [] as $step)
                                <li class="flex items-start gap-3 p-3 bg-[#fcf9f8] border-2 border-gray-200 rounded-lg">
                                    <span class="w-7 h-7 bg-green-500 text-white text-sm font-bold rounded-full flex items-center justify-center shrink-0 border-2 border-black shadow-[2px_2px_0px_rgba(0,0,0,1)]">
                                        {{ $loop->iteration }}
                                    </span>
                                    <span class="text-gray-800 font-medium mt-0.5">{{ $step }}</span>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
    @if ($count > 1)
        <script>
            (function () {
                const tabs = document.querySelectorAll('.tab-btn');
                const cards = document.querySelectorAll('.recipe-card');

                tabs.forEach(btn => {
                    btn.addEventListener('click', function () {
                        const idx = this.dataset.tab;

                        tabs.forEach(t => {
                            t.classList.remove('bg-green-500', 'text-white', 'shadow-[5px_5px_0px_rgba(0,0,0,1)]');
                            t.classList.add('bg-[#fcf9f8]', 'text-gray-700');
                        });
                        this.classList.remove('bg-[#fcf9f8]', 'text-gray-700');
                        this.classList.add('bg-green-500', 'text-white', 'shadow-[5px_5px_0px_rgba(0,0,0,1)]');

                        cards.forEach(c => c.classList.add('hidden'));
                        document.getElementById('recipe-' + idx).classList.remove('hidden');

                        window.scrollTo({ top: document.getElementById('recipe-' + idx).offsetTop - 120, behavior: 'smooth' });
                    });
                });
            })();
        </script>
    @endif
@endpush