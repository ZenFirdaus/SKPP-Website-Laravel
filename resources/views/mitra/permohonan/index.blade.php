<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Permohonan
        </h2>
    </x-slot>

```
<div class="py-12 max-w-6xl mx-auto">

    <a href="{{ route('permohonan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
        Tambah Permohonan
    </a>

    <table class="mt-4 w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Nama Perusahaan</th>
                <th class="p-2">Alamat</th>
                <th class="p-2">Status</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($permohonans as $permohonan)
            <tr>
                <td class="p-2">{{ $permohonan->nama_perusahaan }}</td>
                <td class="p-2">{{ $permohonan->alamat }}</td>
                <td class="p-2">{{ $permohonan->status }}</td>
                <td class="p-2">

                    <a href="{{ route('permohonan.show', $permohonan->id) }}" class="text-blue-500">
                        Detail
                    </a>

                    <a href="{{ route('permohonan.edit', $permohonan->id) }}" class="text-yellow-500 ml-2">
                        Edit
                    </a>

                    <form action="{{ route('permohonan.destroy', $permohonan->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 ml-2">
                            Hapus
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>
```

</x-app-layout>
