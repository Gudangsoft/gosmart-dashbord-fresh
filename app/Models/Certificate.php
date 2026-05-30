<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function getClass(){
        return $this->belongsTo('App\Models\ClassMenu', 'class_id', 'class_id')->withTrashed();
    }
    public function getUser(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->withTrashed();
    }
}
