<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogoMitra extends Model
{
    Use SoftDeletes;
    // use Notifiable;

    protected $fillable = [
        'id', 'url_image', 'class_id', 'add_by', 'status'
    ];

    protected $dates = ['deleted_at'];

    public function getClass(){
        return $this->belongsTo('App\Models\ClassMenu', 'class_id', 'class_id')->withTrashed();
    }
    public function getUser(){
        return $this->belongsTo('App\Models\User', 'add_by', 'id')->withTrashed();
    }

}
