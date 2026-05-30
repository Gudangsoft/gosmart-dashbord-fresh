<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageCategoryModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'slug',
        'status',
        'created_by',
        'updated_by'
    ];

    public function getUser(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id')->withTrashed();
    }
}
