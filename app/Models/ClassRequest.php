<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRequest extends Model
{
    use SoftDeletes;

    protected $table = 'class_request';
    protected $fillable = [
        'id',
        'member_id',
        'class_id',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $dates = ['deleted_at'];

    public function getClass(){
        return $this->belongsTo('App\Models\ClassMenu', 'class_id', 'class_id')->withTrashed();
    }
    public function getMateri(){
        return $this->belongsTo('App\view_stream', 'materi_id', 'id')->withTrashed();
    }
    public function getUser(){
        return $this->belongsTo('App\User', 'member_id', 'id')->withTrashed();
    }
}
