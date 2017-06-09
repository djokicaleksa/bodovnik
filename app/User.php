<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'birthday', 'role_id', 'image', 'team_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function team(){
        return $this->belongsTo('App\Team');
    }

    public function isAdmin(){
        if($this->role->id == 1){
            return true;
        }
        return false;
    }

    public function activities(){
        return $this->belongsToMany('App\Activity')->withTimestamps();
    }

    public function points(){
        $points = 0;
        foreach($this->activities as $activity){
            $points += $activity->points;
        }

        return $points;
    }
}
