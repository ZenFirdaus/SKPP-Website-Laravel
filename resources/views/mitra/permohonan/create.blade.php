<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Permohonan SKPP
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Data Umum --}}
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Nama Pegawai / Perusahaan</label>
                        <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}"
                            class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Alamat</label>
                        <input type="text" name="alamat" value="{{ old('alamat') }}"
                            class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">NPWP <span class="text-gray-400 text-sm">(opsional)</span></label>
                        <input type="text" name="npwp" value="{{ old('npwp') }}"
                            class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Keperluan</label>
                        <textarea name="keperluan" rows="3"
                            class="border border-gray-300 rounded w-full p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('keperluan') }}</textarea>
                    </div>

                    {{-- Upload Dokumen --}}
                    <div class="border-t pt-4 mt-4">
                        <h3 class="font-semibold text-gray-700 mb-3">Upload Dokumen Pendukung <span class="text-red-500">*</span></h3>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-1">
                                Slip Gaji <span class="text-red-500">*</span>
                                <span class="text-gray-400 text-sm font-normal">(PDF, maks 2MB)</span>
                            </label>
                            <input type="file" name="file_slip_gaji" accept=".pdf"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                       file:rounded file:border-0 file:text-sm file:font-semibold
                                       file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('file_slip_gaji')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-1">
                                Surat Keputusan (SK) <span class="text-red-500">*</span>
                                <span class="text-gray-400 text-sm font-normal">(PDF, maks 2MB)</span>
                            </label>
                            <input type="file" name="file_sk" accept=".pdf"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                       file:rounded file:border-0 file:text-sm file:font-semibold
                                       file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('file_sk')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-1">
                                Dokumen SKPP <span class="text-red-500">*</span>
                                <span class="text-gray-400 text-sm font-normal">(PDF, maks 2MB)</span>
                            </label>
                            <input type="file" name="file_skpp" accept=".pdf"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                       file:rounded file:border-0 file:text-sm file:font-semibold
                                       file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('file_skpp')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-semibold">
                            Ajukan Permohonan
                        </button>
                        <a href="{{ route('permohonan.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded font-semibold">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>