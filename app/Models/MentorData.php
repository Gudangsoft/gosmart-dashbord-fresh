<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MentorData extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'expert',
        'resume',
        'bio',
        'education',
    ];
    protected $dates = ['deleted_at'];


}
