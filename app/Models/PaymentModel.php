<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentModel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'bank_name',
        'no_rekening',
        'owner_name',
        'note',
    ];
    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->withTrashed();
    }
}
