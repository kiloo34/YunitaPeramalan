<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    protected $fillable = [
        'nama',
    ];

    /**
     * Get the user associated with the Kecamatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function produksi()
    {
        return $this->hasMany('App\Models\Produksi');
    }

    /**
     * Get the user associated with the Kecamatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function permintaan()
    {
        return $this->hasMany('App\Models\Permintaan');
    }

    /**
     * Get the mantri that owns the Kecamatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mantri()
    {
        return $this->belongsTo('App\Models\Mantri');
    }
}
