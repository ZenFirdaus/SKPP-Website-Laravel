<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Permohonan
        </h2>
    </x-slot>

```
<div class="py-12 max-w-4xl mx-auto">

    <form action="{{ route('permohonan.update', $permohonan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" value="{{ $permohonan->nama_perusahaan }}" class="border w-full p-2">
        </div>

        <div class="mb-4">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ $permohonan->alamat }}" class="border w-full p-2">
        </div>

        <div class="mb-4">
            <label>NPWP</label>
            <input type="text" name="npwp" value="{{ $permohonan->npwp }}" class="border w-full p-2">
        </div>

        <div class="mb-4">
            <label>Keperluan</label>
            <textarea name="keperluan" class="border w-full p-2">{{ $permohonan->keperluan }}</textarea>
        </div>

        <button class="bg-green-500 text-white px-4 py-2 rounded">
            Update
        </button>

    </form>

</div>
```

</x-app-layout>
