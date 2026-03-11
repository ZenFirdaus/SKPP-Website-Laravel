@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Permohonan</h1>
    <form action="{{ route('permohonans.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan') }}">
            @error('nama_perusahaan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}">
            @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>NPWP</label>
            <input type="text" name="npwp" class="form-control" value="{{ old('npwp') }}">
            @error('npwp') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Keperluan</label>
            <textarea name="keperluan" class="form-control">{{ old('keperluan') }}</textarea>
            @error('keperluan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('permohonans.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection