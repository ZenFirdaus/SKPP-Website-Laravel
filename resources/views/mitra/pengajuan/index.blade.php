<!DOCTYPE html>
<html lang="en">

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

            <!-- BACK -->
            <a href="{{ route('dashboard') }}">
                <svg class="w-7 h-7 absolute left-6 top-6" fill="none" stroke="white" stroke-width="2">
                    <path d="M15 18l-6-6 6-6" />
                </svg>
            </a>

            <!-- TITIK 3 -->
            <svg class="w-6 h-6 absolute right-6 top-6" fill="white">
                <circle cx="12" cy="5" r="2" />
                <circle cx="12" cy="12" r="2" />
                <circle cx="12" cy="19" r="2" />
            </svg>

            <!-- TITLE -->
            <div class="flex justify-center items-center h-full">
                <h1 class="text-3xl font-semibold">Pengajuan</h1>
            </div>
        </div>

        <!-- CONTENT -->
        <form action="{{ route('mitra.pengajuan.store') }}" method="POST" enctype="multipart/form-data"
    class="px-5 mt-[-20px] pb-28 space-y-10">
    @csrf

    {{-- <div class="bg-white rounded-3xl p-5 shadow-md space-y-3">

    <input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan"
        class="w-full p-3 rounded-xl border focus:outline-none focus:ring-2 focus:ring-blue-400">

    <input type="text" name="alamat" placeholder="Alamat"
        class="w-full p-3 rounded-xl border focus:outline-none focus:ring-2 focus:ring-blue-400">

    <textarea name="keperluan" placeholder="Keperluan"
        class="w-full p-3 rounded-xl border focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>

</div> --}}

    <!-- SLIP GAJI -->
    <div class="bg-white rounded-3xl p-5 shadow-md">
        <div class="flex items-center gap-4">
            <div class="bg-indigo-500 w-12 h-12 flex items-center justify-center rounded-full">
                <svg class="w-6 h-6 text-white" fill="none" stroke="white" stroke-width="2">
                    <path d="M7 2h6l5 5v13H7z" />
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-lg">Upload Slip Gaji</h3>
                <p class="text-sm text-gray-500">Format: PDF, max 2mb</p>
                <p id="error-slip" class="text-red-500 text-sm mt-1 hidden"></p>
            </div>
        </div>

        <label class="mt-4 block border-2 border-dashed border-gray-300 rounded-2xl py-6 text-center cursor-pointer">
            <input type="file" id="slipInput" name="file_slip_gaji" class="hidden" accept="application/pdf">

            <p id="slipText" class="text-gray-400 flex justify-center items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 16V4" />
                    <path d="M8 8l4-4 4 4" />
                    <path d="M4 20h16" />
                </svg>
                Pilih File
            </p>

            <p id="slipName" class="hidden text-gray-700 font-medium"></p>
        </label>

        <div id="slipActions" class="hidden flex gap-3 mt-3">
            <button type="button" id="renameSlip" class="text-blue-500 text-sm">Rename</button>
            <button type="button" id="deleteSlip" class="text-red-500 text-sm">Delete</button>
        </div>
    </div>

    <!-- SK -->
    <div class="bg-white rounded-3xl p-5 shadow-md">
        <div class="flex items-center gap-4">
            <div class="bg-red-400 w-12 h-12 flex items-center justify-center rounded-full">
                <svg class="w-6 h-6 text-white" fill="none" stroke="white" stroke-width="2">
                    <path d="M7 2h6l5 5v13H7z" />
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-lg">Upload SK</h3>
                <p class="text-sm text-gray-500">Format: PDF, max 2mb</p>
                <p id="error-sk" class="text-red-500 text-sm mt-1 hidden"></p>
            </div>
        </div>

        <label class="mt-4 block border-2 border-dashed border-gray-300 rounded-2xl py-6 text-center cursor-pointer">
            <input type="file" id="skInput" name="file_sk" class="hidden" accept="application/pdf">

            <p id="skText" class="text-gray-400 flex justify-center items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 16V4" />
                    <path d="M8 8l4-4 4 4" />
                    <path d="M4 20h16" />
                </svg>
                Pilih File
            </p>

            <p id="skName" class="hidden text-gray-700 font-medium"></p>
        </label>

        <div id="skActions" class="hidden flex gap-3 mt-3">
            <button type="button" id="renameSk" class="text-blue-500 text-sm">Rename</button>
            <button type="button" id="deleteSk" class="text-red-500 text-sm">Delete</button>
        </div>
    </div>

    <!-- SURAT -->
    <div class="bg-white rounded-3xl p-5 shadow-md">
        <div class="flex items-center gap-4">
            <div class="bg-yellow-400 w-12 h-12 flex items-center justify-center rounded-full">
                <svg class="w-6 h-6 text-white" fill="none" stroke="white" stroke-width="2">
                    <path d="M7 2h6l5 5v13H7z" />
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-lg">Upload Surat pengantar</h3>
                <p class="text-sm text-gray-500">Format: PDF, max 2mb</p>
                <p id="error-skpp" class="text-red-500 text-sm mt-1 hidden"></p>
            </div>
        </div>

        <label class="mt-4 block border-2 border-dashed border-gray-300 rounded-2xl py-6 text-center cursor-pointer">
            <input type="file" id="skppInput" name="file_skpp" class="hidden" accept="application/pdf">

            <p id="skppText" class="text-gray-400 flex justify-center items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 16V4" />
                    <path d="M8 8l4-4 4 4" />
                    <path d="M4 20h16" />
                </svg>
                Pilih File
            </p>

            <p id="skppName" class="hidden text-gray-700 font-medium"></p>
        </label>

        <div id="skppActions" class="hidden flex gap-3 mt-3">
            <button type="button" id="renameSkpp" class="text-blue-500 text-sm">Rename</button>
            <button type="button" id="deleteSkpp" class="text-red-500 text-sm">Delete</button>
        </div>
    </div>

    <!-- BUTTON -->
    <button class="w-full bg-gradient-to-r from-cyan-400 to-blue-500 text-white py-3 rounded-full text-lg font-semibold shadow-lg">
        Kirim
    </button>
</form>

        <!-- NAVBAR -->
        <div class="fixed bottom-0 w-full bg-white border-t flex justify-around py-4">
            <a href="#">
                <svg class="w-7 h-7" fill="black">
                    <path d="M3 9l9-7 9 7v11H3z" />
                </svg>
            </a>

            <a href="#">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14" />
                </svg>
            </a>

            <a href="#">
                <svg class="w-7 h-7" fill="none" stroke="black" stroke-width="2">
                    <circle cx="12" cy="7" r="4" />
                    <path d="M5 21c1.5-4 12.5-4 14 0" />
                </svg>
            </a>
        </div>

    </div>

   <script>
function setupUpload(inputId, textId, nameId, errorId, actionsId, renameId, deleteId) {
    const input = document.getElementById(inputId);
    const text = document.getElementById(textId);
    const nameText = document.getElementById(nameId);
    const error = document.getElementById(errorId);
    const actions = document.getElementById(actionsId);
    const renameBtn = document.getElementById(renameId);
    const deleteBtn = document.getElementById(deleteId);

    input.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        if (file.size > 2048 * 1024) {
            error.textContent = "File tidak boleh lebih dari 2MB";
            error.classList.remove('hidden');
            input.value = "";
            return;
        }

        if (file.type !== "application/pdf") {
            error.textContent = "File harus PDF";
            error.classList.remove('hidden');
            input.value = "";
            return;
        }

        error.classList.add('hidden');
        text.classList.add('hidden');
        nameText.classList.remove('hidden');
        actions.classList.remove('hidden');

        nameText.textContent = file.name;
    });

    deleteBtn.addEventListener('click', function () {
        input.value = "";
        nameText.textContent = "";
        nameText.classList.add('hidden');
        text.classList.remove('hidden');
        actions.classList.add('hidden');
    });

    renameBtn.addEventListener('click', function () {
        const newName = prompt("Masukkan nama baru file:");
        if (newName) {
            nameText.textContent = newName + ".pdf";
        }
    });
}

// INIT
setupUpload('slipInput','slipText','slipName','error-slip','slipActions','renameSlip','deleteSlip');
setupUpload('skInput','skText','skName','error-sk','skActions','renameSk','deleteSk');
setupUpload('skppInput','skppText','skppName','error-skpp','skppActions','renameSkpp','deleteSkpp');
</script>

</body>

</html>
