<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftSkpp extends Model
{
    use HasFactory;

    protected $table = 'draft_skpp';

    protected $fillable = [
        'pengajuan_id',
        'diupload_oleh',
        'file_skpp',
        'tanggal_upload',
    ];

    protected $casts = [
        'tanggal_upload' => 'datetime',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function kepala()
    {
        return $this->belongsTo(User::class, 'diupload_oleh');
    }
}