<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Detail Pengajuan - SKPP</title>
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

        .alert-error {
            background: #ffeaea;
            color: #c0392b;
            border-radius: 14px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .card {
            background: #fff;
            border-radius: 24px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .card-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }

        .card-id {
            font-size: 16px;
            font-weight: 700;
            color: #1a8fb3;
        }

        .badge {
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50px;
            text-transform: capitalize;
        }

        .badge-menunggu {
            background: #fff3cd;
            color: #856404;
        }

        .badge-diproses {
            background: #cce5ff;
            color: #004085;
        }

        .badge-disetujui {
            background: #d4edda;
            color: #155724;
        }

        .badge-ditolak {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-selesai {
            background: #2ecc71;
            color: #fff;
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

        /* TIMELINE */
        .timeline {
            position: relative;
            padding-left: 24px;
            margin-top: 10px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 7px;
            top: 6px;
            bottom: 6px;
            width: 2px;
            background: #e0e0e0;
        }

        .timeline-step {
            position: relative;
            margin-bottom: 18px;
        }

        .timeline-step:last-child {
            margin-bottom: 0;
        }

        .timeline-dot {
            position: absolute;
            left: -24px;
            top: 3px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #ccc;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px #eee;
        }

        .timeline-step.completed .timeline-dot {
            background: #2ecc71;
            box-shadow: 0 0 0 2px rgba(46, 204, 113, 0.3);
        }

        .timeline-step.active .timeline-dot {
            background: #1a8fb3;
            box-shadow: 0 0 0 2px rgba(26, 143, 179, 0.3);
        }

        .timeline-step.rejected .timeline-dot {
            background: #e74c3c;
            box-shadow: 0 0 0 2px rgba(231, 76, 60, 0.3);
        }

        .timeline-title {
            font-size: 13px;
            font-weight: 700;
            color: #333;
        }

        .timeline-desc {
            font-size: 11px;
            color: #888;
            margin-top: 2px;
        }

        /* DOC ITEMS */
        .doc-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            background: #f8fcfe;
            border-radius: 12px;
            margin-bottom: 8px;
        }

        .doc-item:last-child {
            margin-bottom: 0;
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

        /* ACTION BUTTONS */
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 14px;
        }

        .btn-edit {
            flex: 1;
            background: #1a8fb3;
            color: #fff;
            border-radius: 50px;
            padding: 12px;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
        }

        .btn-delete {
            flex: 1;
            background: #fff;
            color: #e74c3c;
            border: 1px solid #e74c3c;
            border-radius: 50px;
            padding: 12px;
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-download-skpp {
            display: block;
            width: 100%;
            background: #2ecc71;
            color: #fff;
            border-radius: 50px;
            padding: 14px;
            text-align: center;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 12px;
            box-shadow: 0 4px 14px rgba(46, 204, 113, 0.35);
        }

        /* MODAL */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 200;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-box {
            background: #fff;
            border-radius: 24px;
            padding: 26px 20px;
            width: 320px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .modal-btns {
            display: flex;
            gap: 10px;
            margin-top: 18px;
        }

        .modal-btn-batal {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 50px;
            background: #fff;
            cursor: pointer;
            font-weight: 600;
        }

        .modal-btn-hapus {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 50px;
            background: #e74c3c;
            color: #fff;
            cursor: pointer;
            font-weight: 700;
        }

        /* NAVBAR */
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
            transition: background 0.2s;
            text-decoration: none;
        }

        .nav-item:hover {
            background: #f0f9fc;
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
            transition: background 0.2s, transform 0.15s;
            text-decoration: none;
        }

        .nav-plus:hover {
            background: #157a9a;
            transform: scale(1.08);
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
            <a href="{{ route('mitra.pengajuan.index') }}">&#8249;</a>
            <h2>Detail Pengajuan</h2>
            <span style="width:40px"></span>
        </div>

        <div class="content">
            @if (session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            @php
                $isSelesai = $pengajuan->status_arsip === 'diarsipkan' && $pengajuan->arsip?->dikirim_ke_mitra;
                $statusLabel = $isSelesai ? 'Selesai' : ucfirst($pengajuan->status);
                $statusBadge = $isSelesai ? 'badge-selesai' : 'badge-' . $pengajuan->status;
            @endphp

            @if ($isSelesai && $pengajuan->draftSkpp)
                <a href="{{ route('mitra.pengunduhan.download', $pengajuan->id) }}" class="btn-download-skpp">
                    ⬇ Unduh Dokumen SKPP Resmi
                </a>
            @endif

            <!-- RINGKASAN DATA -->
            <div class="card">
                <div class="card-header-row">
                    <span class="card-id">SKPP #{{ str_pad($pengajuan->id, 3, '0', STR_PAD_LEFT) }}</span>
                    <span class="badge {{ $statusBadge }}">{{ $statusLabel }}</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Nama Pegawai</span>
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
                    <span class="info-label">Diajukan Pada</span>
                    <span class="info-value">{{ $pengajuan->created_at->translatedFormat('d M Y, H:i') }}</span>
                </div>
            </div>

            <!-- PROGRES / TIMELINE -->
            <div class="card">
                <h3 style="font-size: 15px; font-weight: 700; color: #1a8fb3; margin-bottom: 12px;">Alur Proses Pengajuan</h3>
                <div class="timeline">
                    <!-- Tahap 1: Pengajuan -->
                    <div class="timeline-step completed">
                        <div class="timeline-dot"></div>
                        <div class="timeline-title">Pengajuan Diterima</div>
                        <div class="timeline-desc">Permohonan berhasil disimpan pada {{ $pengajuan->created_at->format('d M Y') }}.</div>
                    </div>

                    <!-- Tahap 2: Pencatatan Staff -->
                    @php
                        $step2Done = $pengajuan->status_pencatatan === 'selesai_dicatat';
                        $step2Class = $step2Done ? 'completed' : 'active';
                    @endphp
                    <div class="timeline-step {{ $step2Class }}">
                        <div class="timeline-dot"></div>
                        <div class="timeline-title">Pencatatan & Verifikasi Staff</div>
                        <div class="timeline-desc">
                            @if ($step2Done)
                                Selesai dicatat. NIP: {{ $pengajuan->pencatatan?->nip ?? '-' }}. Dokumen: {{ ucfirst($pengajuan->pencatatan?->status_dokumen ?? 'valid') }}.
                            @else
                                Menunggu verifikasi dokumen oleh staf administrasi.
                            @endif
                        </div>
                    </div>

                    <!-- Tahap 3: Review Kepala -->
                    @php
                        $isRejected = $pengajuan->status_pengecekan === 'ditolak';
                        $isApproved = $pengajuan->status_pengecekan === 'disetujui';
                        $step3Class = $isRejected ? 'rejected' : ($isApproved ? 'completed' : ($step2Done ? 'active' : ''));
                    @endphp
                    <div class="timeline-step {{ $step3Class }}">
                        <div class="timeline-dot"></div>
                        <div class="timeline-title">Persetujuan Kepala</div>
                        <div class="timeline-desc">
                            @if ($isApproved)
                                Pengajuan telah disetujui oleh Kepala.
                            @elseif($isRejected)
                                Pengajuan ditolak: {{ $pengajuan->pengecekan?->catatan_pengecekan ?: 'Dokumen tidak memenuhi persyaratan.' }}
                            @else
                                Menunggu peninjauan dan persetujuan dari Kepala.
                            @endif
                        </div>
                    </div>

                    <!-- Tahap 4: Upload Draft SKPP -->
                    @php
                        $step4Done = $pengajuan->status_draft === 'sudah_diupload';
                        $step4Class = $step4Done ? 'completed' : ($isApproved ? 'active' : '');
                    @endphp
                    <div class="timeline-step {{ $step4Class }}">
                        <div class="timeline-dot"></div>
                        <div class="timeline-title">Penyusunan SKPP Resmi</div>
                        <div class="timeline-desc">
                            @if ($step4Done)
                                Draft SKPP resmi telah diunggah.
                            @else
                                Proses penerbitan dokumen SKPP.
                            @endif
                        </div>
                    </div>

                    <!-- Tahap 5: Pengarsipan & Pengiriman -->
                    @php
                        $step5Done = $isSelesai;
                        $step5Class = $step5Done ? 'completed' : ($step4Done ? 'active' : '');
                    @endphp
                    <div class="timeline-step {{ $step5Class }}">
                        <div class="timeline-dot"></div>
                        <div class="timeline-title">Pengarsipan & Siap Diunduh</div>
                        <div class="timeline-desc">
                            @if ($step5Done)
                                SKPP telah diarsipkan dan dapat diunduh pada menu Pengunduhan.
                            @else
                                Menunggu pengarsipan final dan pengiriman oleh staff.
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- DOKUMEN PENDUKUNG -->
            <div class="card">
                <h3 style="font-size: 15px; font-weight: 700; color: #1a8fb3; margin-bottom: 12px;">Dokumen Pengajuan</h3>

                <div class="doc-item">
                    <div class="doc-name">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        Slip Gaji
                    </div>
                    @if ($pengajuan->file_slip_gaji)
                        <a href="{{ route('dokumen.view', [$pengajuan->id, 'slip_gaji']) }}" target="_blank" class="btn-view-doc">Lihat File</a>
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
                        <a href="{{ route('dokumen.view', [$pengajuan->id, 'sk']) }}" target="_blank" class="btn-view-doc">Lihat File</a>
                    @else
                        <span class="text-xs text-gray-400">Tidak ada</span>
                    @endif
                </div>

                <div class="doc-item">
                    <div class="doc-name">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        Dokumen Pendukung / Pengantar
                    </div>
                    @if ($pengajuan->file_skpp)
                        <a href="{{ route('dokumen.view', [$pengajuan->id, 'skpp']) }}" target="_blank" class="btn-view-doc">Lihat File</a>
                    @else
                        <span class="text-xs text-gray-400">Tidak ada</span>
                    @endif
                </div>
            </div>

            <!-- TOMBOL AKSI JIKA MASIH MENUNGGU -->
            @if ($pengajuan->status === 'menunggu' && $pengajuan->status_pencatatan === 'belum_dicatat')
                <div class="btn-group">
                    <a href="{{ route('mitra.pengajuan.edit', $pengajuan->id) }}" class="btn-edit">Edit Pengajuan</a>
                    <button type="button" class="btn-delete" onclick="document.getElementById('modal-batal').classList.add('active')">
                        Batalkan
                    </button>
                </div>
            @endif
        </div>

        <!-- MODAL KONFIRMASI BATAL -->
        <div class="modal-overlay" id="modal-batal">
            <div class="modal-box">
                <h4 style="font-size: 16px; font-weight: 700; color: #333; margin-bottom: 8px;">Batalkan Pengajuan?</h4>
                <p style="font-size: 13px; color: #666;">Data dan dokumen pengajuan ini akan dihapus secara permanen.</p>
                <div class="modal-btns">
                    <button class="modal-btn-batal" onclick="document.getElementById('modal-batal').classList.remove('active')">Kembali</button>
                    <form action="{{ route('mitra.pengajuan.destroy', $pengajuan->id) }}" method="POST" style="flex: 1;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="modal-btn-hapus" style="width: 100%;">Ya, Batalkan</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- NAVBAR --}}
        <div class="navbar">
            <a href="{{ route('mitra.dashboard') }}" class="nav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
            </a>
            <a href="{{ route('mitra.pengajuan.create') }}" class="nav-plus" title="Buat Pengajuan">
                <svg viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
            </a>
            <a href="{{ route('profile.edit') }}" class="nav-item">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                </svg>
            </a>
        </div>
    </div>
</body>

</html>
