<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $table = 'permintaan';

    protected $fillable = [
        'permintaan',
        // 'kecamatan_id',
        // 'periode_id',
        // 'harga',
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
