<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
class chanel extends Model
{
    use SoftDeletes;

    // use HasFactory;
    protected $table = "chanel";
    protected $fillable = ['id','nama_lengkap','nama_chanel','link_chanel','chanel_img','id_user'];
    protected $dates = ['deleted_at'];
}
