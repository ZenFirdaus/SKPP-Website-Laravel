<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail pengajuan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Status Badge --}}
                <div class="mb-6">
                    @php
                        $statusColor = match($pengajuan->status) {
                            'menunggu'  => 'bg-yellow-100 text-yellow-800',
                            'diproses'  => 'bg-blue-100 text-blue-800',
                            'disetujui' => 'bg-green-100 text-green-800',
                            'ditolak'   => 'bg-red-100 text-red-800',
                            default     => 'bg-gray-100 text-gray-800',
                        };
                    @endphp
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                        Status: {{ ucfirst($pengajuan->status) }}
                    </span>
                </div>

                {{-- Data pengajuan --}}
                <div class="grid grid-cols-1 gap-4 mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Nama Pegawai / Perusahaan</p>
                        <p class="font-medium">{{ $pengajuan->nama_perusahaan }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Alamat</p>
                        <p class="font-medium">{{ $pengajuan->alamat }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">NPWP</p>
                        <p class="font-medium">{{ $pengajuan->npwp ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Keperluan</p>
                        <p class="font-medium">{{ $pengajuan->keperluan }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Pengajuan</p>
                        <p class="font-medium">{{ $pengajuan->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                {{-- Dokumen --}}
                <div class="border-t pt-4">
                    <h3 class="font-semibold text-gray-700 mb-3">Dokumen Pendukung</h3>
                    <div class="space-y-3">

                        @foreach ([
                            'file_slip_gaji' => 'Slip Gaji',
                            'file_sk'        => 'Surat Keputusan (SK)',
                            'file_skpp'      => 'Dokumen SKPP',
                        ] as $field => $label)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded border">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h4l6 6v10a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                                </div>
                                @if ($pengajuan->$field)
                                    <a href="{{ Storage::url($pengajuan->$field) }}" target="_blank"
                                        class="text-sm text-blue-600 hover:underline font-medium">
                                        Lihat / Unduh
                                    </a>
                                @else
                                    <span class="text-sm text-gray-400">Belum diupload</span>
                                @endif
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('pengajuan.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded font-semibold">
                        ← Kembali
                    </a>
                    @if ($pengajuan->status === 'menunggu')
                        <a href="{{ route('pengajuan.edit', $pengajuan->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded font-semibold">
                            Edit
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>