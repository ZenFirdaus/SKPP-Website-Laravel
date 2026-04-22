<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-300 flex justify-center">
    <div class="w-full max-w-[430px] min-h-screen bg-[#e5e7eb] rounded-[40px] shadow-2xl overflow-hidden relative">

        <!-- HEADER -->
        <div class="bg-gradient-to-b from-cyan-400 to-blue-600 h-[150px] rounded-b-[40px] px-6 pt-6 text-white relative">
            <a href="{{ route('mitra.dashboard') }}">
                <svg class="w-7 h-7 absolute left-6 top-6" fill="none" stroke="white" stroke-width="2">
                    <path d="M15 18l-6-6 6-6" />
                </svg>
            </a>
            <svg class="w-6 h-6 absolute right-6 top-6" fill="white">
                <circle cx="12" cy="5" r="2" />
                <circle cx="12" cy="12" r="2" />
                <circle cx="12" cy="19" r="2" />
            </svg>
            <div class="flex justify-center items-center h-full">
                <h1 class="text-3xl font-semibold">Pengajuan</h1>
            </div>
        </div>

        <!-- FORM -->
        <form action="{{ route('mitra.pengajuan.store') }}" method="POST" enctype="multipart/form-data"
            class="px-5 mt-[-20px] pb-28 space-y-5">
            @csrf

            <!-- ERROR -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 rounded-2xl p-4 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- DATA DIRI -->
            <div class="bg-white rounded-3xl p-5 shadow-md space-y-4">
                <h3 class="font-semibold text-gray-700 text-base">Data Pengajuan</h3>

                <div>
                    <label class="text-sm text-gray-500 mb-1 block">Nama Pegawai <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}"
                        placeholder="Masukkan Nama Pegawai"
                        class="w-full p-3 rounded-xl bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                </div>

                <div>
                    <label class="text-sm text-gray-500 mb-1 block">Alamat <span class="text-red-500">*</span></label>
                    <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan Alamat"
                        class="w-full p-3 rounded-xl bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                </div>

                <div>
                    <label class="text-sm text-gray-500 mb-1 block">NPWP <span
                            class="text-gray-400">(opsional)</span></label>
                    <input type="text" name="npwp" value="{{ old('npwp') }}" placeholder="Masukkan NPWP"
                        class="w-full p-3 rounded-xl bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                </div>

                <div>
                    <label class="text-sm text-gray-500 mb-1 block">Keperluan <span
                            class="text-red-500">*</span></label>
                    <textarea name="keperluan" placeholder="Masukkan Keperluan" rows="3"
                        class="w-full p-3 rounded-xl bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm resize-none">{{ old('keperluan') }}</textarea>
                </div>
            </div>

            <!-- SLIP GAJI -->
            <div class="bg-white rounded-3xl p-5 shadow-md">
                <div class="flex items-center gap-4">
                    <div class="bg-indigo-500 w-12 h-12 flex items-center justify-center rounded-full flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="white" stroke-width="2">
                            <path d="M7 2h6l5 5v13H7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-base">Upload Slip Gaji</h3>
                        <p class="text-sm text-gray-500">Format: PDF, max 2mb</p>
                        @error('file_slip_gaji')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <label
                    class="mt-4 block border-2 border-dashed border-gray-300 rounded-2xl py-6 text-center cursor-pointer hover:border-blue-400 transition">
                    <input type="file" id="slipInput" name="file_slip_gaji" class="hidden" accept="application/pdf">
                    <p id="slipText" class="text-gray-400 flex justify-center items-center gap-2 text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 16V4" />
                            <path d="M8 8l4-4 4 4" />
                            <path d="M4 20h16" />
                        </svg>
                        Pilih File PDF
                    </p>
                    <p id="slipName" class="hidden text-gray-700 font-medium text-sm"></p>
                    <p id="error-slip" class="text-red-500 text-xs mt-1 hidden"></p>
                </label>
                <div id="slipActions" class="hidden flex gap-3 mt-3">
                    <button type="button" id="deleteSlip" class="text-red-500 text-sm">Hapus File</button>
                </div>
            </div>

            <!-- SK -->
            <div class="bg-white rounded-3xl p-5 shadow-md">
                <div class="flex items-center gap-4">
                    <div
                        class="bg-red-400 w-12 h-12 flex items-center justify-content rounded-full flex-shrink-0 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="white" stroke-width="2">
                            <path d="M7 2h6l5 5v13H7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-base">Upload SK</h3>
                        <p class="text-sm text-gray-500">Format: PDF, max 2mb</p>
                        @error('file_sk')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <label
                    class="mt-4 block border-2 border-dashed border-gray-300 rounded-2xl py-6 text-center cursor-pointer hover:border-blue-400 transition">
                    <input type="file" id="skInput" name="file_sk" class="hidden" accept="application/pdf">
                    <p id="skText" class="text-gray-400 flex justify-center items-center gap-2 text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 16V4" />
                            <path d="M8 8l4-4 4 4" />
                            <path d="M4 20h16" />
                        </svg>
                        Pilih File PDF
                    </p>
                    <p id="skName" class="hidden text-gray-700 font-medium text-sm"></p>
                    <p id="error-sk" class="text-red-500 text-xs mt-1 hidden"></p>
                </label>
                <div id="skActions" class="hidden flex gap-3 mt-3">
                    <button type="button" id="deleteSk" class="text-red-500 text-sm">Hapus File</button>
                </div>
            </div>

            <!-- SURAT PENGANTAR -->
            <div class="bg-white rounded-3xl p-5 shadow-md">
                <div class="flex items-center gap-4">
                    <div class="bg-yellow-400 w-12 h-12 flex items-center justify-center rounded-full flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="white" stroke-width="2">
                            <path d="M7 2h6l5 5v13H7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-base">Upload Surat Pengantar</h3>
                        <p class="text-sm text-gray-500">Format: PDF, max 2mb</p>
                        @error('file_skpp')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <label
                    class="mt-4 block border-2 border-dashed border-gray-300 rounded-2xl py-6 text-center cursor-pointer hover:border-blue-400 transition">
                    <input type="file" id="skppInput" name="file_skpp" class="hidden" accept="application/pdf">
                    <p id="skppText" class="text-gray-400 flex justify-center items-center gap-2 text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 16V4" />
                            <path d="M8 8l4-4 4 4" />
                            <path d="M4 20h16" />
                        </svg>
                        Pilih File PDF
                    </p>
                    <p id="skppName" class="hidden text-gray-700 font-medium text-sm"></p>
                    <p id="error-skpp" class="text-red-500 text-xs mt-1 hidden"></p>
                </label>
                <div id="skppActions" class="hidden flex gap-3 mt-3">
                    <button type="button" id="deleteSkpp" class="text-red-500 text-sm">Hapus File</button>
                </div>
            </div>

            <!-- TOMBOL KIRIM -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-cyan-400 to-blue-500 text-white py-4 rounded-full text-lg font-semibold shadow-lg hover:opacity-90 transition">
                Kirim Pengajuan
            </button>

        </form>

        <!-- NAVBAR -->
        <div class="absolute bottom-0 w-full bg-white border-t flex justify-around py-4">
            <div class="text-blue-500">
                <a href="{{ route('mitra.dashboard') }}">
                    <svg class="w-7 h-7" fill="currentColor">
                        <path d="M3 9l9-7 9 7v11H3z" />
                    </svg>
                </a>
            </div>
            <div>
                <svg class="w-8 h-8" fill="none" stroke="black" stroke-width="2">
                    <path d="M12 5v14M5 12h14" />
                </svg>
            </div>
            <div>
                <a href="{{ route('profile.edit') }}">
                    <svg class="w-7 h-7" fill="none" stroke="black" stroke-width="2">
                        <circle cx="12" cy="7" r="4" />
                        <path d="M5 21c1.5-4 12.5-4 14 0" />
                    </svg>
                </a>
            </div>
        </div>

    </div>

    <script>
        function setupUpload(inputId, textId, nameId, errorId, actionsId, deleteId) {
            const input = document.getElementById(inputId);
            const text = document.getElementById(textId);
            const nameText = document.getElementById(nameId);
            const error = document.getElementById(errorId);
            const actions = document.getElementById(actionsId);
            const deleteBtn = document.getElementById(deleteId);

            input.addEventListener('change', function() {
                const file = this.files[0];
                if (!file) return;

                if (file.size > 2048 * 1024) {
                    error.textContent = 'File tidak boleh lebih dari 2MB';
                    error.classList.remove('hidden');
                    input.value = '';
                    return;
                }
                if (file.type !== 'application/pdf') {
                    error.textContent = 'File harus berformat PDF';
                    error.classList.remove('hidden');
                    input.value = '';
                    return;
                }

                error.classList.add('hidden');
                text.classList.add('hidden');
                nameText.classList.remove('hidden');
                actions.classList.remove('hidden');
                nameText.textContent = '✓ ' + file.name;
            });

            deleteBtn.addEventListener('click', function() {
                input.value = '';
                nameText.textContent = '';
                nameText.classList.add('hidden');
                text.classList.remove('hidden');
                actions.classList.add('hidden');
            });
        }

        setupUpload('slipInput', 'slipText', 'slipName', 'error-slip', 'slipActions', 'deleteSlip');
        setupUpload('skInput', 'skText', 'skName', 'error-sk', 'skActions', 'deleteSk');
        setupUpload('skppInput', 'skppText', 'skppName', 'error-skpp', 'skppActions', 'deleteSkpp');
    </script>
</body>

</html>
