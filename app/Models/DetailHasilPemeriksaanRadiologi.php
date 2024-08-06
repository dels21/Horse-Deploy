<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailHasilPemeriksaanRadiologi extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'detail_hasil_pemeriksaan_radiologi';

    protected $primaryKey = 'idDetailHasilPemeriksaan';
}
