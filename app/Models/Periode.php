<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'periode';

    protected $fillable = [
        'periode',
        'tahun'
    ];

    /**
     * Get the user that owns the Periode
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produksi()
    {
        return $this->hasMany('App\Models\Produksi');
    }

    /**
     * Get the user that owns the Periode
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permintaan()
    {
        return $this->hasMany('App\Models\Permintaan');
    }
}
