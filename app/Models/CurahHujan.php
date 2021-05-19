<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurahHujan extends Model
{
    protected $table = 'curah_hujan';

    protected $fillable = [
        'bulan',
        'tahun',
        'nilai'
    ];
}
