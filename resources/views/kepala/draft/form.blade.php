<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Upload SKPP</title>
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

        .top-bar a:hover {
            background: rgba(255, 255, 255, 0.2);
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
            padding: 4px 8px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .form-card {
            background: #fff;
            border-radius: 24px;
            margin: -24px 16px 90px;
            padding: 24px 20px 28px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-title h3 {
            color: #1a8fb3;
            font-size: 17px;
            font-weight: 700;
        }

        .form-title p {
            color: #888;
            font-size: 13px;
            margin-top: 4px;
        }

        /* INFO BOX */
        .info-box {
            background: #f0fafd;
            border-radius: 14px;
            padding: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .info-avatar {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #1a8fb3;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .info-text .name {
            font-size: 14px;
            font-weight: 700;
            color: #333;
        }

        .info-text .sub {
            font-size: 12px;
            color: #888;
            margin-top: 2px;
        }

        /* FILE UPLOAD AREA */
        .field-label {
            color: #1a8fb3;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            margin-top: 18px;
        }

        .upload-area {
            border: 2px dashed #b0d9ea;
            border-radius: 18px;
            padding: 28px 16px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            background: #f5fbfe;
            position: relative;
        }

        .upload-area:hover {
            border-color: #1a8fb3;
            background: #eaf6fb;
        }

        .upload-area.has-file {
            border-color: #2ecc71;
            background: #f0fff4;
        }

        .upload-area input[type=file] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .upload-icon svg {
            width: 40px;
            height: 40px;
            stroke: #1a8fb3;
            fill: none;
            stroke-width: 1.5;
            margin-bottom: 10px;
        }

        .upload-text {
            font-size: 14px;
            color: #1a8fb3;
            font-weight: 600;
        }

        .upload-sub {
            font-size: 12px;
            color: #aaa;
            margin-top: 4px;
        }

        .file-chosen {
            font-size: 13px;
            color: #27ae60;
            font-weight: 600;
            margin-top: 8px;
            display: none;
        }

        /* FILE EXISTING */
        .existing-file {
            background: #f0fafd;
            border-radius: 14px;
            padding: 12px 14px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .existing-icon {
            width: 36px;
            height: 36px;
            background: #e74c3c;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .existing-icon svg {
            width: 18px;
            height: 18px;
            stroke: #fff;
            fill: none;
            stroke-width: 2;
        }

        .existing-name {
            font-size: 13px;
            color: #333;
            font-weight: 500;
            flex: 1;
        }

        .existing-link {
            color: #1a8fb3;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
        }

        .existing-link:hover {
            text-decoration: underline;
        }

        .alert-error {
            background: #ffeaea;
            color: #c0392b;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 14px;
        }

        .action-row {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-batal {
            flex: 1;
            background: #fff;
            color: #1a8fb3;
            border: 1.5px solid #1a8fb3;
            border-radius: 50px;
            padding: 14px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            text-align: center;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .btn-batal:hover {
            background: #eaf6fb;
        }

        .btn-simpan {
            flex: 1;
            background: #1a8fb3;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 14px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.2s, transform 0.1s;
        }

        .btn-simpan:hover {
            background: #157a9a;
        }

        .btn-simpan:active {
            transform: scale(0.97);
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
            <a href="{{ route('kepala.draft.index') }}">&#8249;</a>
            <h2>Draft SKPP</h2>
            <span class="more">&#8942;</span>
        </div>

        <div class="form-card">
            <div class="form-title">
                <h3>Upload File SKPP</h3>
                <p>SKPP {{ str_pad($pengajuan->id, 3, '0', STR_PAD_LEFT) }}</p>
            </div>

            @if ($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <!-- Info Pemohon -->
            <div class="info-box">
                <div class="info-avatar">
                    {{ strtoupper(substr($pengajuan->pencatatan->nama_lengkap ?? ($pengajuan->user->name ?? 'U'), 0, 1)) }}
                </div>
                <div class="info-text">
                    <div class="name">{{ $pengajuan->pencatatan->nama_lengkap ?? ($pengajuan->user->name ?? '-') }}
                    </div>
                    <div class="sub">
                        NIP: {{ $pengajuan->pencatatan->nip ?? '—' }}
                        &bull; {{ $pengajuan->created_at->format('d M Y') }}
                    </div>
                </div>
            </div>

            <!-- File SKPP yang sudah ada -->
            @if ($draftSkpp)
                <div class="existing-file">
                    <div class="existing-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                        </svg>
                    </div>
                    <span class="existing-name">File SKPP sudah diupload</span>
                    <a href="{{ asset('storage/' . $draftSkpp->file_skpp) }}" target="_blank"
                        class="existing-link">Lihat</a>
                </div>
            @endif

            <form method="POST" action="{{ route('kepala.draft.store', $pengajuan->id) }}"
                enctype="multipart/form-data">
                @csrf

                <div class="field-label">{{ $draftSkpp ? 'Ganti File SKPP' : 'Upload File SKPP' }}</div>

                <label class="upload-area" id="upload-area">
                    <input type="file" name="file_skpp" id="file-input" accept=".pdf"
                        {{ !$draftSkpp ? 'required' : '' }} onchange="onFileChange(this)">
                    <div class="upload-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                            <polyline points="17 8 12 3 7 8" />
                            <line x1="12" y1="3" x2="12" y2="15" />
                        </svg>
                    </div>
                    <div class="upload-text">Pilih File PDF</div>
                    <div class="upload-sub">Format PDF, maksimal 5MB</div>
                    <div class="file-chosen" id="file-chosen">✓ File dipilih</div>
                </label>

                <div class="action-row">
                    <a href="{{ route('kepala.draft.index') }}" class="btn-batal">Batal</a>
                    <button type="submit" class="btn-simpan">Simpan</button>
                </div>
            </form>
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
        function onFileChange(input) {
            const area = document.getElementById('upload-area');
            const chosen = document.getElementById('file-chosen');
            const file = input.files[0];

            if (file) {
                area.classList.add('has-file');
                chosen.style.display = 'block';
                chosen.textContent = '✓ ' + file.name;
            } else {
                area.classList.remove('has-file');
                chosen.style.display = 'none';
            }
        }
    </script>
</body>

</html>
