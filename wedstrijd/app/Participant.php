<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{

    use SoftDeletes;
    //

    public function participants()
    {
        return $this->hasOne('App\Contestdatums');
    }


    protected $dates = ['deleted_at'];
}
