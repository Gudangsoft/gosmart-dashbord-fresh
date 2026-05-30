<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "class_categories";
    protected $fillable = [
        'id',
        'title',
        'slug',
        'status',
        'created_by',
        'updated_by',
    ];

    public function getUser(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id')->withTrashed();
    }
}
