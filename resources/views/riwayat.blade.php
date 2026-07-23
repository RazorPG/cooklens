@extends('layouts.app')

@section('title', 'Riwayat Analisis')

@section('content')
    <div class="flex flex-col gap-8">
        <div class="bg-white rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)]">
            <h2 class="text-3xl font-bold mb-6 text-gray-900 flex items-center gap-3">
                <x-heroicon-o-clock class="w-8 h-8" /> Riwayat Analisis
            </h2>
            <p class="text-gray-600 text-lg">
                Semua hasil analisis bahan makanan yang pernah kamu lakukan.
            </p>

            <!-- Filter Bar -->
            <form method="GET" action="{{ route('riwayat') }}" class="flex flex-col sm:flex-row gap-3 mt-6">
                <div class="relative flex-1">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama resep atau bahan..."
                        class="w-full pl-10 pr-4 py-3 rounded-xl border-3 border-black font-bold shadow-[3px_3px_0px_rgba(0,0,0,1)] bg-[#fcf9f8] focus:bg-white transition-all outline-none placeholder:text-gray-400">
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                        <x-heroicon-o-magnifying-glass class="w-5 h-5 text-gray-500" />
                    </div>
                </div>
                <div class="flex gap-2 shrink-0">
                    @if ($favorites)
                        <a href="{{ request()->fullUrlWithQuery(['favorites' => null, 'page' => null]) }}"
                            class="px-5 py-3 rounded-xl font-bold border-3 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)] bg-red-500 text-white transition-all hover:-translate-y-0.5 hover:-translate-x-0.5">
                            <span class="flex items-center gap-2">
                                <x-heroicon-s-heart class="w-5 h-5" /> Favorit
                            </span>
                        </a>
                    @else
                        <a href="{{ request()->fullUrlWithQuery(['favorites' => 1, 'page' => null]) }}"
                            class="px-5 py-3 rounded-xl font-bold border-3 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)] bg-white text-gray-700 hover:bg-red-50 transition-all hover:-translate-y-0.5 hover:-translate-x-0.5">
                            <span class="flex items-center gap-2">
                                <x-heroicon-s-heart class="w-5 h-5" /> Favorit
                            </span>
                        </a>
                    @endif
                    @if ($search || $favorites)
                        <a href="{{ route('riwayat') }}"
                            class="px-5 py-3 rounded-xl font-bold border-3 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)] bg-gray-200 text-gray-700 hover:bg-gray-300 transition-all inline-flex items-center">
                            <x-heroicon-o-x-mark class="w-5 h-5" />
                        </a>
                    @endif
                </div>
            </form>
        </div>

        @if ($analyses->isEmpty() && ($search || $favorites))
            <div class="bg-white rounded-xl p-12 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)] text-center">
                <div
                    class="w-20 h-20 bg-gray-100 border-2 border-black rounded-full flex items-center justify-center mx-auto mb-6 shadow-[3px_3px_0px_rgba(0,0,0,1)]">
                    <x-heroicon-o-magnifying-glass class="w-10 h-10 text-gray-400" />
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Tidak Ditemukan</h3>
                <p class="text-gray-500 mb-6">Tidak ada hasil analisis yang cocok dengan pencarianmu.</p>
                <a href="{{ route('riwayat') }}"
                    class="inline-flex items-center gap-2 bg-gray-900 text-white px-8 py-3 rounded-xl font-bold border-3 border-black shadow-[5px_5px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[7px_7px_0px_rgba(0,0,0,1)] transition-all">
                    <x-heroicon-o-x-mark class="w-5 h-5" /> Reset Filter
                </a>
            </div>
        @elseif ($analyses->isEmpty())
            <div class="bg-white rounded-xl p-12 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)] text-center">
                <div
                    class="w-20 h-20 bg-gray-100 border-2 border-black rounded-full flex items-center justify-center mx-auto mb-6 shadow-[3px_3px_0px_rgba(0,0,0,1)]">
                    <x-heroicon-o-document-magnifying-glass class="w-10 h-10 text-gray-400" />
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Analisis</h3>
                <p class="text-gray-500 mb-6">Kamu belum pernah melakukan analisis bahan makanan.</p>
                <a href="{{ route('analisis') }}"
                    class="inline-flex items-center gap-2 bg-green-500 text-white px-8 py-3 rounded-xl font-bold border-3 border-black shadow-[5px_5px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[7px_7px_0px_rgba(0,0,0,1)] transition-all">
                    Analisis Sekarang
                </a>
            </div>
        @else
            <div class="flex flex-col gap-4">
                @foreach ($analyses as $analysis)
                    @php $firstRec = $analysis->recommendations->first(); @endphp
                    <div
                        class="flex flex-col md:flex-row items-start md:items-center gap-4 p-4 border-3 border-black rounded-xl bg-white shadow-[5px_5px_0px_rgba(0,0,0,1)]">
                        <div
                            class="w-full md:w-20 h-36 md:h-20 border-2 border-black rounded-lg overflow-hidden shrink-0 bg-gray-100">
                            <img src="{{ $analysis->image_path }}" alt="Bahan Makanan" class="w-full h-full object-cover">
                        </div>
                        <div class="grow w-full md:w-auto">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <h3 class="font-bold text-xl text-gray-900">
                                    {{ $firstRec?->recipe_name ?? 'Analisis #' . $analysis->id }}
                                </h3>
                                @if ($firstRec)
                                    <span
                                        class="bg-green-500 text-white text-xs font-bold px-2 py-0.5 border-2 border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]">
                                        {{ $firstRec->match_percentage }}%
                                    </span>
                                @endif
                            </div>
                            <div class="flex flex-wrap items-center gap-3 text-sm">
                                <span class="text-gray-600 font-semibold flex items-center gap-1">
                                    <x-heroicon-o-calendar class="w-4 h-4" />
                                    {{ $analysis->created_at->format('d M Y, H:i') }}
                                </span>
                                <span class="text-gray-500">
                                    {{ count($analysis->detected_ingredients ?? []) }} bahan terdeteksi
                                </span>
                                @if ($analysis->recommendations->count() > 1)
                                    <span class="text-gray-500">
                                        +{{ $analysis->recommendations->count() - 1 }} resep lainnya
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex gap-2 justify-center items-center w-full md:w-auto mt-2 md:mt-0">
                            <form action="{{ route('riwayat.favorite', $analysis) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="px-3 py-2.5 rounded-md border-2 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[5px_5px_0px_rgba(0,0,0,1)] transition-all {{ $analysis->is_favorite ? 'bg-red-500 text-white hover:bg-red-600' : 'bg-white text-gray-500 hover:bg-red-50 hover:text-red-500' }}">
                                    @if ($analysis->is_favorite)
                                        <x-heroicon-s-heart class="w-5 h-5" />
                                    @else
                                        <x-heroicon-o-heart class="w-5 h-5" />
                                    @endif
                                </button>
                            </form>
                            <a href="{{ route('riwayat.show', $analysis) }}"
                                class="flex-1 md:flex-none text-center px-5 py-2.5 bg-yellow-400 font-bold border-2 border-black rounded-md shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[5px_5px_0px_rgba(0,0,0,1)] transition-all">
                                Detail
                            </a>
                            <button type="button" data-modal-open="delete-analysis-{{ $analysis->id }}"
                                class="px-5 py-2.5 bg-red-500 text-white font-bold border-2 border-black rounded-md shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[5px_5px_0px_rgba(0,0,0,1)] transition-all">
                                Hapus
                            </button>
                        </div>
                    </div>

                    <x-modal name="delete-analysis-{{ $analysis->id }}" title="Hapus Analisis"
                        message="Yakin ingin menghapus analisis ini? Semua data terkait akan dihapus."
                        :action="route('riwayat.destroy', $analysis)" action-text="Hapus"
                        action-color="bg-red-500 hover:bg-red-600" />
                @endforeach
            </div>

            @if ($analyses->hasPages())
                <div class="mt-6">
                    {{ $analyses->links('components.pagination') }}
                </div>
            @endif
        @endif
    </div>
@endsection