<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileGacademy extends Model
{
    protected $guarded =[];

    protected $dates = ['deleted_at'];

    public function getUser(){
        return $this->belongsTo('App\User', 'add_by', 'id')->withTrashed();
    }
}
