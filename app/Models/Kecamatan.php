<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    protected $fillable = [
        'nama'
    ];

    /**
     * Get the user associated with the Kecamatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function produksi()
    {
        return $this->hasOne('App\Models\Produksi');
    }
}
