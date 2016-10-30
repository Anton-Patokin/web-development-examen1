<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function usergooglelocations()
    {
        return $this->hasMany('App\Googlelocation');
    }
    public function get_participant()
    {
        return $this->hasOne('App\Participant');
        
    }



    protected $fillable = [
        'name', 'email', 'password',
    ];






    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = ['deleted_at'];
}
