<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisPemeriksaan extends Model
{
    protected $fillable =
    [
        'kodeModalitas',
        'namaJenisPemeriksaan',
        'kelompokJenisPemeriksaan',
        'pemakaianKontras',
        'lamaPemeriksaan',
        'harga',
    ];
    use HasFactory;
protected $guarded = ['kodeJenisPemeriksaan'];
    protected $primaryKey = 'kodeJenisPemeriksaan';
    protected $table = 'master_jenis_pemeriksaan';
}
