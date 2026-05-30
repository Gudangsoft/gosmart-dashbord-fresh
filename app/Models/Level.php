<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Illuminate\Notifications\Notifiable;

class Level extends Model
{
    Use SoftDeletes;
    // use Notifiable;

    protected $fillable = [
        'id', 'name', 'status', 'add_by'
    ];

}
