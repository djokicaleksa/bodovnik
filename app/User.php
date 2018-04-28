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
        return $this->hasMany('App\Activity');
    }

    public function points(){
        $points = 0;
        foreach($this->activities as $activity){
            $points += $activity->points;
        }

        return $points;
    }

    public function getImageAttribute($image){

        if($image == null){
            return "https://www.whittierplf.org/wp-content/uploads/default-user-image-e1501670968910-circle-300x300.png";
        }
        return $image;
    }

    public function getBirthdayAttribute($birthday){
        if(!is_null($birthday)){
            return date('d.m.Y', strtotime($birthday));
        }

        return null;
    }
}
