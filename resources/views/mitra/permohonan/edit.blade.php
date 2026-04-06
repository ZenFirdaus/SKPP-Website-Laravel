<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Permohonan
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

                <form action="{{ route('permohonan.update', $permohonan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Nama Pegawai / Perusahaan</label>
                        <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $permohonan->nama_perusahaan) }}"
                            class="border border-gray-300 rounded w-full p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Alamat</label>
                        <input type="text" name="alamat" value="{{ old('alamat', $permohonan->alamat) }}"
                            class="border border-gray-300 rounded w-full p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">NPWP</label>
                        <input type="text" name="npwp" value="{{ old('npwp', $permohonan->npwp) }}"
                            class="border border-gray-300 rounded w-full p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Keperluan</label>
                        <textarea name="keperluan" rows="3"
                            class="border border-gray-300 rounded w-full p-2">{{ old('keperluan', $permohonan->keperluan) }}</textarea>
                    </div>

                    {{-- Upload Dokumen --}}
                    <div class="border-t pt-4 mt-4">
                        <h3 class="font-semibold text-gray-700 mb-3">Dokumen Pendukung</h3>
                        <p class="text-sm text-gray-500 mb-4">Kosongkan jika tidak ingin mengganti file yang sudah ada.</p>

                        {{-- Slip Gaji --}}
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-1">
                                Slip Gaji <span class="text-gray-400 text-sm font-normal">(PDF, maks 2MB)</span>
                            </label>
                            @if ($permohonan->file_slip_gaji)
                                <div class="flex items-center gap-2 mb-2 text-sm text-green-700 bg-green-50 px-3 py-2 rounded">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4l6 6v10a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                    File sudah ada —
                                    <a href="{{ Storage::url($permohonan->file_slip_gaji) }}" target="_blank" class="underline">Lihat File</a>
                                </div>
                            @endif
                            <input type="file" name="file_slip_gaji" accept=".pdf"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                       file:rounded file:border-0 file:text-sm file:font-semibold
                                       file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        {{-- SK --}}
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-1">
                                Surat Keputusan (SK) <span class="text-gray-400 text-sm font-normal">(PDF, maks 2MB)</span>
                            </label>
                            @if ($permohonan->file_sk)
                                <div class="flex items-center gap-2 mb-2 text-sm text-green-700 bg-green-50 px-3 py-2 rounded">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4l6 6v10a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                    File sudah ada —
                                    <a href="{{ Storage::url($permohonan->file_sk) }}" target="_blank" class="underline">Lihat File</a>
                                </div>
                            @endif
                            <input type="file" name="file_sk" accept=".pdf"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                       file:rounded file:border-0 file:text-sm file:font-semibold
                                       file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        {{-- SKPP --}}
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-1">
                                Dokumen SKPP <span class="text-gray-400 text-sm font-normal">(PDF, maks 2MB)</span>
                            </label>
                            @if ($permohonan->file_skpp)
                                <div class="flex items-center gap-2 mb-2 text-sm text-green-700 bg-green-50 px-3 py-2 rounded">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4l6 6v10a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                    File sudah ada —
                                    <a href="{{ Storage::url($permohonan->file_skpp) }}" target="_blank" class="underline">Lihat File</a>
                                </div>
                            @endif
                            <input type="file" name="file_skpp" accept=".pdf"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                       file:rounded file:border-0 file:text-sm file:font-semibold
                                       file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded font-semibold">
                            Update Permohonan
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