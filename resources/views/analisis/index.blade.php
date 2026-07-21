@extends('layouts.app')

@section('title', 'Analisis')

@section('content')
    @php $latest = session('latest_analysis'); @endphp

    @if ($latest)
        {{-- Result Mode --}}
        <div class="flex flex-col gap-8">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 flex items-center gap-2 sm:gap-3">
                    <x-heroicon-o-check-circle class="w-7 sm:w-8 h-7 sm:h-8 text-green-500" /> Hasil Analisis
                </h2>
                <a href="{{ route('analisis') }}"
                    class="self-stretch sm:self-auto text-center inline-flex items-center justify-center gap-2 bg-green-500 text-white px-5 sm:px-6 py-3 rounded-xl font-bold border-3 border-black shadow-[5px_5px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[7px_7px_0px_rgba(0,0,0,1)] transition-all text-sm sm:text-base">
                    <x-heroicon-o-arrow-up-tray class="w-5 h-5" /> Analisis Lagi
                </a>
            </div>

            <div class="bg-white rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)]">
                <div class="flex flex-col lg:flex-row gap-6 mb-8">
                    <div class="w-full lg:w-64 shrink-0">
                        <img src="{{ $latest->image_path }}" alt="Bahan Makanan"
                            class="w-full h-36 sm:h-48 lg:h-40 object-cover rounded-xl border-3 border-black">
                    </div>
                    <div class="grow">
                        <h4 class="font-bold text-lg mb-3 text-gray-800 flex items-center gap-2">
                            <x-heroicon-o-square-3-stack-3d class="w-5 h-5 text-green-600" />
                            Bahan Terdeteksi
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($latest->detected_ingredients as $ingredient)
                                <span class="bg-green-100 text-green-800 text-sm font-bold px-4 py-1.5 border-2 border-green-600 rounded-full">
                                    {{ $ingredient }}
                                </span>
                            @endforeach
                        </div>
                        <p class="text-sm text-gray-500 mt-4">
                            Dianalisis pada {{ $latest->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($latest->recommendations as $rec)
                        <div class="border-2 border-black rounded-xl p-5 bg-[#fcf9f8] flex flex-col">
                            <div class="flex items-start justify-between mb-3">
                                <h4 class="font-bold text-lg text-gray-900 leading-tight">{{ $rec->recipe_name }}</h4>
                                <span class="shrink-0 ml-2 bg-green-500 text-white text-xs font-bold px-2.5 py-1 border-2 border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]">
                                    {{ $rec->match_percentage }}%
                                </span>
                            </div>

                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $rec->reason }}</p>

                            <div class="flex flex-wrap items-center gap-2 mb-4">
                                <span class="text-xs font-bold px-3 py-1 border-2 border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                    @switch($rec->difficulty)
                                        @case('Mudah') bg-green-200 text-green-900 @break
                                        @case('Sedang') bg-yellow-200 text-yellow-900 @break
                                        @case('Sulit') bg-red-200 text-red-900 @break
                                        @default bg-gray-200 text-gray-900
                                    @endswitch">
                                    {{ $rec->difficulty }}
                                </span>
                                <span class="text-xs text-gray-600 font-semibold flex items-center gap-1">
                                    <x-heroicon-o-clock class="w-4 h-4" /> {{ $rec->cooking_time }} menit
                                </span>
                            </div>

                            <div class="mt-auto">
                                <a href="{{ route('riwayat.show', $latest) }}"
                                    class="block w-full text-center px-4 py-2.5 bg-yellow-400 font-bold border-2 border-black rounded-md shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[5px_5px_0px_rgba(0,0,0,1)] transition-all text-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-6">
                    <a href="{{ route('riwayat') }}"
                        class="inline-flex items-center gap-2 text-green-700 font-bold hover:text-green-900 transition-all text-sm">
                        <x-heroicon-o-arrow-right class="w-4 h-4" /> Lihat Semua Riwayat Analisis
                    </a>
                </div>
            </div>
        </div>
    @else
        {{-- Normal Mode: Hero + Upload Form + Tips --}}
        <div class="flex flex-col gap-8">
            <!-- Hero -->
            <div class="bg-white rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)]">
                <h2 class="text-3xl font-bold mb-6 text-gray-900 flex items-center gap-3">
                   <x-ri-ai-generate-2-line class="w-8 h-8" /> Analisis Bahan Makanan
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
                            data-dropzone
                            class="flex flex-col items-center justify-center w-full min-h-48 md:min-h-65 border-2 border-dashed border-gray-400 rounded-xl bg-[#fcf9f8] cursor-pointer hover:border-green-500 hover:bg-green-50/30 transition-all duration-200 p-8 group">
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
                    <div id="panel-camera" class="hidden relative" data-panel>
                        <div class="relative w-full min-h-48 md:min-h-65 border-2 border-black rounded-xl bg-black overflow-hidden">
                            <video id="camera-feed" class="w-full h-full object-cover" autoplay playsinline muted></video>
                            <canvas id="camera-canvas" class="hidden"></canvas>

                            <div id="camera-placeholder" class="absolute inset-0 flex flex-col items-center justify-center bg-gray-100 p-4 text-center">
                                <div class="w-16 h-16 bg-blue-100 border-2 border-black rounded-full flex items-center justify-center shadow-[3px_3px_0px_rgba(0,0,0,1)]">
                                    <x-heroicon-o-camera class="w-8 h-8 text-blue-600" />
                                </div>
                                <p class="text-lg font-bold text-gray-800 mt-4">Akses kamera diperlukan</p>
                                <p class="text-sm text-gray-500 mt-1">Izinkan akses kamera untuk memotret bahan makanan</p>
                                <button type="button" id="start-camera-btn"
                                    class="mt-4 px-6 py-2.5 bg-blue-500 text-white font-bold border-2 border-black rounded-lg shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 hover:-translate-x-0.5 hover:shadow-[4px_4px_0px_rgba(0,0,0,1)] transition-all">
                                    Nyalakan Kamera
                                </button>
                                <p id="camera-error" class="text-sm text-red-600 font-semibold mt-3 hidden"></p>
                            </div>

                            <button type="button" id="capture-btn"
                                class="absolute bottom-4 left-1/2 -translate-x-1/2 w-14 h-14 bg-white border-4 border-black rounded-full shadow-[4px_4px_0px_rgba(0,0,0,1)] hover:bg-gray-200 transition-all hidden z-10">
                                <span class="block w-9 h-9 bg-red-500 rounded-full mx-auto"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Preview -->
                    <div id="preview-container"
                        class="hidden relative w-full min-h-48 md:min-h-65 rounded-xl overflow-hidden border-3 border-black bg-gray-900"
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
                        <button type="submit" id="submit-btn"
                            class="bg-green-500 hover:bg-green-600 text-white px-10 py-4 rounded-xl font-bold border-3 border-black shadow-[5px_5px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:-translate-x-1 hover:shadow-[7px_7px_0px_rgba(0,0,0,1)] transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0 disabled:hover:translate-x-0 disabled:hover:shadow-[5px_5px_0px_rgba(0,0,0,1)]">
                            <span id="submit-text">Analisis Sekarang</span>
                            <span id="submit-loading" class="hidden items-center gap-2">
                                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                Menganalisis...
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tips Card -->
            <div class="bg-amber-50 rounded-xl p-8 border-3 border-black shadow-[8px_8px_0px_rgba(0,0,0,1)]">
                <h3 class="text-xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                    <x-heroicon-o-light-bulb class="w-6 h-6 text-amber-500" /> Tips Foto yang Baik
                </h3>
                <div class="grid md:grid-cols-3 gap-4 md:gap-6">
                    <div class="flex flex-col items-center text-center gap-3 p-3 md:p-4">
                        <div
                            class="w-12 h-12 bg-amber-400 border-2 border-black rounded-full flex items-center justify-center shadow-[3px_3px_0px_rgba(0,0,0,1)] shrink-0 text-lg font-bold">
                            1
                        </div>
                        <p class="text-gray-700 font-semibold">Pastikan pencahayaan cukup agar bahan makanan terlihat jelas.</p>
                    </div>
                    <div class="flex flex-col items-center text-center gap-3 p-3 md:p-4">
                        <div
                            class="w-12 h-12 bg-amber-400 border-2 border-black rounded-full flex items-center justify-center shadow-[3px_3px_0px_rgba(0,0,0,1)] shrink-0 text-lg font-bold">
                            2
                        </div>
                        <p class="text-gray-700 font-semibold">Letakkan bahan di permukaan yang bersih dan kontras.</p>
                    </div>
                    <div class="flex flex-col items-center text-center gap-3 p-3 md:p-4">
                        <div
                            class="w-12 h-12 bg-amber-400 border-2 border-black rounded-full flex items-center justify-center shadow-[3px_3px_0px_rgba(0,0,0,1)] shrink-0 text-lg font-bold">
                            3
                        </div>
                        <p class="text-gray-700 font-semibold">Ambil foto dari sudut atas (top-down) untuk hasil terbaik.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        (function () {
            const form = document.querySelector('form');
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            const submitLoading = document.getElementById('submit-loading');

            if (!form || !submitBtn) return;

            let submitting = false;

            form.addEventListener('submit', function (e) {
                if (submitting) {
                    e.preventDefault();

                    return false;
                }
                submitting = true;
                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                submitLoading.classList.remove('hidden');
            });
        })();

        (function () {
            const fileInput = document.getElementById('file-input');
            const tabRadios = document.querySelectorAll('[data-tab-radio]');
            const panels = document.querySelectorAll('[data-panel]');
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');
            const resetBtn = document.getElementById('reset-preview');

            const cameraFeed = document.getElementById('camera-feed');
            const cameraCanvas = document.getElementById('camera-canvas');
            const cameraPlaceholder = document.getElementById('camera-placeholder');
            const startCameraBtn = document.getElementById('start-camera-btn');
            const captureBtn = document.getElementById('capture-btn');
            const cameraError = document.getElementById('camera-error');

            let cameraStream = null;

            function showPanel(id) {
                panels.forEach(p => p.classList.add('hidden'));
                const el = document.getElementById(id);
                if (el) el.classList.remove('hidden');
            }

            async function startCamera() {
                try {
                    cameraError.classList.add('hidden');

                    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                        throw new DOMException('', 'NotSupportedError');
                    }

                    cameraStream = await navigator.mediaDevices.getUserMedia({
                        video: { width: { ideal: 1280 }, height: { ideal: 720 } },
                        audio: false,
                    });
                    cameraFeed.srcObject = cameraStream;
                    await cameraFeed.play();
                    cameraPlaceholder.classList.add('hidden');
                    captureBtn.classList.remove('hidden');
                } catch (err) {
                    let msg = `Tidak dapat mengakses kamera (${err.name}).`;
                    if (err.name === 'NotAllowedError') {
                        msg = 'Izin kamera ditolak. Izinkan akses kamera di pengaturan browser.';
                    } else if (err.name === 'NotFoundError') {
                        msg = 'Tidak ditemukan kamera pada perangkat ini.';
                    } else if (err.name === 'NotReadableError') {
                        msg = 'Kamera sedang digunakan oleh aplikasi lain.';
                    } else if (err.name === 'SecurityError') {
                        msg = 'Akses kamera tidak diizinkan. Pastikan halaman diakses via HTTPS (herd secure cooklens-app).';
                    } else if (err.name === 'NotSupportedError' || err.name === 'TypeError') {
                        msg = 'Akses kamera membutuhkan HTTPS. Jalankan: herd secure cooklens-app';
                    }
                    cameraError.textContent = msg;
                    cameraError.classList.remove('hidden');
                }
            }

            function stopCamera() {
                if (cameraStream) {
                    cameraStream.getTracks().forEach(t => t.stop());
                    cameraStream = null;
                }
                cameraFeed.srcObject = null;
                captureBtn.classList.add('hidden');
                cameraPlaceholder.classList.remove('hidden');
                cameraError.classList.add('hidden');
            }

            function capturePhoto() {
                const w = cameraFeed.videoWidth;
                const h = cameraFeed.videoHeight;
                cameraCanvas.width = w;
                cameraCanvas.height = h;
                const ctx = cameraCanvas.getContext('2d');
                ctx.drawImage(cameraFeed, 0, 0, w, h);

                cameraCanvas.toBlob(function (blob) {
                    const file = new File([blob], 'camera-capture.jpg', { type: 'image/jpeg' });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        panels.forEach(p => p.classList.add('hidden'));
                        previewContainer.classList.remove('hidden');
                        stopCamera();
                    };
                    reader.readAsDataURL(file);
                }, 'image/jpeg', 0.92);
            }

            tabRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (!this.checked) return;

                    if (this.id === 'tab_camera') {
                        captureBtn.classList.add('hidden');
                        showPanel('panel-camera');
                        cameraPlaceholder.classList.remove('hidden');
                        cameraError.classList.add('hidden');
                    } else {
                        if (cameraStream) stopCamera();
            const dropzone = document.querySelector('[data-dropzone]');

            if (dropzone) {
                ['dragenter', 'dragover'].forEach(type => {
                    dropzone.addEventListener(type, function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        this.classList.add('border-green-500', 'bg-green-100');
                    });
                });

                ['dragleave', 'drop'].forEach(type => {
                    dropzone.addEventListener(type, function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        this.classList.remove('border-green-500', 'bg-green-100');
                    });
                });

                dropzone.addEventListener('drop', function (e) {
                    const file = e.dataTransfer.files[0];
                    if (!file || !file.type.startsWith('image/')) return;

                    const dt = new DataTransfer();
                    dt.items.add(file);
                    fileInput.files = dt.files;

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        panels.forEach(p => p.classList.add('hidden'));
                        previewContainer.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                });
            }

            showPanel('panel-upload');
                    }
                });
            });

            startCameraBtn.addEventListener('click', startCamera);
            captureBtn.addEventListener('click', capturePhoto);

            fileInput.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    panels.forEach(p => p.classList.add('hidden'));
                    previewContainer.classList.remove('hidden');
                    if (cameraStream) stopCamera();
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