<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mantri extends Model
{
    protected $table = 'mantri';

    protected $guarded = ['id', 'user_id'];

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'avatar',
    ];

    /**
     * Get the user associated with the Holtikultura
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the user associated with the Mantri
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan');
    }
}
