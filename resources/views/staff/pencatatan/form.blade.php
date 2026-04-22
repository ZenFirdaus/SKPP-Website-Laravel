<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Form Pencatatan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
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
            color: #fff; font-size: 28px; text-decoration: none;
            line-height: 1; padding: 4px 8px; border-radius: 10px;
            transition: background 0.2s;
        }
        .top-bar a:hover { background: rgba(255,255,255,0.2); }
        .top-bar h2 { color: #fff; font-size: 20px; font-weight: 700; flex: 1; text-align: center; }
        .top-bar .more {
            color: #fff; font-size: 22px; padding: 4px 8px;
            border-radius: 10px; cursor: pointer; transition: background 0.2s;
        }
        .top-bar .more:hover { background: rgba(255,255,255,0.2); }

        /* FORM CARD */
        .form-card {
            background: #fff;
            border-radius: 24px;
            margin: 16px 16px 90px;
            padding: 24px 20px 28px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .form-title { text-align: center; margin-bottom: 20px; }
        .form-title h3 { color: #1a8fb3; font-size: 17px; font-weight: 700; }
        .form-title p { color: #1a8fb3; font-size: 13px; margin-top: 2px; }

        /* INFO BOX */
        .info-box {
            background: #f0fafd; border-radius: 14px;
            padding: 12px 14px; margin-bottom: 20px;
            display: flex; align-items: center; gap: 12px;
        }
        .info-avatar {
            width: 46px; height: 46px; border-radius: 12px;
            background: #1a8fb3; display: flex;
            align-items: center; justify-content: center;
            color: #fff; font-size: 18px; font-weight: 700; flex-shrink: 0;
        }
        .info-text .name { font-size: 14px; font-weight: 700; color: #333; }
        .info-text .sub { font-size: 12px; color: #888; margin-top: 2px; }

        /* FIELDS */
        .field-label {
            color: #1a8fb3; font-size: 13px; font-weight: 600;
            margin-bottom: 7px; margin-top: 16px;
        }
        .field-input {
            width: 100%; background: #eaf6fb; border: none;
            border-radius: 50px; padding: 13px 18px;
            font-size: 14px; color: #333; outline: none; font-family: inherit;
            transition: box-shadow 0.2s;
        }
        .field-input:focus { box-shadow: 0 0 0 2px #2ec6e8; }
        .field-input.is-invalid { box-shadow: 0 0 0 2px #e74c3c; }
        .invalid-feedback { color: #e74c3c; font-size: 12px; margin-top: 4px; padding-left: 14px; }

        textarea.field-input {
            border-radius: 16px; resize: none; height: 100px; padding: 13px 18px;
        }

        /* STATUS DOKUMEN */
        .status-row { display: flex; gap: 12px; margin-top: 4px; }
        .status-btn {
            flex: 1; padding: 13px; border-radius: 50px;
            border: 2px solid #ccc; font-size: 14px; font-weight: 700;
            cursor: pointer; font-family: inherit;
            background: #f0f0f0; color: #999;
            transition: all 0.2s; outline: none;
        }
        .status-btn:hover { border-color: #aaa; background: #e8e8e8; color: #666; }
        .status-btn.valid-active {
            background: #2ecc71; color: #fff;
            border-color: #2ecc71; box-shadow: 0 3px 12px rgba(46,204,113,0.35);
        }
        .status-btn.invalid-active {
            background: #ff7675; color: #fff;
            border-color: #ff7675; box-shadow: 0 3px 12px rgba(255,118,117,0.35);
        }
        #status_dokumen { display: none; }

        /* ACTIONS */
        .action-row { display: flex; gap: 12px; margin-top: 24px; }
        .btn-batal {
            flex: 1; background: #fff; color: #1a8fb3;
            border: 1.5px solid #1a8fb3; border-radius: 50px; padding: 14px;
            font-size: 15px; font-weight: 600; cursor: pointer; font-family: inherit;
            text-align: center; text-decoration: none;
            display: flex; align-items: center; justify-content: center;
            transition: background 0.2s, transform 0.1s;
        }
        .btn-batal:hover { background: #eaf6fb; }
        .btn-batal:active { transform: scale(0.97); }
        .btn-simpan {
            flex: 1; background: #1a8fb3; color: #fff;
            border: none; border-radius: 50px; padding: 14px;
            font-size: 15px; font-weight: 700; cursor: pointer; font-family: inherit;
            transition: background 0.2s, transform 0.1s;
        }
        .btn-simpan:hover { background: #157a9a; }
        .btn-simpan:active { transform: scale(0.97); }

        .alert-error {
            background: #ffeaea; color: #c0392b;
            border-radius: 10px; padding: 10px 14px;
            font-size: 13px; margin-bottom: 14px;
        }

        /* NAVBAR */
        .navbar {
            position: fixed; bottom: 0;
            left: 50%; transform: translateX(-50%);
            width: 100%; max-width: 430px;
            background: #fff; border-top: 1px solid #e8e8e8;
            display: flex; justify-content: space-around;
            align-items: center; padding: 12px 0 20px; z-index: 100;
        }
        .nav-item {
            display: flex; flex-direction: column; align-items: center;
            cursor: pointer; padding: 6px 14px; border-radius: 14px;
            transition: background 0.2s; text-decoration: none;
        }
        .nav-item:hover { background: #f0f9fc; }
        .nav-item svg { width: 26px; height: 26px; stroke: #aaa; fill: none; stroke-width: 1.8; }
        .nav-item.active svg { stroke: #1a8fb3; }
        .nav-plus {
            width: 50px; height: 50px; background: #1a8fb3;
            border-radius: 50%; display: flex;
            align-items: center; justify-content: center;
            margin-top: -20px; box-shadow: 0 4px 14px rgba(26,143,179,0.4);
            cursor: pointer; transition: background 0.2s, transform 0.15s;
            text-decoration: none;
        }
        .nav-plus:hover { background: #157a9a; transform: scale(1.08); }
        .nav-plus svg { stroke: #fff; width: 24px; height: 24px; fill: none; stroke-width: 2; }
    </style>
</head>
<body>
<div class="shell">

    <div class="top-bar">
        <a href="{{ route('staff.pencatatan.index') }}" title="Kembali">&#8249;</a>
        <h2>Pencatatan</h2>
        <span class="more">&#8942;</span>
    </div>

    <div class="form-card">
        <div class="form-title">
            <h3>Form Pencatatan</h3>
            <p>SKPP {{ str_pad($pengajuan->id, 3, '0', STR_PAD_LEFT) }}</p>
        </div>

        @if($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        <!-- Info Pemohon -->
        <div class="info-box">
            <div class="info-avatar">
                {{ strtoupper(substr($pengajuan->user->name ?? 'U', 0, 1)) }}
            </div>
            <div class="info-text">
                <div class="name">{{ $pengajuan->user->name ?? '-' }}</div>
                <div class="sub">Diajukan: {{ $pengajuan->created_at->format('d M Y') }}</div>
            </div>
        </div>

        <form method="POST" action="{{ route('staff.pencatatan.store', $pengajuan->id) }}">
            @csrf

            <div class="field-label">Nama Lengkap</div>
            <input type="text" name="nama_lengkap"
                class="field-input {{ $errors->has('nama_lengkap') ? 'is-invalid' : '' }}"
                placeholder="Masukkan Nama Lengkap"
                value="{{ old('nama_lengkap', $existingCatatan->nama_lengkap ?? '') }}"
                required />
            @error('nama_lengkap')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="field-label">NIP</div>
            <input type="text" name="nip"
                class="field-input {{ $errors->has('nip') ? 'is-invalid' : '' }}"
                placeholder="Masukkan NIP"
                value="{{ old('nip', $existingCatatan->nip ?? '') }}"
                required />
            @error('nip')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="field-label">Status Dokumen</div>
            <input type="hidden" name="status_dokumen" id="status_dokumen"
                value="{{ old('status_dokumen', $existingCatatan->status_dokumen ?? '') }}">
            <div class="status-row">
                <button type="button" class="status-btn" id="btn-valid" onclick="setStatus('valid')">
                    ✓ Valid
                </button>
                <button type="button" class="status-btn" id="btn-invalid" onclick="setStatus('tidak_valid')">
                    ✕ Tidak Valid
                </button>
            </div>

            <div class="field-label">Catatan</div>
            <textarea name="catatan" class="field-input"
                placeholder="Tambahkan catatan jika ada...">{{ old('catatan', $existingCatatan->catatan ?? '') }}</textarea>

            <div class="action-row">
                <a href="{{ route('staff.pencatatan.index') }}" class="btn-batal">Batal</a>
                <button type="submit" class="btn-simpan">Simpan</button>
            </div>
        </form>
    </div>

    <div class="navbar">
        <a href="{{ route('staff.dashboard') }}" class="nav-item active">
            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </a>
        <a href="#" class="nav-plus">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </a>
        <a href="{{ route('profile.edit') }}" class="nav-item">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
        </a>
    </div>

</div>

<script>
    function setStatus(val) {
        document.getElementById('status_dokumen').value = val;
        const btnValid   = document.getElementById('btn-valid');
        const btnInvalid = document.getElementById('btn-invalid');

        // Reset dulu
        btnValid.classList.remove('valid-active', 'invalid-active');
        btnInvalid.classList.remove('valid-active', 'invalid-active');

        if (val === 'valid') {
            btnValid.classList.add('valid-active');
        } else {
            btnInvalid.classList.add('invalid-active');
        }
    }

    // Set status awal jika sudah ada nilai sebelumnya
    const initialStatus = document.getElementById('status_dokumen').value;
    if (initialStatus) setStatus(initialStatus);
</script>
</body>
</html>