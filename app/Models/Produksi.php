<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $table = 'produksi';

    protected $fillable = [
        'produksi',
        'luas_panen',
        'harga',
    ];

    /**
     * Get the user that owns the Produksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan');
    }

    /**
     * Get the user associated with the Produksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function periode()
    {
        return $this->belongsTo('App\Models\Periode');
    }
}
