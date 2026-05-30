<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class view_stream extends Model
{
    use SoftDeletes;

    protected $table = "view_stream";
    protected $fillable = ['id','id_user', 'slug', 'chanel_id', 'class_id', 'link','judul','keterangan','premium', 'status', 'level', 'gambar','kategori','created_at','update_at', 'deteleted_at'];
    protected $dates = ['deleted_at'];

    public function chanel(){
        return $this->belongsTo('App\chanel', 'chanel_id', 'id');
    }
    public function getLevel(){
        return $this->belongsTo('App\Models\Level', 'level', 'id')->withTrashed();
    }
    public function getClass(){
        return $this->belongsTo('App\Models\ClassMenu', 'class_id', 'class_id')->withTrashed();
    }
}
