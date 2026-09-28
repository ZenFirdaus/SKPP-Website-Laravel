<?php

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

test('unauthenticated user cannot view documents', function () {
    $pengajuan = Pengajuan::factory()->create();

    $this->get(route('dokumen.view', [$pengajuan->id, 'slip_gaji']))
        ->assertRedirect(route('login'));
});

test('unauthorized mitra cannot view another mitras document', function () {
    Storage::fake('public');
    $mitra1 = User::factory()->create(['role' => 'mitra']);
    $mitra2 = User::factory()->create(['role' => 'mitra']);

    $path = 'pengajuan/slip_gaji/sample.pdf';
    Storage::disk('public')->put($path, 'pdf content');

    $pengajuan = Pengajuan::factory()->create([
        'user_id' => $mitra1->id,
        'file_slip_gaji' => $path,
    ]);

    $this->actingAs($mitra2)->get(route('dokumen.view', [$pengajuan->id, 'slip_gaji']))
        ->assertStatus(403);
});

test('mitra can view their own document', function () {
    Storage::fake('public');
    $mitra = User::factory()->create(['role' => 'mitra']);

    $path = 'pengajuan/slip_gaji/sample.pdf';
    Storage::disk('public')->put($path, 'pdf content');

    $pengajuan = Pengajuan::factory()->create([
        'user_id' => $mitra->id,
        'file_slip_gaji' => $path,
    ]);

    $response = $this->actingAs($mitra)->get(route('dokumen.view', [$pengajuan->id, 'slip_gaji']));
    $response->assertStatus(200);
});

test('staff and kepala can view applicant documents for verification', function () {
    Storage::fake('public');
    $staff = User::factory()->staff()->create();
    $kepala = User::factory()->kepala()->create();
    $mitra = User::factory()->create(['role' => 'mitra']);

    $path = 'pengajuan/sk/sample_sk.pdf';
    Storage::disk('public')->put($path, 'sk content');

    $pengajuan = Pengajuan::factory()->create([
        'user_id' => $mitra->id,
        'file_sk' => $path,
    ]);

    $this->actingAs($staff)->get(route('dokumen.view', [$pengajuan->id, 'sk']))
        ->assertStatus(200);

    $this->actingAs($kepala)->get(route('dokumen.view', [$pengajuan->id, 'sk']))
        ->assertStatus(200);
});
