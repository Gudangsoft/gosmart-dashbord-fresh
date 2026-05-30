<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToolsMateri extends Model
{
    // use SoftDeletes;

    protected $fillable = [
        'id',
        'title',
        'link',
        'image',
        'user_id',
    ];
    // protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->withTrashed();
    }
}
