<?php

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('kepala can view kepala dashboard with review summary', function () {
    $kepala = User::factory()->kepala()->create();
    Pengajuan::factory()->count(2)->create(['status_pencatatan' => 'selesai_dicatat']);

    $response = $this->actingAs($kepala)->get(route('kepala.dashboard'));

    $response->assertStatus(200);
    $response->assertSee('Halo, Kepala Staff');
    $response->assertSee('Menunggu Review');
});

test('kepala can review and approve submission', function () {
    $kepala = User::factory()->kepala()->create();
    $pengajuan = Pengajuan::factory()->create(['status_pencatatan' => 'selesai_dicatat']);

    $response = $this->actingAs($kepala)->post(route('kepala.pengecekan.store', $pengajuan->id), [
        'slip_gaji' => 'lengkap',
        'sk' => 'lengkap',
        'surat_pengantar' => 'lengkap',
        'keputusan' => 'setuju',
        'catatan_pengecekan' => 'Semua berkas sah dan disetujui.',
    ]);

    $response->assertRedirect(route('kepala.pengecekan.index'));
    $this->assertDatabaseHas('pengecekan', [
        'pengajuan_id' => $pengajuan->id,
        'keputusan' => 'setuju',
        'dicek_oleh' => $kepala->id,
    ]);

    $this->assertDatabaseHas('pengajuans', [
        'id' => $pengajuan->id,
        'status_pengecekan' => 'disetujui',
        'status' => 'disetujui',
    ]);
});

test('kepala can review and reject submission', function () {
    $kepala = User::factory()->kepala()->create();
    $pengajuan = Pengajuan::factory()->create(['status_pencatatan' => 'selesai_dicatat']);

    $response = $this->actingAs($kepala)->post(route('kepala.pengecekan.store', $pengajuan->id), [
        'slip_gaji' => 'tidak',
        'sk' => 'lengkap',
        'surat_pengantar' => 'lengkap',
        'keputusan' => 'tolak',
        'catatan_pengecekan' => 'Slip gaji belum bertandatangan resmi.',
    ]);

    $response->assertRedirect(route('kepala.pengecekan.index'));
    $this->assertDatabaseHas('pengajuans', [
        'id' => $pengajuan->id,
        'status_pengecekan' => 'ditolak',
        'status' => 'ditolak',
    ]);
});

test('kepala can upload draft skpp for approved submission', function () {
    Storage::fake('public');
    $kepala = User::factory()->kepala()->create();
    $pengajuan = Pengajuan::factory()->disetujui()->create();

    $fileSkpp = UploadedFile::fake()->create('SKPP_resmi.pdf', 1000, 'application/pdf');

    $response = $this->actingAs($kepala)->post(route('kepala.draft.store', $pengajuan->id), [
        'file_skpp' => $fileSkpp,
    ]);

    $response->assertRedirect(route('kepala.draft.index'));
    $this->assertDatabaseHas('draft_skpp', [
        'pengajuan_id' => $pengajuan->id,
        'diupload_oleh' => $kepala->id,
    ]);

    $this->assertDatabaseHas('pengajuans', [
        'id' => $pengajuan->id,
        'status_draft' => 'sudah_diupload',
    ]);
});

test('kepala can soft delete and restore submission', function () {
    $kepala = User::factory()->kepala()->create();
    $pengajuan = Pengajuan::factory()->create();

    $deleteResponse = $this->actingAs($kepala)->deleteJson(route('kepala.pengecekan.destroy', $pengajuan->id));
    $deleteResponse->assertStatus(200);
    $this->assertSoftDeleted('pengajuans', ['id' => $pengajuan->id]);

    $restoreResponse = $this->actingAs($kepala)->postJson(route('kepala.pengecekan.pulihkan', $pengajuan->id));
    $restoreResponse->assertStatus(200);
    $this->assertNotSoftDeleted('pengajuans', ['id' => $pengajuan->id]);
});

test('kepala cannot access staff or mitra restricted routes', function () {
    $kepala = User::factory()->kepala()->create();

    $this->actingAs($kepala)->get(route('mitra.dashboard'))->assertStatus(403);
    $this->actingAs($kepala)->get(route('staff.dashboard'))->assertStatus(403);
});
