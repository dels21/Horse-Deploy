<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPemeriksaanRadiologi extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'hasil_pemeriksaan_radiologi';
}
