<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Form Pengajuan - SKPP</title>
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

        .form-card {
            background: #fff;
            border-radius: 24px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .form-card h3 {
            font-size: 16px;
            font-weight: 700;
            color: #1a8fb3;
            margin-bottom: 14px;
        }

        .field-group {
            margin-bottom: 14px;
        }

        .field-group:last-child {
            margin-bottom: 0;
        }

        .field-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }

        .field-label span.req {
            color: #e74c3c;
        }

        .field-input {
            width: 100%;
            background: #eaf6fb;
            border: 1px solid transparent;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 14px;
            color: #333;
            outline: none;
            font-family: inherit;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field-input:focus {
            border-color: #2ec6e8;
            box-shadow: 0 0 0 2px rgba(46, 198, 232, 0.2);
        }

        .field-input.error {
            border-color: #e74c3c;
            background: #fdf2f2;
        }

        textarea.field-input {
            resize: none;
            min-height: 80px;
        }

        .error-msg {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        /* UPLOAD BOX */
        .upload-box {
            border: 2px dashed #b0d9ea;
            border-radius: 16px;
            padding: 16px;
            text-align: center;
            background: #f8fcfe;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .upload-box:hover {
            border-color: #1a8fb3;
            background: #eaf6fb;
        }

        .upload-box input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .upload-icon svg {
            width: 32px;
            height: 32px;
            stroke: #1a8fb3;
            fill: none;
            stroke-width: 1.8;
            margin: 0 auto 6px;
        }

        .upload-title {
            font-size: 13px;
            font-weight: 600;
            color: #1a8fb3;
        }

        .upload-hint {
            font-size: 11px;
            color: #888;
            margin-top: 2px;
        }

        .upload-file-name {
            display: none;
            font-size: 12px;
            font-weight: 700;
            color: #2ecc71;
            margin-top: 6px;
            word-break: break-all;
        }

        /* BUTTON SUBMIT */
        .btn-submit {
            width: 100%;
            background: #1a8fb3;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 15px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 4px 14px rgba(26, 143, 179, 0.4);
            transition: background 0.2s, transform 0.1s;
        }

        .btn-submit:hover {
            background: #157a9a;
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        .btn-batal {
            width: 100%;
            background: #fff;
            color: #666;
            border: 1px solid #ccc;
            border-radius: 50px;
            padding: 13px;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            display: block;
            margin-top: 10px;
        }

        .btn-batal:hover {
            background: #f5f5f5;
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
            <h2>Pengajuan Baru</h2>
            <span style="width:40px"></span>
        </div>

        <div class="content">
            @if ($errors->any())
                <div class="alert-error">
                    <strong>Mohon periksa form:</strong>
                    <ul class="list-disc list-inside mt-1 text-xs">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('mitra.pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- DATA DIRI / PEMOHON -->
                <div class="form-card">
                    <h3>Data Pengajuan</h3>

                    <div class="field-group">
                        <label class="field-label">Nama Pegawai / Instansi <span class="req">*</span></label>
                        <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}"
                            placeholder="Masukkan nama pegawai atau instansi"
                            class="field-input {{ $errors->has('nama_perusahaan') ? 'error' : '' }}" required>
                        @error('nama_perusahaan')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Alamat <span class="req">*</span></label>
                        <input type="text" name="alamat" value="{{ old('alamat') }}"
                            placeholder="Masukkan alamat lengkap"
                            class="field-input {{ $errors->has('alamat') ? 'error' : '' }}" required>
                        @error('alamat')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">NPWP <span class="text-xs text-gray-400 font-normal">(opsional)</span></label>
                        <input type="text" name="npwp" value="{{ old('npwp') }}"
                            placeholder="Contoh: 01.234.567.8-999.000"
                            class="field-input {{ $errors->has('npwp') ? 'error' : '' }}">
                        @error('npwp')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Keperluan Pengajuan <span class="req">*</span></label>
                        <textarea name="keperluan" rows="3" placeholder="Jelaskan tujuan dan keperluan permohonan SKPP"
                            class="field-input {{ $errors->has('keperluan') ? 'error' : '' }}" required>{{ old('keperluan') }}</textarea>
                        @error('keperluan')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- DOKUMEN PENDUKUNG -->
                <div class="form-card">
                    <h3>Dokumen Pendukung</h3>
                    <p class="text-xs text-gray-500 mb-4">Format file harus PDF, ukuran maksimum 2MB per dokumen.</p>

                    <!-- Slip Gaji -->
                    <div class="field-group">
                        <label class="field-label">Slip Gaji Terakhir <span class="req">*</span></label>
                        <div class="upload-box" onclick="this.querySelector('input').click()">
                            <input type="file" name="file_slip_gaji" accept=".pdf" required onchange="handleFileSelect(this, 'name-slip')">
                            <div class="upload-icon">
                                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </div>
                            <div class="upload-title">Pilih File Slip Gaji (PDF)</div>
                            <div class="upload-hint">Maksimal 2 MB</div>
                            <div class="upload-file-name" id="name-slip"></div>
                        </div>
                        @error('file_slip_gaji')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- SK -->
                    <div class="field-group">
                        <label class="field-label">Surat Keputusan (SK) <span class="req">*</span></label>
                        <div class="upload-box" onclick="this.querySelector('input').click()">
                            <input type="file" name="file_sk" accept=".pdf" required onchange="handleFileSelect(this, 'name-sk')">
                            <div class="upload-icon">
                                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </div>
                            <div class="upload-title">Pilih File SK (PDF)</div>
                            <div class="upload-hint">Maksimal 2 MB</div>
                            <div class="upload-file-name" id="name-sk"></div>
                        </div>
                        @error('file_sk')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Dokumen SKPP / Surat Pengantar -->
                    <div class="field-group">
                        <label class="field-label">Surat Pengantar / Dokumen Pendukung <span class="req">*</span></label>
                        <div class="upload-box" onclick="this.querySelector('input').click()">
                            <input type="file" name="file_skpp" accept=".pdf" required onchange="handleFileSelect(this, 'name-skpp')">
                            <div class="upload-icon">
                                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </div>
                            <div class="upload-title">Pilih File Pendukung (PDF)</div>
                            <div class="upload-hint">Maksimal 2 MB</div>
                            <div class="upload-file-name" id="name-skpp"></div>
                        </div>
                        @error('file_skpp')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn-submit">Kirim Pengajuan</button>
                <a href="{{ route('mitra.pengajuan.index') }}" class="btn-batal">Batal</a>
            </form>
        </div>

        {{-- NAVBAR --}}
        <div class="navbar">
            <a href="{{ route('mitra.dashboard') }}" class="nav-item">
                <svg viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
            </a>
            <a href="{{ route('mitra.pengajuan.create') }}" class="nav-plus active" title="Buat Pengajuan">
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
        function handleFileSelect(input, targetId) {
            const file = input.files[0];
            const nameEl = document.getElementById(targetId);
            if (!file) {
                nameEl.style.display = 'none';
                return;
            }

            if (file.size > 2048 * 1024) {
                alert('Ukuran file tidak boleh melebihi 2MB.');
                input.value = '';
                nameEl.style.display = 'none';
                return;
            }

            if (file.type !== 'application/pdf') {
                alert('File harus dalam format PDF.');
                input.value = '';
                nameEl.style.display = 'none';
                return;
            }

            nameEl.textContent = '✓ ' + file.name;
            nameEl.style.display = 'block';
        }
    </script>
</body>

</html>
