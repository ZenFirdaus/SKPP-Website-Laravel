{{-- Komponen pencarian & filter - pakai di setiap halaman dengan @include --}}
{{-- Parameter: $searchPlaceholder (opsional) --}}

<div style="margin-bottom:16px;">
    <form method="GET" action="" id="search-form">
        {{-- Search Input --}}
        <div style="position:relative;margin-bottom:10px;">
            <input
                type="text"
                name="search"
                id="search-input"
                value="{{ request('search') }}"
                placeholder="{{ $searchPlaceholder ?? 'Cari nama atau nomor SKPP...' }}"
                style="
                    width:100%;
                    background:#fff;
                    border:none;
                    border-radius:50px;
                    padding:12px 44px 12px 18px;
                    font-size:14px;
                    color:#333;
                    outline:none;
                    box-shadow:0 2px 8px rgba(0,0,0,0.08);
                    font-family:inherit;
                "
                oninput="document.getElementById('search-form').submit()"
            />
            <svg style="position:absolute;right:16px;top:50%;transform:translateY(-50%);width:18px;height:18px;stroke:#aaa;fill:none;stroke-width:2;" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
        </div>

        {{-- Filter Sort --}}
        <div style="display:flex;gap:8px;">
            <button type="submit" name="sort" value="asc"
                style="
                    flex:1;padding:9px;border-radius:50px;border:none;
                    font-size:12px;font-weight:700;cursor:pointer;font-family:inherit;
                    background:{{ request('sort') === 'asc' ? '#1a8fb3' : '#fff' }};
                    color:{{ request('sort') === 'asc' ? '#fff' : '#888' }};
                    box-shadow:0 2px 6px rgba(0,0,0,0.07);
                    transition:all 0.2s;
                ">
                ↑ SKPP Terlama
            </button>
            <button type="submit" name="sort" value="desc"
                style="
                    flex:1;padding:9px;border-radius:50px;border:none;
                    font-size:12px;font-weight:700;cursor:pointer;font-family:inherit;
                    background:{{ request('sort', 'desc') === 'desc' ? '#1a8fb3' : '#fff' }};
                    color:{{ request('sort', 'desc') === 'desc' ? '#fff' : '#888' }};
                    box-shadow:0 2px 6px rgba(0,0,0,0.07);
                    transition:all 0.2s;
                ">
                ↓ SKPP Terbaru
            </button>
            @if(request('search') || request('sort'))
            <a href="{{ url()->current() }}"
                style="
                    padding:9px 14px;border-radius:50px;
                    background:#fdecea;color:#e74c3c;
                    font-size:12px;font-weight:700;
                    text-decoration:none;
                    box-shadow:0 2px 6px rgba(0,0,0,0.07);
                    display:flex;align-items:center;
                ">✕</a>
            @endif
        </div>

        {{-- Preserve other query params --}}
        @foreach(request()->except(['search', 'sort', '_token']) as $key => $val)
            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
        @endforeach
    </form>
</div>