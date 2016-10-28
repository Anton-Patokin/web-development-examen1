<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{

    use SoftDeletes;
    //

    public function contestDatum()
    {
        return $this->belongsToMany('App\Contestdatum');
    }


    protected $dates = ['deleted_at'];
}
