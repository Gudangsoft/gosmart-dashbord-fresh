<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewClassModel extends Model
{
    protected $fillable = [
        'id',
        'class_id',
        'user_id',
        'status',
        'rating',
        'review',
    ];

    protected $dates = ['deleted_at'];

    public function getClass(){
        return $this->belongsTo('App\Models\ClassMenu', 'class_id', 'class_id')->withTrashed();
    }
    public function getUser(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->withTrashed();
    }


}
