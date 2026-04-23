<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Detail Pengecekan</title>
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

        /* TOP BAR */
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
            font-size: 26px;
            text-decoration: none;
        }

        .top-bar h2 {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            flex: 1;
            text-align: center;
        }

        .top-bar .more {
            color: #fff;
            font-size: 22px;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 0 16px 100px;
            margin-top: -24px;
        }

        .form-card {
            background: #fff;
            border-radius: 24px;
            margin: 16px 16px 90px;
            padding: 24px 20px 28px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        /* CARD */
        .card {
            background: #fff;
            border-radius: 24px;
            padding: 22px 18px;
            margin-bottom: 14px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .card-title {
            text-align: center;
            margin-bottom: 18px;
        }

        .card-title h3 {
            color: #1a8fb3;
            font-size: 17px;
            font-weight: 700;
        }

        .card-title p {
            color: #1a8fb3;
            font-size: 13px;
            margin-top: 2px;
        }

        /* INFO TABLE */
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 7px 6px;
            font-size: 13px;
            color: #444;
            vertical-align: top;
        }

        .info-table td:first-child {
            color: #666;
            width: 45%;
        }

        .info-table td:nth-child(2) {
            color: #666;
            width: 5%;
        }

        .info-table td:last-child {
            font-weight: 500;
            color: #222;
        }

        .info-row-wrap {
            background: #f5fafc;
            border-radius: 12px;
            padding: 4px 6px;
        }

        /* SECTION TITLE */
        .section-title {
            color: #1a8fb3;
            font-size: 15px;
            font-weight: 700;
            margin: 18px 0 12px;
        }

        /* DOKUMEN ROW */
        .doc-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            border-radius: 16px;
            padding: 14px 14px;
            margin-bottom: 10px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.06);
        }

        .doc-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .doc-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .doc-icon svg {
            width: 20px;
            height: 20px;
            stroke: #fff;
            fill: none;
            stroke-width: 2;
        }

        .doc-icon.blue {
            background: #4e63e8;
        }

        .doc-icon.pink {
            background: #e84e8a;
        }

        .doc-icon.orange {
            background: #f5a623;
        }

        .doc-name {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        /* RADIO INLINE */
        .radio-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .radio-opt {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 13px;
            cursor: pointer;
        }

        .radio-opt input[type=radio] {
            width: 16px;
            height: 16px;
            accent-color: #1a8fb3;
            cursor: pointer;
        }

        .radio-opt .lbl-lengkap {
            color: #2ecc71;
            font-weight: 600;
        }

        .radio-opt .lbl-tidak {
            color: #e74c3c;
            font-weight: 600;
        }

        /* CATATAN */
        .field-label {
            color: #1a8fb3;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .field-input {
            width: 100%;
            background: #eaf6fb;
            border: none;
            border-radius: 14px;
            padding: 12px 16px;
            font-size: 14px;
            color: #333;
            outline: none;
            font-family: inherit;
            resize: none;
            height: 90px;
        }

        .field-input:focus {
            box-shadow: 0 0 0 2px #2ec6e8;
        }

        /* BUTTONS */
        .btn-row {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .btn-tolak {
            flex: 1;
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 15px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.2s;
        }

        .btn-tolak:hover {
            background: #c0392b;
        }

        .btn-setuju {
            flex: 1;
            background: #2ecc71;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 15px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.2s;
        }

        .btn-setuju:hover {
            background: #27ae60;
        }

        .btn-kembali {
            width: 100%;
            background: #fff;
            color: #1a8fb3;
            border: 1.5px solid #1a8fb3;
            border-radius: 50px;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            margin-top: 10px;
            text-align: center;
            text-decoration: none;
            display: block;
        }

        .btn-kembali:hover {
            background: #eaf6fb;
        }

        .alert-error {
            background: #ffeaea;
            color: #c0392b;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 12px;
        }

        /* Status badge sudah dicek */
        .status-banner {
            border-radius: 14px;
            padding: 12px 16px;
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .status-banner.disetujui {
            background: #d4edda;
            color: #155724;
        }

        .status-banner.ditolak {
            background: #fdecea;
            color: #c0392b;
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
            <a href="{{ route('kepala.pengecekan.index') }}">&#8249;</a>
            <h2>Pengecekan</h2>
            <span class="more">&#8942;</span>
        </div>

        <div class="form-card">

            @if ($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            @if ($pengajuan->status_pengecekan === 'disetujui')
                <div class="status-banner disetujui">✓ Pengajuan ini sudah Disetujui</div>
            @elseif($pengajuan->status_pengecekan === 'ditolak')
                <div class="status-banner ditolak">✕ Pengajuan ini Ditolak</div>
            @endif

            <!-- DETAIL CARD -->
            <div class="card">
                <div class="card-title">
                    <h3>Detail Pengajuan</h3>
                    <p>SKPP {{ str_pad($pengajuan->id, 3, '0', STR_PAD_LEFT) }}</p>
                </div>

                <div class="info-row-wrap">
                    <table class="info-table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $pengajuan->pencatatan->nama_lengkap ?? ($pengajuan->user->name ?? '-') }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>:</td>
                            <td>{{ $pengajuan->pencatatan->nip ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pengajuan</td>
                            <td>:</td>
                            <td>{{ $pengajuan->created_at->translatedFormat('j F Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- FORM VERIFIKASI -->
            <form method="POST" action="{{ route('kepala.pengecekan.store', $pengajuan->id) }}">
                @csrf

                <div class="section-title">Verifikasi Dokumen</div>

                <!-- Slip Gaji -->
                <div class="doc-row">
                    <div class="doc-left">
                        <div class="doc-icon blue">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                            </svg>
                        </div>
                        <span class="doc-name">Slip gaji</span>
                    </div>
                    <div class="radio-group">
                        <label class="radio-opt">
                            <input type="radio" name="slip_gaji" value="lengkap"
                                {{ old('slip_gaji', $pengecekan->slip_gaji ?? '') === 'lengkap' ? 'checked' : '' }}>
                            <span class="lbl-lengkap">Lengkap</span>
                        </label>
                        <label class="radio-opt">
                            <input type="radio" name="slip_gaji" value="tidak"
                                {{ old('slip_gaji', $pengecekan->slip_gaji ?? '') === 'tidak' ? 'checked' : '' }}>
                            <span class="lbl-tidak">Tidak</span>
                        </label>
                    </div>
                </div>

                <!-- SK -->
                <div class="doc-row">
                    <div class="doc-left">
                        <div class="doc-icon pink">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                            </svg>
                        </div>
                        <span class="doc-name">SK</span>
                    </div>
                    <div class="radio-group">
                        <label class="radio-opt">
                            <input type="radio" name="sk" value="lengkap"
                                {{ old('sk', $pengecekan->sk ?? '') === 'lengkap' ? 'checked' : '' }}>
                            <span class="lbl-lengkap">Lengkap</span>
                        </label>
                        <label class="radio-opt">
                            <input type="radio" name="sk" value="tidak"
                                {{ old('sk', $pengecekan->sk ?? '') === 'tidak' ? 'checked' : '' }}>
                            <span class="lbl-tidak">Tidak</span>
                        </label>
                    </div>
                </div>

                <!-- Surat Pengantar -->
                <div class="doc-row">
                    <div class="doc-left">
                        <div class="doc-icon orange">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                            </svg>
                        </div>
                        <span class="doc-name">Surat Pengantar</span>
                    </div>
                    <div class="radio-group">
                        <label class="radio-opt">
                            <input type="radio" name="surat_pengantar" value="lengkap"
                                {{ old('surat_pengantar', $pengecekan->surat_pengantar ?? '') === 'lengkap' ? 'checked' : '' }}>
                            <span class="lbl-lengkap">Lengkap</span>
                        </label>
                        <label class="radio-opt">
                            <input type="radio" name="surat_pengantar" value="tidak"
                                {{ old('surat_pengantar', $pengecekan->surat_pengantar ?? '') === 'tidak' ? 'checked' : '' }}>
                            <span class="lbl-tidak">Tidak</span>
                        </label>
                    </div>
                </div>

                <!-- Catatan -->
                <div style="margin-top: 8px;">
                    <div class="field-label">Catatan (opsional)</div>
                    <textarea name="catatan_pengecekan" class="field-input" placeholder="Tambahkan catatan jika ada...">{{ old('catatan_pengecekan', $pengecekan->catatan_pengecekan ?? '') }}</textarea>
                </div>

                <!-- Input hidden keputusan -->
                <input type="hidden" name="keputusan" id="keputusan" value="">

                <div class="btn-row">
                    <button type="button" class="btn-tolak" onclick="submitKeputusan('tolak')">Tolak</button>
                    <button type="button" class="btn-setuju" onclick="submitKeputusan('setuju')">Setuju</button>
                </div>

            </form>

            {{-- <a href="{{ route('kepala.pengecekan.index') }}" class="btn-kembali">Kembali</a> --}}

        </div>

        {{-- NAVBAR --}}
        <div class="navbar">
            <a href="{{ route('kepala.dashboard') }}" class="nav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
            </a>
            <a href="#" class="nav-plus">
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

    <script>
        function submitKeputusan(val) {
            document.getElementById('keputusan').value = val;
            document.querySelector('form').submit();
        }
    </script>
</body>

</html>
