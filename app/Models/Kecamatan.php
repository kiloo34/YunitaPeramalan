<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    protected $fillable = [
        // 'id',
        'nama',
    ];

    /**
     * Get the user associated with the Kecamatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function produksi()
    {
        return $this->belongsTo('App\Models\Produksi');
    }

    /**
     * Get the user associated with the Kecamatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function permintaan()
    {
        return $this->belongsTo('App\Models\Permintaan');
    }
}
