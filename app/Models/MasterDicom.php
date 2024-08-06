<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDicom extends Model
{
    use HasFactory;

    protected $fillable = [
        'alamatIp',
        'netMask',
        'layananDicom',
        'peran',
        'aet',
        'port',
        'idLayananDicom'
    ];

    protected $table = 'master_dicom';
    protected $primaryKey = 'idLayananDicom';
}
