@props([
    'type' => 'error',
    'message' => null,
    'messages' => null,
    'dismissible' => false,
    'floating' => false,
    'class' => '',
])

@php
    $isError = $type === 'error';
    $colors = $isError
        ? 'border-red-600 bg-red-50 text-red-800 shadow-[4px_4px_0px_rgba(220,38,38,1)]'
        : 'border-green-600 bg-green-50 text-green-800 shadow-[4px_4px_0px_rgba(22,163,74,1)]';
    $icon = $isError
        ? 'heroicon-o-x-circle'
        : 'heroicon-o-check-circle';
    $allMessages = [
        ...($message ? [$message] : []),
        ...($messages ? (array) $messages : []),
    ];
    $positional = $floating
        ? 'fixed bottom-4 left-4 right-4 md:left-auto md:w-[400px] z-50'
        : 'relative';
@endphp

@if (count($allMessages))
    <div
        {{ $attributes->merge(['class' => "$positional border-3 border-black px-4 py-3 $colors $class"]) }}
        data-alert
        role="alert"
    >
        <div class="flex items-start gap-3">
            <div class="shrink-0 pt-0.5">
                <x-dynamic-component :component="$icon" class="h-5 w-5" />
            </div>
            <div class="flex-1 space-y-1">
                @foreach ($allMessages as $msg)
                    <p class="text-base md:text-lg font-bold break-words">{{ $msg }}</p>
                @endforeach
            </div>
            @if ($dismissible || $floating)
                <button type="button" data-dismiss-entry class="shrink-0 pt-0.5" aria-label="Tutup">
                    <x-heroicon-o-x-mark class="h-5 w-5 cursor-pointer opacity-70 hover:opacity-100" />
                </button>
            @endif
        </div>
    </div>
@endif

@push('scripts')
    <script>
        document.querySelectorAll('[data-alert]').forEach(alert => {
            const dismiss = () => alert.remove();
            const timer = setTimeout(dismiss, 5000);

            alert.querySelectorAll('[data-dismiss-entry]').forEach(btn => {
                btn.addEventListener('click', () => {
                    clearTimeout(timer);
                    dismiss();
                });
            });
        });
    </script>
@endpush