<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassMenu extends Model
{

    use SoftDeletes;

    protected $table = "class_menu";
    protected $guarded = [];


    public function getUser(){
        return $this->belongsTo('App\Models\User', 'add_by', 'id')->withTrashed();
    }
    public function getCategory(){
        return $this->belongsTo('App\Models\ClassCategory', 'category_id', 'id')->withTrashed();
    }
    public function getChannel(){
        return $this->belongsTo('App\chanel', 'add_by', 'id_user')->withTrashed();
    }
    public function getLevel(){
        return $this->belongsTo('App\Models\Level', 'level_id', 'id')->withTrashed();
    }
    public function getDataUser(){
        return $this->belongsTo('App\Models\UserData', 'add_by', 'user_id')->withTrashed();
    }
    public function getReview(){
        return $this->belongsTo('App\Models\ReviewClassModel', 'user_id', 'user_id')->withTrashed();
    }
}
