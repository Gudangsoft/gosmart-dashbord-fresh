<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventRegisted extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getEvent()
    {
        return $this->belongsTo('App\Models\Event', 'event_id', 'id')->withTrashed();
    }
}
