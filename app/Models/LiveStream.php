<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LiveStream extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'title', 'youtube_id', 'status', 'add_by'];

    protected $dates = ['deleted_at'];

    public function getUser(){
        return $this->belongsTo('App\Models\User', 'add_by', 'id')->withTrashed();
    }
    public function getChannel(){
        return $this->belongsTo('App\chanel', 'add_by', 'id_user');
    }
}
