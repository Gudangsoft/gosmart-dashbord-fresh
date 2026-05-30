<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'class_id',
        'created_by',
        'status',
        'expired_at',
        'created_at',
        'updated_at',
    ];

    public function getClass(){
        return $this->belongsTo('App\Models\ClassMenu', 'class_id', 'class_id')->withTrashed();
    }

    public function getUser(){
        return $this->belongsTo('App\User', 'user_id', 'id')->withTrashed();
    }
}
