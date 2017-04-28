<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name', 'points', 'team_id'
    ];

    public function team(){
        return $this->belongsTo('App\Team');
    }

    public function users(){
        return $this->belongsToMany('App\Users');
    }
}
