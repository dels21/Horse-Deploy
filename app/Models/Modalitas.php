<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Modalitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaModalitas',
        'jenisModalitas',
        'merekModalitas',
        'tipeModalitas',
        'nomorSeriModalitas',
        'alamatIp',
        'kodeRuang',
    ];

    protected $table = 'master_modalitas';
    protected $primaryKey = 'kodeModalitas';

    public function ForeignModalitas(): HasOne
    {
        return $this->hasOne(MasterDicom::class);
    }   
    
}
