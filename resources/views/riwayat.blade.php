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
        </div>

        @if ($analyses->isEmpty())
            <div class="bg-white rounded-xl p-12 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)] text-center">
                <div
                    class="w-20 h-20 bg-gray-100 border-2 border-black rounded-full flex items-center justify-center mx-auto mb-6 shadow-[3px_3px_0px_rgba(0,0,0,1)]">
                    <x-heroicon-o-document-magnifying-glass class="w-10 h-10 text-gray-400" />
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Analisis</h3>
                <p class="text-gray-500 mb-6">Kamu belum pernah melakukan analisis bahan makanan.</p>
                <a href="{{ route('analisis') }}"
                    class="inline-flex items-center gap-2 bg-green-500 text-white px-8 py-3 rounded-xl font-bold border-3 border-black shadow-[5px_5px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[7px_7px_0px_rgba(0,0,0,1)] transition-all">
                    <x-heroicon-o-arrow-up-tray class="w-5 h-5" /> Analisis Sekarang
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
                        <div class="flex-grow w-full md:w-auto">
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
                        <div class="flex gap-2 w-full md:w-auto mt-2 md:mt-0">
                            <a href="{{ route('riwayat.show', $analysis) }}"
                                class="flex-1 md:flex-none text-center px-5 py-2.5 bg-yellow-400 font-bold border-2 border-black rounded-md shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[5px_5px_0px_rgba(0,0,0,1)] transition-all">
                                Detail
                            </a>
                            <form action="{{ route('riwayat.destroy', $analysis) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus analisis ini? Semua data terkait akan dihapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-5 py-2.5 bg-red-500 text-white font-bold border-2 border-black rounded-md shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[5px_5px_0px_rgba(0,0,0,1)] transition-all">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($analyses->hasPages())
                <div class="mt-6">
                    {{ $analyses->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection