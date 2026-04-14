<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pencatatan extends Model
{
    use HasFactory;

    protected $table = 'pencatatan';

    protected $fillable = [
        'pengajuan_id',
        'nama_lengkap',
        'nip',
        'status_dokumen',
        'catatan',
        'dicatat_oleh',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'dicatat_oleh');
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->status_dokumen === 'valid' ? 'Valid' : 'Tidak Valid';
    }

    public function getStatusColorAttribute(): string
    {
        return $this->status_dokumen === 'valid' ? 'green' : 'red';
    }
}