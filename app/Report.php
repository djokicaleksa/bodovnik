<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'url', 'name', 'user_id', 'team_id', 'display_name'
    ];

    public function team(){
        return $this->belongsTo('App\Team');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
