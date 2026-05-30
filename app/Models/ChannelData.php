<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChannelData extends Model
{
    protected $table = "channel_data";
    protected $fillable = [
        'id',
        'user_id',
        'channel_id',
        'materi_id',
        'class_id',
    ];

    public function getClass(){
        return $this->belongsTo('App\Models\ClassMenu', 'class_id', 'class_id');
    }
    public function getUser(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function getMateri(){
        return $this->belongsTo('App\view_stream', 'materi_id', 'id');
    }
    public function getChannel(){
        return $this->belongsTo('App\chanel', 'user_id', 'id_user');
    }
}
