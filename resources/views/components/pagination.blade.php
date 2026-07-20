@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
            <div class="text-sm font-bold text-gray-700">
                @if ($paginator->firstItem())
                    Menampilkan {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} dari {{ $paginator->total() }} hasil
                @endif
            </div>

            <div class="flex gap-2 items-center">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="inline-flex items-center justify-center w-10 h-10 border-3 border-black rounded-lg bg-[#fcf9f8] text-gray-400 shadow-[3px_3px_0px_rgba(0,0,0,1)] opacity-40 cursor-not-allowed">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="inline-flex items-center justify-center w-10 h-10 border-3 border-black rounded-lg bg-[#fcf9f8] text-gray-800 font-bold shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 hover:-translate-x-0.5 hover:shadow-[4px_4px_0px_rgba(0,0,0,1)] transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="inline-flex items-center justify-center w-10 h-10 border-3 border-black rounded-lg bg-[#fcf9f8] text-gray-500 font-bold shadow-[3px_3px_0px_rgba(0,0,0,1)] cursor-default">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page"
                                    class="inline-flex items-center justify-center w-10 h-10 border-3 border-black rounded-lg bg-green-500 text-white font-bold shadow-[3px_3px_0px_rgba(0,0,0,1)] cursor-default">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="inline-flex items-center justify-center w-10 h-10 border-3 border-black rounded-lg bg-[#fcf9f8] text-gray-800 font-bold shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 hover:-translate-x-0.5 hover:shadow-[4px_4px_0px_rgba(0,0,0,1)] transition-all"
                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="inline-flex items-center justify-center w-10 h-10 border-3 border-black rounded-lg bg-[#fcf9f8] text-gray-800 font-bold shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 hover:-translate-x-0.5 hover:shadow-[4px_4px_0px_rgba(0,0,0,1)] transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span class="inline-flex items-center justify-center w-10 h-10 border-3 border-black rounded-lg bg-[#fcf9f8] text-gray-400 shadow-[3px_3px_0px_rgba(0,0,0,1)] opacity-40 cursor-not-allowed">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
