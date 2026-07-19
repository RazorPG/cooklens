@extends('layouts.app')

@section('title', 'Analisis')

@section('content')
    <div class="flex flex-col gap-8">
        <!-- Hero -->
        <div class="bg-white rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)]">
            <h2 class="text-3xl font-bold mb-4 text-gray-900 flex items-center gap-3">
                Analisis Bahan Makanan
            </h2>
            <p class="text-gray-600 text-lg">
                Unggah foto bahan makanan yang kamu miliki, dan biarkan AI CookLens
                menganalisis serta memberikan rekomendasi resep terbaik untukmu.
            </p>
        </div>

        <!-- Upload Card -->
        <div class="bg-white rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)]">
            <h3 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                <x-heroicon-o-arrow-up-tray class="w-7 h-7" /> Unggah Foto
            </h3>

            <form action="{{ route('analisis.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <x-alert floating type="error" :message="session('error')" dismissible />
                <x-alert floating type="error" :message="$errors->first('image')" dismissible />

                <input type="radio" name="upload_tab" id="tab_upload" class="hidden peer/tab_upload" checked data-tab-radio>
                <input type="radio" name="upload_tab" id="tab_camera" class="hidden peer/tab_camera" data-tab-radio>

                <div class="flex gap-3 mb-6">
                    <label for="tab_upload"
                        class="flex-1 text-center px-6 py-3 rounded-xl font-bold border-3 transition-all shadow-[3px_3px_0px_rgba(0,0,0,1)] cursor-pointer peer-checked/tab_upload:bg-green-500 peer-checked/tab_upload:text-white peer-checked/tab_upload:border-black bg-[#fcf9f8] text-gray-600 border-gray-300 hover:bg-green-50">
                        <span class="flex items-center justify-center gap-2">
                            <x-heroicon-o-arrow-up-tray class="w-5 h-5" /> Upload Foto
                        </span>
                    </label>
                    <label for="tab_camera"
                        class="flex-1 text-center px-6 py-3 rounded-xl font-bold border-3 transition-all shadow-[3px_3px_0px_rgba(0,0,0,1)] cursor-pointer peer-checked/tab_camera:bg-green-500 peer-checked/tab_camera:text-white peer-checked/tab_camera:border-black bg-[#fcf9f8] text-gray-600 border-gray-300 hover:bg-green-50">
                        <span class="flex items-center justify-center gap-2">
                            <x-heroicon-o-camera class="w-5 h-5" /> Kamera
                        </span>
                    </label>
                </div>

                <input id="file-input" name="image" type="file" accept="image/*" class="hidden" data-file-input>

                <!-- Upload Panel -->
                <div id="panel-upload" class="hidden" data-panel>
                    <label for="file-input"
                        class="flex flex-col items-center justify-center w-full min-h-[260px] border-2 border-dashed border-gray-400 rounded-xl bg-[#fcf9f8] cursor-pointer hover:border-green-500 hover:bg-green-50/30 transition-all p-8 group">
                        <div class="flex flex-col items-center gap-4 pointer-events-none">
                            <div
                                class="w-16 h-16 bg-green-100 border-2 border-black rounded-full flex items-center justify-center shadow-[3px_3px_0px_rgba(0,0,0,1)] group-hover:shadow-[5px_5px_0px_rgba(0,0,0,1)] group-hover:-translate-y-0.5 group-hover:-translate-x-0.5 transition-all">
                                <x-heroicon-o-arrow-up-tray class="w-8 h-8 text-green-600" />
                            </div>
                            <div class="text-center">
                                <p class="text-lg font-bold text-gray-800">Klik atau tarik gambar ke sini</p>
                                <p class="text-sm text-gray-500 mt-1">JPG, PNG, WebP · Maksimal 5MB</p>
                            </div>
                        </div>
                    </label>
                </div>

                <!-- Camera Panel -->
                <div id="panel-camera" class="hidden" data-panel>
                    <label for="file-input"
                        class="flex flex-col items-center justify-center w-full min-h-[260px] border-2 border-black rounded-xl bg-gray-100 cursor-pointer hover:bg-gray-200 transition-all p-8 group">
                        <div class="flex flex-col items-center gap-4 pointer-events-none">
                            <div
                                class="w-16 h-16 bg-blue-100 border-2 border-black rounded-full flex items-center justify-center shadow-[3px_3px_0px_rgba(0,0,0,1)] group-hover:shadow-[5px_5px_0px_rgba(0,0,0,1)] group-hover:-translate-y-0.5 group-hover:-translate-x-0.5 transition-all">
                                <x-heroicon-o-camera class="w-8 h-8 text-blue-600" />
                            </div>
                            <div class="text-center">
                                <p class="text-lg font-bold text-gray-800">Ketuk untuk mengambil foto</p>
                                <p class="text-sm text-gray-500 mt-1">Gunakan kamera perangkat untuk memotret bahan makanan
                                </p>
                            </div>
                        </div>
                    </label>
                </div>

                <!-- Preview -->
                <div id="preview-container"
                    class="hidden relative w-full min-h-[260px] rounded-xl overflow-hidden border-3 border-black bg-gray-900"
                    data-panel>
                    <img id="preview-image" class="w-full h-full absolute inset-0 object-contain" alt="Preview">
                    <button type="button" id="reset-preview"
                        class="absolute top-3 right-3 w-10 h-10 bg-white border-2 border-black rounded-full flex items-center justify-center shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:bg-red-500 hover:text-white hover:border-red-600 transition-all z-10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="mt-6 text-center">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white px-10 py-4 rounded-xl font-bold border-3 border-black shadow-[5px_5px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[7px_7px_0px_rgba(0,0,0,1)] transition-all">
                        Analisis Sekarang
                    </button>
                </div>
            </form>
        </div>

        <!-- Tips Card -->
        <div class="bg-amber-50 rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)]">
            <h3 class="text-xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                <x-heroicon-o-light-bulb class="w-6 h-6 text-amber-500" /> Tips Foto yang Baik
            </h3>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="flex flex-col items-center text-center gap-3 p-4">
                    <div
                        class="w-12 h-12 bg-amber-400 border-2 border-black rounded-full flex items-center justify-center shadow-[3px_3px_0px_rgba(0,0,0,1)] shrink-0 text-lg font-bold">
                        1
                    </div>
                    <p class="text-gray-700 font-semibold">Pastikan pencahayaan cukup agar bahan makanan terlihat jelas.</p>
                </div>
                <div class="flex flex-col items-center text-center gap-3 p-4">
                    <div
                        class="w-12 h-12 bg-amber-400 border-2 border-black rounded-full flex items-center justify-center shadow-[3px_3px_0px_rgba(0,0,0,1)] shrink-0 text-lg font-bold">
                        2
                    </div>
                    <p class="text-gray-700 font-semibold">Letakkan bahan di permukaan yang bersih dan kontras.</p>
                </div>
                <div class="flex flex-col items-center text-center gap-3 p-4">
                    <div
                        class="w-12 h-12 bg-amber-400 border-2 border-black rounded-full flex items-center justify-center shadow-[3px_3px_0px_rgba(0,0,0,1)] shrink-0 text-lg font-bold">
                        3
                    </div>
                    <p class="text-gray-700 font-semibold">Ambil foto dari sudut atas (top-down) untuk hasil terbaik.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function () {
            const fileInput = document.getElementById('file-input');
            const tabRadios = document.querySelectorAll('[data-tab-radio]');
            const panels = document.querySelectorAll('[data-panel]');
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');
            const resetBtn = document.getElementById('reset-preview');

            function showPanel(id) {
                panels.forEach(p => p.classList.add('hidden'));
                document.getElementById(id).classList.remove('hidden');
            }

            tabRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (!this.checked) return;

                    if (this.id === 'tab_camera') {
                        fileInput.setAttribute('capture', 'environment');
                    } else {
                        fileInput.removeAttribute('capture');
                    }

                    showPanel(this.id === 'tab_upload' ? 'panel-upload' : 'panel-camera');
                });
            });

            fileInput.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    panels.forEach(p => p.classList.add('hidden'));
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            });

            resetBtn.addEventListener('click', function () {
                fileInput.value = '';
                previewContainer.classList.add('hidden');
                previewImage.src = '';

                const active = document.querySelector('[data-tab-radio]:checked');
                showPanel(active.id === 'tab_upload' ? 'panel-upload' : 'panel-camera');
            });

            showPanel('panel-upload');
        })();
    </script>
@endpush