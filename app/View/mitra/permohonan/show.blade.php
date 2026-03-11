@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Permohonan</h1>
    <table class="table table-bordered">
        <tr><th>Nama Perusahaan</th><td>{{ $permohonan->nama_perusahaan }}</td></tr>
        <tr><th>Alamat</th><td>{{ $permohonan->alamat }}</td></tr>
        <tr><th>NPWP</th><td>{{ $permohonan->npwp ?? '-' }}</td></tr>
        <tr><th>Keperluan</th><td>{{ $permohonan->keperluan }}</td></tr>
        <tr><th>Status</th><td>{{ $permohonan->status }}</td></tr>
    </table>
    <a href="{{ route('permohonans.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection