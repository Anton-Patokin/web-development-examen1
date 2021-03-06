<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{
    use SoftDeletes;

    public function contests()
    {
        return $this->belongsToMany('App\Contest');
    }
    public function user()
    {
        return $this->hasOne('App\User');
    }

    protected $dates = ['deleted_at'];
}
