{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Permohonan</h1>
    <a href="{{ route('permohonans.create') }}" class="btn btn-primary mb-3">Tambah Permohonan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Perusahaan</th>
                <th>Alamat</th>
                <th>NPWP</th>
                <th>Keperluan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($permohonans as $permohonan)
            <tr>
                <td>{{ $permohonan->nama_perusahaan }}</td>
                <td>{{ $permohonan->alamat }}</td>
                <td>{{ $permohonan->npwp ?? '-' }}</td>
                <td>{{ $permohonan->keperluan }}</td>
                <td>{{ $permohonan->status }}</td>
                <td>
                    <a href="{{ route('permohonans.show', $permohonan->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('permohonans.edit', $permohonan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('permohonans.destroy', $permohonan->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus permohonan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada permohonan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection --}}