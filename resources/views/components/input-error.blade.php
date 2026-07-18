@props(['messages' => null, 'class' => ''])

@if ($messages)
    @foreach ((array) $messages as $message)
        <p {{ $attributes->merge(['class' => "mt-2 flex items-center gap-2 border-l-4 border-red-600 bg-red-50/80 px-3 py-2 text-sm font-bold text-red-700 shadow-[2px_2px_0px_rgba(0,0,0,1)] $class"]) }}>
            <x-heroicon-o-exclamation-triangle class="h-4 w-4 shrink-0 text-red-600" />
            {{ $message }}
        </p>
    @endforeach
@endif
