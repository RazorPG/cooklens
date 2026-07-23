@props([
    'name',
    'title',
    'message',
    'action',
    'actionText' => 'Confirm',
    'actionColor' => 'bg-red-500',
    'show' => false
])

<div
    data-modal-root
    data-modal-name="{{ $name }}"
    @if (! $show) hidden @endif
    class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0"
    aria-labelledby="modal-title-{{ $name }}"
    role="dialog"
    aria-modal="true"
>

    <!-- Background backdrop -->
    <button
        type="button"
        data-modal-close
        class="fixed inset-0 bg-gray-500/75 transition-opacity"
        aria-hidden="true"
        tabindex="-1"
    ></button>

    <!-- Modal panel -->
    <div class="relative w-full max-w-lg overflow-hidden rounded-xl bg-white border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)] transform transition-all">
        
        <div class="p-6 sm:p-8">
            <div class="flex items-start gap-4">
                <div class="mx-auto flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10 border-2 border-black">
                    <x-heroicon-o-exclamation-triangle class="h-6 w-6 text-red-600" />
                </div>
                <div class="mt-0 text-center sm:text-left">
                    <h3 class="text-2xl font-bold leading-6 text-gray-900" id="modal-title-{{ $name }}">
                        {{ $title }}
                    </h3>
                    <div class="mt-2">
                        <p class="text-base text-gray-600">
                            {{ $message }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end gap-3 border-t-3 border-black">
            <button data-modal-close
                    type="button"
                    class="w-full sm:w-auto justify-center rounded-md border-3 border-black bg-white px-6 py-2.5 text-base font-bold text-gray-700 shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:bg-gray-50 transition-all hover:-translate-y-0.5 hover:-translate-x-0.5">
                Cancel
            </button>
            <form action="{{ $action }}" method="POST" class="inline w-full sm:w-auto m-0">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full sm:w-auto justify-center rounded-md border-3 border-black px-6 py-2.5 text-base font-bold text-white shadow-[3px_3px_0px_rgba(0,0,0,1)] transition-all hover:-translate-y-0.5 hover:-translate-x-0.5 {{ $actionColor }}">
                    {{ $actionText }}
                </button>
            </form>
        </div>
    </div>
</div>

@pushOnce('scripts')
    <script>
        (() => {
            const modalRoots = () => Array.from(document.querySelectorAll('[data-modal-root]'));

            const setModalState = (modal, isOpen) => {
                if (!modal) {
                    return;
                }

                modal.hidden = !isOpen;
                document.body.classList.toggle('overflow-hidden', isOpen);
            };

            const openModal = (name) => {
                modalRoots().forEach((modal) => {
                    setModalState(modal, modal.dataset.modalName === name);
                });
            };

            const closeModal = () => {
                modalRoots().forEach((modal) => setModalState(modal, false));
            };

            document.addEventListener('click', (event) => {
                const openTrigger = event.target.closest('[data-modal-open]');

                if (openTrigger) {
                    openModal(openTrigger.dataset.modalOpen);
                    return;
                }

                if (event.target.closest('[data-modal-close]')) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closeModal();
                }
            });
        })();
    </script>
@endPushOnce
