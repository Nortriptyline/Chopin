<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password_init extends Model
{
    //

    protected $primaryKey = 'token';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $guarded = [];

    protected $dates = ['revoked_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'email', 'email');
    }
}
