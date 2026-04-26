<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Pengarsipan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #dff0f7; display: flex; justify-content: center; }
        .shell { width: 100%; max-width: 430px; min-height: 100vh; background: #dff0f7; display: flex; flex-direction: column; }
        .top-bar { background: linear-gradient(160deg, #2ec6e8 0%, #1a8fb3 100%); padding: 20px 20px 52px; display: flex; align-items: center; justify-content: space-between; border-radius: 0 0 32px 32px; }
        .top-bar a { color: #fff; font-size: 28px; text-decoration: none; padding: 4px 8px; border-radius: 10px; transition: background 0.2s; }
        .top-bar a:hover { background: rgba(255,255,255,0.2); }
        .top-bar h2 { color: #fff; font-size: 20px; font-weight: 700; flex: 1; text-align: center; }
        .top-bar .more { color: #fff; font-size: 22px; padding: 4px 8px; border-radius: 10px; cursor: pointer; transition: background 0.2s; }
        .top-bar .more:hover { background: rgba(255,255,255,0.2); }

        .content { flex: 1; padding: 16px 16px 100px; margin-top: -24px; }
        .alert-success { background: #d4edda; color: #155724; border-radius: 12px; padding: 12px 16px; font-size: 13px; margin-bottom: 16px; }

        /* SEARCH & FILTER */
        .search-wrap { margin-bottom: 16px; }
        .search-box { position: relative; margin-bottom: 10px; }
        .search-input { width: 100%; background: #fff; border: none; border-radius: 50px; padding: 12px 44px 12px 18px; font-size: 14px; color: #333; outline: none; box-shadow: 0 2px 8px rgba(0,0,0,0.08); font-family: inherit; transition: box-shadow 0.2s; }
        .search-input:focus { box-shadow: 0 0 0 2px #2ec6e8; }
        .search-icon { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; stroke: #aaa; fill: none; stroke-width: 2; pointer-events: none; }
        .filter-row { display: flex; gap: 8px; }
        .filter-btn { flex: 1; padding: 9px; border-radius: 50px; border: none; font-size: 12px; font-weight: 700; cursor: pointer; font-family: inherit; background: #fff; color: #888; box-shadow: 0 2px 6px rgba(0,0,0,0.07); transition: all 0.2s; }
        .filter-btn.active { background: #1a8fb3; color: #fff; }
        .filter-btn:hover:not(.active) { background: #eaf6fb; color: #1a8fb3; }
        .filter-clear { padding: 9px 14px; border-radius: 50px; background: #fdecea; color: #e74c3c; font-size: 12px; font-weight: 700; text-decoration: none; box-shadow: 0 2px 6px rgba(0,0,0,0.07); display: flex; align-items: center; white-space: nowrap; }
        .hasil-pencarian { font-size: 12px; color: #888; margin-bottom: 12px; padding-left: 4px; }

        /* CARDS */
        .outer-card { background: #fff; border-radius: 24px; padding: 14px; margin-bottom: 18px; box-shadow: 0 2px 12px rgba(0,0,0,0.07); }
        .inner-card { border-radius: 18px; padding: 16px; margin-bottom: 12px; }
        .inner-card.purple { background: linear-gradient(135deg, #6c63ff, #4e46c4); }
        .inner-card.orange { background: linear-gradient(135deg, #f5a623, #e08c10); }
        .inner-card.cyan   { background: linear-gradient(135deg, #2ec6e8, #1a8fb3); }
        .inner-card.red    { background: linear-gradient(135deg, #f06c2b, #d45a1a); }
        .inner-top { display: flex; align-items: center; gap: 12px; margin-bottom: 12px; }
        .inner-avatar { width: 52px; height: 52px; border-radius: 14px; background: rgba(255,255,255,0.25); flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
        .inner-avatar .initials { color: #fff; font-size: 20px; font-weight: 700; }
        .inner-info { flex: 1; }
        .inner-nomor { color: #fff; font-size: 16px; font-weight: 700; margin-bottom: 2px; }
        .inner-nama  { color: rgba(255,255,255,0.95); font-size: 13px; font-weight: 500; }
        .inner-nip   { color: rgba(255,255,255,0.75); font-size: 11px; margin-top: 2px; }
        .badge { font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 50px; white-space: nowrap; align-self: flex-start; }
        .badge-selesai { background: #2ecc71; color: #fff; }
        .badge-arsip   { background: #888; color: #fff; }
        .tanggal-row { background: rgba(255,255,255,0.22); border-radius: 50px; padding: 9px 16px; display: flex; justify-content: space-between; align-items: center; }
        .tanggal-row span { color: #fff; font-size: 13px; font-weight: 500; }

        .file-info { display: flex; align-items: center; gap: 10px; background: #f0fafd; border-radius: 12px; padding: 10px 14px; margin-bottom: 12px; }
        .file-info svg { width: 18px; height: 18px; stroke: #e74c3c; fill: none; stroke-width: 2; flex-shrink: 0; }
        .file-info span { font-size: 13px; color: #333; font-weight: 500; flex: 1; }
        .file-info a { color: #1a8fb3; font-size: 12px; font-weight: 600; text-decoration: none; }
        .file-info a:hover { text-decoration: underline; }

        .btn-arsipkan { width: 100%; background: #1a8fb3; color: #fff; border: none; border-radius: 50px; padding: 14px; font-size: 15px; font-weight: 700; cursor: pointer; font-family: inherit; display: flex; align-items: center; justify-content: center; gap: 8px; transition: background 0.2s, transform 0.1s; }
        .btn-arsipkan:hover { background: #157a9a; }
        .btn-arsipkan:active { transform: scale(0.97); }
        .btn-arsipkan:disabled { background: #a0c8d8; cursor: not-allowed; transform: none; }
        .btn-arsipkan svg { width: 18px; height: 18px; stroke: #fff; fill: none; stroke-width: 2; }

        .empty-state { text-align: center; padding: 60px 20px; color: #888; }
        .empty-state .icon { font-size: 52px; margin-bottom: 12px; }

        /* MODAL */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(26,143,179,0.35); z-index: 200; align-items: center; justify-content: center; }
        .modal-overlay.active { display: flex; }
        .modal-box { background: #fff; border-radius: 24px; padding: 32px 24px 24px; width: 300px; text-align: center; box-shadow: 0 8px 32px rgba(0,0,0,0.18); animation: popIn 0.2s ease; }
        @keyframes popIn { from { transform: scale(0.85); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .modal-icon { width: 64px; height: 64px; background: #eaf6fb; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; }
        .modal-icon svg { width: 36px; height: 36px; stroke: #1a8fb3; fill: none; stroke-width: 2.5; }
        .modal-title { font-size: 16px; font-weight: 700; color: #222; margin-bottom: 20px; line-height: 1.5; }
        .modal-btns { display: flex; gap: 12px; }
        .modal-btn-tidak { flex: 1; background: #fff; color: #1a8fb3; border: 1.5px solid #1a8fb3; border-radius: 50px; padding: 12px; font-size: 14px; font-weight: 700; cursor: pointer; font-family: inherit; transition: background 0.2s; }
        .modal-btn-tidak:hover { background: #eaf6fb; }
        .modal-btn-ya { flex: 1; background: #1a8fb3; color: #fff; border: none; border-radius: 50px; padding: 12px; font-size: 14px; font-weight: 700; cursor: pointer; font-family: inherit; transition: background 0.2s; }
        .modal-btn-ya:hover { background: #157a9a; }

        .navbar { position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 430px; background: #fff; border-top: 1px solid #e8e8e8; display: flex; justify-content: space-around; align-items: center; padding: 12px 0 20px; z-index: 100; }
        .nav-item { display: flex; flex-direction: column; align-items: center; cursor: pointer; padding: 6px 14px; border-radius: 14px; transition: background 0.2s; text-decoration: none; }
        .nav-item:hover { background: #f0f9fc; }
        .nav-item svg { width: 26px; height: 26px; stroke: #aaa; fill: none; stroke-width: 1.8; }
        .nav-item.active svg { stroke: #1a8fb3; }
        .nav-plus { width: 50px; height: 50px; background: #1a8fb3; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-top: -20px; box-shadow: 0 4px 14px rgba(26,143,179,0.4); transition: background 0.2s, transform 0.15s; text-decoration: none; }
        .nav-plus:hover { background: #157a9a; transform: scale(1.08); }
        .nav-plus svg { stroke: #fff; width: 24px; height: 24px; fill: none; stroke-width: 2; }
    </style>
</head>
<body>
<div class="shell">

    <div class="top-bar">
        <a href="{{ route('staff.dashboard') }}">&#8249;</a>
        <h2>Pengarsipan</h2>
        <span class="more">&#8942;</span>
    </div>

    <div class="content">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- SEARCH & FILTER --}}
        <form method="GET" action="{{ route('staff.pengarsipan.index') }}" class="search-wrap">
            <div class="search-box">
                <input type="text" name="search" class="search-input"
                    placeholder="Cari nama atau nomor SKPP..."
                    value="{{ request('search') }}"
                    oninput="this.form.submit()">
                <svg class="search-icon" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </div>
            <div class="filter-row">
                <button type="submit" name="sort" value="asc"
                    class="filter-btn {{ request('sort') === 'asc' ? 'active' : '' }}">
                    ↑ SKPP Terlama
                </button>
                <button type="submit" name="sort" value="desc"
                    class="filter-btn {{ request('sort', 'desc') === 'desc' ? 'active' : '' }}">
                    ↓ SKPP Terbaru
                </button>
                @if(request('search') || request('sort'))
                    <a href="{{ route('staff.pengarsipan.index') }}" class="filter-clear">✕ Reset</a>
                @endif
            </div>
        </form>

        @if(request('search'))
            <div class="hasil-pencarian">
                Hasil: <strong>"{{ request('search') }}"</strong> — {{ $pengajuanList->count() }} ditemukan
            </div>
        @endif

        @php $colors = ['purple', 'orange', 'cyan', 'red']; @endphp

        @forelse($pengajuanList as $i => $item)
            @php
                $color      = $colors[$i % 4];
                $sudahArsip = $item->status_arsip === 'diarsipkan';
                $nomorSkpp  = 'SKPP ' . str_pad($item->id, 3, '0', STR_PAD_LEFT);
                $nip        = $item->pencatatan->nip ?? '—';
                $nama       = $item->pencatatan->nama_lengkap ?? ($item->user->name ?? '—');
                $inisial    = strtoupper(substr($nama, 0, 1));
                $tglSelesai = $item->arsip?->tanggal_selesai
                    ? $item->arsip->tanggal_selesai->translatedFormat('j M Y')
                    : now()->translatedFormat('j M Y');
            @endphp

            <div class="outer-card">
                <div class="inner-card {{ $color }}">
                    <div class="inner-top">
                        <div class="inner-avatar"><span class="initials">{{ $inisial }}</span></div>
                        <div class="inner-info">
                            <div class="inner-nomor">{{ $nomorSkpp }}</div>
                            <div class="inner-nama">{{ $nama }}</div>
                            <div class="inner-nip">NIP : {{ $nip }}</div>
                        </div>
                        <span class="badge {{ $sudahArsip ? 'badge-arsip' : 'badge-selesai' }}">
                            {{ $sudahArsip ? 'Diarsipkan' : 'Siap Arsip' }}
                        </span>
                    </div>
                    <div class="tanggal-row">
                        <span>Tanggal Selesai</span>
                        <span>{{ $tglSelesai }}</span>
                    </div>
                </div>

                @if($item->draftSkpp)
                    <div class="file-info">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        <span>File SKPP tersedia</span>
                        <a href="{{ asset('storage/' . $item->draftSkpp->file_skpp) }}" target="_blank">Lihat</a>
                    </div>
                @endif

                <button class="btn-arsipkan" onclick="arsipkan({{ $item->id }}, this)"
                    {{ $sudahArsip ? 'disabled' : '' }} id="btn-{{ $item->id }}">
                    <svg viewBox="0 0 24 24"><path d="M3 7h18v13H3z"/><path d="M3 7l3-4h12l3 4"/><line x1="9" y1="12" x2="15" y2="12"/></svg>
                    {{ $sudahArsip ? 'Sudah Diarsipkan' : 'Arsipkan' }}
                </button>
            </div>
        @empty
            <div class="empty-state">
                <div class="icon">🗂️</div>
                <p>{{ request('search') ? 'Tidak ada hasil pencarian.' : 'Belum ada SKPP yang siap diarsipkan.' }}</p>
            </div>
        @endforelse
    </div>

    <!-- MODAL KIRIM MITRA -->
    <div class="modal-overlay" id="modal-kirim">
        <div class="modal-box">
            <div class="modal-icon">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="modal-title">SKPP berhasil diarsipkan.<br>Kirim ke mitra kerja sekarang?</div>
            <div class="modal-btns">
                <button class="modal-btn-tidak" onclick="tutupModal()">Tidak</button>
                <button class="modal-btn-ya" onclick="kirimMitra()">Ya</button>
            </div>
        </div>
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
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let currentPengajuanId = null;

    async function arsipkan(id, btn) {
        btn.disabled = true;
        btn.innerHTML = `<svg viewBox="0 0 24 24" style="width:18px;height:18px;stroke:#fff;fill:none;stroke-width:2"><path d="M3 7h18v13H3z"/><path d="M3 7l3-4h12l3 4"/></svg> Mengarsipkan...`;

        try {
            const res  = await fetch(`/staff/pengarsipan/${id}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' },
            });
            const data = await res.json();

            if (data.success) {
                currentPengajuanId = id;
                const badge = btn.closest('.outer-card').querySelector('.badge-selesai');
                if (badge) { badge.textContent = 'Diarsipkan'; badge.className = 'badge badge-arsip'; }
                btn.innerHTML = `<svg viewBox="0 0 24 24" style="width:18px;height:18px;stroke:#fff;fill:none;stroke-width:2"><path d="M3 7h18v13H3z"/><path d="M3 7l3-4h12l3 4"/></svg> Sudah Diarsipkan`;
                document.getElementById('modal-kirim').classList.add('active');
            } else {
                alert(data.message);
                btn.disabled = false;
                btn.innerHTML = `<svg viewBox="0 0 24 24" style="width:18px;height:18px;stroke:#fff;fill:none;stroke-width:2"><path d="M3 7h18v13H3z"/><path d="M3 7l3-4h12l3 4"/><line x1="9" y1="12" x2="15" y2="12"/></svg> Arsipkan`;
            }
        } catch (e) {
            alert('Terjadi kesalahan. Silakan coba lagi.');
            btn.disabled = false;
            btn.innerHTML = `<svg viewBox="0 0 24 24" style="width:18px;height:18px;stroke:#fff;fill:none;stroke-width:2"><path d="M3 7h18v13H3z"/><path d="M3 7l3-4h12l3 4"/><line x1="9" y1="12" x2="15" y2="12"/></svg> Arsipkan`;
        }
    }

    function tutupModal() {
        document.getElementById('modal-kirim').classList.remove('active');
        currentPengajuanId = null;
    }

    async function kirimMitra() {
        if (!currentPengajuanId) return;
        try {
            const res  = await fetch(`/staff/pengarsipan/${currentPengajuanId}/kirim`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Content-Type': 'application/json', 'Accept': 'application/json' },
            });
            const data = await res.json();
            if (data.success) {
                tutupModal();
                const notif = document.createElement('div');
                notif.style.cssText = 'position:fixed;top:24px;left:50%;transform:translateX(-50%);background:#2ecc71;color:#fff;padding:12px 24px;border-radius:50px;font-weight:700;font-size:14px;z-index:999;';
                notif.textContent = '✓ SKPP berhasil dikirim ke mitra!';
                document.body.appendChild(notif);
                setTimeout(() => notif.remove(), 3000);
            }
        } catch (e) { tutupModal(); }
    }
</script>
</body>
</html>