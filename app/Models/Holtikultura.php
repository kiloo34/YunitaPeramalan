<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holtikultura extends Model
{
    protected $table = 'holtikultura';

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
}
