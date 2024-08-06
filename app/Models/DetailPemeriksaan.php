<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'nomorPemeriksaan',
        'jamMulaiPemeriksaanAlat',
        'jamSelesaiPemeriksaanAlat',
        'ruangan',
        'keterangan',
        'diskon',
        'hargaTotal',
        'status'
    ];

    protected $table = 'detail_pemeriksaan';
    protected $primaryKey = 'idDetailPemeriksaan';
}
