<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagesModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'slug',
        'content',
        'status',
        'created_by',
        'updated_by'
    ];

    public function getUser(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id')->withTrashed();
    }
}
