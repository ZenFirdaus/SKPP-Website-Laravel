<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Detail Pencatatan - SKPP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #dff0f7;
            display: flex;
            justify-content: center;
        }

        .shell {
            width: 100%;
            max-width: 430px;
            min-height: 100vh;
            background: #dff0f7;
            display: flex;
            flex-direction: column;
        }

        .top-bar {
            background: linear-gradient(160deg, #2ec6e8 0%, #1a8fb3 100%);
            padding: 20px 20px 52px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 0 0 32px 32px;
        }

        .top-bar a {
            color: #fff;
            font-size: 28px;
            text-decoration: none;
            padding: 4px 8px;
            border-radius: 10px;
            transition: background 0.2s;
        }

        .top-bar h2 {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            flex: 1;
            text-align: center;
        }

        .content {
            flex: 1;
            padding: 16px 16px 100px;
            margin-top: -24px;
        }

        .card {
            background: #fff;
            border-radius: 24px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .card h3 {
            font-size: 16px;
            font-weight: 700;
            color: #1a8fb3;
            margin-bottom: 12px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f4f4f4;
            font-size: 13px;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #777;
            width: 40%;
        }

        .info-value {
            color: #222;
            font-weight: 600;
            width: 60%;
            text-align: right;
            word-break: break-word;
        }

        .badge-valid {
            background: #d4edda;
            color: #155724;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50px;
        }

        .badge-invalid {
            background: #f8d7da;
            color: #721c24;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50px;
        }

        .doc-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            background: #f8fcfe;
            border-radius: 12px;
            margin-bottom: 8px;
        }

        .doc-name {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #333;
        }

        .doc-name svg {
            width: 18px;
            height: 18px;
            stroke: #e74c3c;
            fill: none;
            stroke-width: 2;
        }

        .btn-view-doc {
            font-size: 12px;
            font-weight: 600;
            color: #1a8fb3;
            text-decoration: underline;
        }

        .btn-edit {
            display: block;
            width: 100%;
            background: #1a8fb3;
            color: #fff;
            border-radius: 50px;
            padding: 14px;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            margin-top: 14px;
        }

        .btn-edit:hover {
            background: #157a9a;
        }

        .navbar {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 430px;
            background: #fff;
            border-top: 1px solid #e8e8e8;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 12px 0 20px;
            z-index: 100;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            padding: 6px 14px;
            border-radius: 14px;
            text-decoration: none;
        }

        .nav-item svg {
            width: 26px;
            height: 26px;
            stroke: #aaa;
            fill: none;
            stroke-width: 1.8;
        }

        .nav-item.active svg {
            stroke: #1a8fb3;
        }

        .nav-plus {
            width: 50px;
            height: 50px;
            background: #1a8fb3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: -20px;
            box-shadow: 0 4px 14px rgba(26, 143, 179, 0.4);
            text-decoration: none;
        }

        .nav-plus svg {
            stroke: #fff;
            width: 24px;
            height: 24px;
            fill: none;
            stroke-width: 2;
        }
    </style>
</head>

<body>
    <div class="shell">
        <div class="top-bar">
            <a href="{{ route('staff.pencatatan.index') }}">&#8249;</a>
            <h2>Detail Pencatatan</h2>
            <span style="width:40px"></span>
        </div>

        <div class="content">
            <!-- DATA PENGAJUAN -->
            <div class="card">
                <h3>Informasi Pengajuan</h3>
                <div class="info-row">
                    <span class="info-label">Nomor SKPP</span>
                    <span class="info-value">SKPP {{ str_pad($pengajuan->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Pemohon</span>
                    <span class="info-value">{{ $pengajuan->user?->name ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email Pemohon</span>
                    <span class="info-value">{{ $pengajuan->user?->email ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Instansi / Perusahaan</span>
                    <span class="info-value">{{ $pengajuan->nama_perusahaan }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Alamat</span>
                    <span class="info-value">{{ $pengajuan->alamat }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">NPWP</span>
                    <span class="info-value">{{ $pengajuan->npwp ?: '—' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Keperluan</span>
                    <span class="info-value">{{ $pengajuan->keperluan }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Masuk</span>
                    <span class="info-value">{{ $pengajuan->created_at->translatedFormat('d M Y, H:i') }}</span>
                </div>
            </div>

            <!-- HASIL PENCATATAN -->
            <div class="card">
                <h3>Hasil Pencatatan Staff</h3>
                @if ($pencatatan)
                    <div class="info-row">
                        <span class="info-label">Nama Lengkap</span>
                        <span class="info-value">{{ $pencatatan->nama_lengkap }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">NIP</span>
                        <span class="info-value">{{ $pencatatan->nip }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status Dokumen</span>
                        <span class="info-value">
                            <span class="{{ $pencatatan->status_dokumen === 'valid' ? 'badge-valid' : 'badge-invalid' }}">
                                {{ $pencatatan->status_dokumen === 'valid' ? '✓ Valid' : '✕ Tidak Valid' }}
                            </span>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Catatan</span>
                        <span class="info-value">{{ $pencatatan->catatan ?: '—' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Dicatat Oleh</span>
                        <span class="info-value">{{ $pencatatan->staff?->name ?? 'Staff' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Waktu Pencatatan</span>
                        <span class="info-value">{{ $pencatatan->updated_at->translatedFormat('d M Y, H:i') }}</span>
                    </div>
                @else
                    <p class="text-sm text-gray-500">Pengajuan ini belum dicatat oleh staff.</p>
                @endif

                <a href="{{ route('staff.pencatatan.create', $pengajuan->id) }}" class="btn-edit">
                    {{ $pencatatan ? 'Edit Pencatatan' : 'Lakukan Pencatatan' }}
                </a>
            </div>

            <!-- DOKUMEN PENDUKUNG -->
            <div class="card">
                <h3>Dokumen Pemohon</h3>

                <div class="doc-item">
                    <div class="doc-name">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        Slip Gaji
                    </div>
                    @if ($pengajuan->file_slip_gaji)
                        <a href="{{ route('dokumen.view', [$pengajuan->id, 'slip_gaji']) }}" target="_blank" class="btn-view-doc">Buka Dokumen</a>
                    @else
                        <span class="text-xs text-gray-400">Tidak ada</span>
                    @endif
                </div>

                <div class="doc-item">
                    <div class="doc-name">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        Surat Keputusan (SK)
                    </div>
                    @if ($pengajuan->file_sk)
                        <a href="{{ route('dokumen.view', [$pengajuan->id, 'sk']) }}" target="_blank" class="btn-view-doc">Buka Dokumen</a>
                    @else
                        <span class="text-xs text-gray-400">Tidak ada</span>
                    @endif
                </div>

                <div class="doc-item">
                    <div class="doc-name">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        Dokumen SKPP / Pengantar
                    </div>
                    @if ($pengajuan->file_skpp)
                        <a href="{{ route('dokumen.view', [$pengajuan->id, 'skpp']) }}" target="_blank" class="btn-view-doc">Buka Dokumen</a>
                    @else
                        <span class="text-xs text-gray-400">Tidak ada</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="navbar">
            <a href="{{ route('staff.dashboard') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </a>
            <a href="{{ route('staff.pencatatan.index') }}" class="nav-plus">
                <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </a>
            <a href="{{ route('profile.edit') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            </a>
        </div>
    </div>
</body>

</html>
