<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkillModel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'skill'
    ];

    protected $dates = ['deleted_at'];

    public function getUser(){
        return $this->belongsTo('App\User', 'user_id', 'id')->withTrashed();
    }
}
