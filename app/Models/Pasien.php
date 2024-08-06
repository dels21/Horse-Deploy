<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{

    use HasFactory;


    protected $guarded = [];
    protected $table = 'pasien';
    protected $primaryKey = 'idPasien';

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
}
