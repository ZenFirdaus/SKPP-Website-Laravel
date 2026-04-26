<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengajuan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengajuans';

    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'alamat',
        'npwp',
        'keperluan',
        'status',
        'file_slip_gaji',
        'file_sk',
        'file_skpp',
        'status_pencatatan',
        'status_pengecekan',
        'status_arsip',
        'status_draft',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pencatatan()
    {
        return $this->hasOne(Pencatatan::class);
    }

    public function pengecekan()
    {
        return $this->hasOne(Pengecekan::class);
    }

    public function arsip()
    {
        return $this->hasOne(Arsip::class);
    }

    public function draftSkpp()
    {
        return $this->hasOne(DraftSkpp::class);
    }
}