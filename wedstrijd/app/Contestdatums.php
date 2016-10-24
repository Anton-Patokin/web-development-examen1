<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contestdatums extends Model
{
    use SoftDeletes;
    //

    public function participants()
    {
        return $this->hasMany('App\Participant');
    }


    protected $dates = ['deleted_at'];
}
