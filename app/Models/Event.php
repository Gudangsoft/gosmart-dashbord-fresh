<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'events';

    protected $guarded = [];


    public function getUser()
    {
        return $this->belongsTo('App\User', 'created_by', 'id')->withTrashed();
    }

    public function getCategory()
    {
        return $this->belongsTo('App\Models\ClassCategory', 'category_id', 'id')->withTrashed();
    }

    public function getCountAttribute()
    {
        return EventRegisted::where('event_id', $this->id)->get()->count();
    }
}
