<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengecekan extends Model
{
    use HasFactory;

    protected $table = 'pengecekan';

    protected $fillable = [
        'pengajuan_id',
        'slip_gaji',
        'sk',
        'surat_pengantar',
        'keputusan',
        'catatan_pengecekan',
        'dicek_oleh',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function kepala()
    {
        return $this->belongsTo(User::class, 'dicek_oleh');
    }
}