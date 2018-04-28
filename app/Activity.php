<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name', 'points', 'user_id', 'ispostovan_rok', 'tacno_uradjen_zadatak', 'u_potpunosti_odradjen_zadatak', 'kvalitet'
    ];

    public function team(){
        return $this->belongsTo('App\Team');
    }

    public function users(){
        return $this->belongsToMany('App\Users');
    }

    public function points(){
        return $this->ispostovan_rok + $this->tacno_uradjen_zadatak + $this->u_potpunosti_odradjen_zadatak + $this->kvalitet;
    }
}
