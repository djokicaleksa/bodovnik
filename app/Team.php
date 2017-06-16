<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $fillable = [
        'name', 'team_leader', 'description'
    ];
    public function leader(){
        return $this->belongsTo('App\User', 'team_leader', 'id');
    }

    public function users(){
        return $this->hasMany('App\User');
    }

    public function reports(){
        return $this->hasMany('App\Report');
    }

    public function meetings(){
        return $this->hasMany('App\Meetings');
    }

}
