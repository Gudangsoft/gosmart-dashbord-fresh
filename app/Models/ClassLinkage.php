<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassLinkage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'class_id',
        'class_parent',
        'add_by',
        'status',
    ];
    protected $dates = ['deleted_at'];

    public function getClass(){
        return $this->belongsTo('App\Models\ClassMenu', 'class_id', 'class_id')->withTrashed();
    }
    public function getParentClass(){
        return $this->belongsTo('App\Models\ClassMenu', 'class_parent', 'class_id')->withTrashed();
    }
    public function getMateri(){
        return $this->belongsTo('App\view_stream', 'materi_id', 'id')->withTrashed();
    }
    public function getUser(){
        return $this->belongsTo('App\User', 'add_by', 'id')->withTrashed();
    }
}
