<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassHistory extends Model
{
    //
    use SoftDeletes;

    protected $table = "class_history";
    protected $fillable = [
        'id',
        'member_id',
        'class_id',
        'materi_id',
        'level_id',
        'status',
        'premium',
        'rating',
        'review',
        'deleted_at'
    ];
    protected $dates = ['deleted_at'];

    public function getClass(){
        return $this->belongsTo('App\Models\ClassMenu', 'class_id', 'class_id')->withTrashed();
    }
    public function getUser(){
        return $this->belongsTo('App\User', 'member_id', 'id')->withTrashed();
    }
    public function getMateri(){
        return $this->belongsTo('App\view_stream', 'materi_id', 'id')->withTrashed();
    }
    public function getChannel(){
        return $this->belongsTo('App\chanel', 'member_id', 'id_user')->withTrashed();
    }
    public function getLevel(){
        return $this->belongsTo('App\Models\Level', 'level_id', 'id')->withTrashed();
    }

}
