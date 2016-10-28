<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contest extends Model
{

    use SoftDeletes;

    public function participants()
    {
        return $this->belongsToMany('App\Participant');
    }

    protected $dates = ['deleted_at'];
}