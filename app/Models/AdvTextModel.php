<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvTextModel extends Model
{
    // use Notifiable;

    protected $fillable = [
        'id', 'text', 'url', 'add_by'
    ];

    public function getUser(){
        return $this->belongsTo('App\User', 'add_by', 'id')->withTrashed();
    }
}
