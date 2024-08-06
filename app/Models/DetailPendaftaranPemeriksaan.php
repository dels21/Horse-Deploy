<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPendaftaranPemeriksaan extends Model
{
    use HasFactory;
    protected $guarded = ['keteranganKetersediaan'];
    protected $table = 'detail_pendaftaran';

    public function pendaftaranPemeriksaan()
    {
        return $this->belongsTo(PendaftaranPemeriksaan::class, 'noPendaftaran', 'nomorPendaftaran');
    }
}
