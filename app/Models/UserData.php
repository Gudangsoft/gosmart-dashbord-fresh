<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'expert',
        'resume',
        'education',
        'bio',
        'signature_url'
    ];
    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->withTrashed();
    }
}
