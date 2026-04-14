@extends('layouts.app')

@section('content')
<style>
body {
    background: #e8f3f8;
}

.shell {
    max-width: 430px;
    margin: auto;
    min-height: 100vh;
    background: #dff0f7;
}

/* HEADER */
.top-bar {
    background: linear-gradient(160deg, #2ec6e8, #1a8fb3);
    padding: 20px;
    padding-bottom: 60px;
    border-radius: 0 0 30px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.top-bar h2 {
    color: white;
    font-weight: bold;
}

/* CONTENT */
.content {
    margin-top: -30px;
    padding: 15px;
}

/* FORM */
.form-box {
    background: #ececec;
    padding: 20px;
    border-radius: 25px;
}

/* INPUT */
.form-box input,
.form-box textarea {
    width: 100%;
    padding: 14px;
    border-radius: 20px;
    border: none;
    margin-bottom: 15px;
}

/* STATUS BUTTON */
.status {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}

.status label {
    flex: 1;
    text-align: center;
    padding: 10px;
    border-radius: 20px;
    color: white;
}

.valid { background: #63c36b; }
.invalid { background: #ff7b7b; }

/* ACTION */
.actions {
    display: flex;
    justify-content: space-between;
}
.btn-save {
    background: #2ec6e8;
    color: white;
    padding: 10px 20px;
    border-radius: 20px;
}
.btn-cancel {
    border: 1px solid #2ec6e8;
    padding: 10px 20px;
    border-radius: 20px;
}
</style>

<div class="shell">

    <div class="top-bar">
        <a href="{{ route('staff.pencatatan.index') }}">‹</a>
        <h2>Pencatatan</h2>
        <span style="color:white;">⋮</span>
    </div>

    <div class="content">

        <form method="POST" action="{{ route('staff.pencatatan.store', $pengajuan->id) }}" class="form-box">
            @csrf

            <h3>Form Pencatatan</h3>
            <p>SKPP {{ str_pad($pengajuan->id,3,'0',STR_PAD_LEFT) }}</p>

            <label>Nama Lengkap</label>
            <input type="text" name="nama">

            <label>NIP</label>
            <input type="text" name="nip">

            <label>Status Dokumen</label>
            <div class="status">
                <label class="valid">
                    <input type="radio" name="status_dokumen" value="valid" hidden> Valid
                </label>
                <label class="invalid">
                    <input type="radio" name="status_dokumen" value="tidak_valid" hidden> Tidak Valid
                </label>
            </div>

            <label>Catatan</label>
            <textarea name="catatan"></textarea>

            <div class="actions">
                <a href="{{ route('staff.pencatatan.index') }}" class="btn-cancel">Batal</a>
                <button class="btn-save">Simpan</button>
            </div>

        </form>

    </div>

</div>
@endsection