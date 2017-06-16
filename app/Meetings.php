<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meetings extends Model
{
    protected $fillable = [
        'name', 'location', 'team_id'
    ];

    public function team(){
        return $this->belongsTo('App\Team');
    }

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
