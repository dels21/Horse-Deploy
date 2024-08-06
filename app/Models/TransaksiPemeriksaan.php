<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPemeriksaan extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nomorPendaftaran',
        'idKaryawanRadiografer',
        'idKaryawanDokterRadiologi',
        'namaDokterPengirim',
        'tanggalPemeriksaan',
        'diagnosis',
        'keterangan',
    ];

    protected $table = 'transaksi_pemeriksaan';
    protected $primaryKey = 'nomorPemeriksaan';

    public function detailPendaftaran()
{
    return $this->hasMany(DetailPendaftaranPemeriksaan::class, 'noPendaftaran', 'nomorPendaftaran');
}

public function pendaftaranPemeriksaan()
    {
        return $this->belongsTo(PendaftaranPemeriksaan::class, 'nomorPendaftaran', 'nomorPendaftaran');
    }
}
