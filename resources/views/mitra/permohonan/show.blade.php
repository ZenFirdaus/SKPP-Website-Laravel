<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Permohonan
        </h2>
    </x-slot>

```
<div class="py-12 max-w-4xl mx-auto">

    <div class="mb-4">
        <strong>Nama Perusahaan:</strong>
        {{ $permohonan->nama_perusahaan }}
    </div>

    <div class="mb-4">
        <strong>Alamat:</strong>
        {{ $permohonan->alamat }}
    </div>

    <div class="mb-4">
        <strong>NPWP:</strong>
        {{ $permohonan->npwp }}
    </div>

    <div class="mb-4">
        <strong>Keperluan:</strong>
        {{ $permohonan->keperluan }}
    </div>

    <div class="mb-4">
        <strong>Status:</strong>
        {{ $permohonan->status }}
    </div>

</div>
```

</x-app-layout>
