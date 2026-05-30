<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WithdrawModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'withdraw_total',
        'accept_by',
        'status'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id')->withTrashed();
    }

    public function acceptBy(){
        return $this->belongsTo('App\User', 'accept_by', 'id')->withTrashed();
    }

    public function getPayment(){
        return $this->belongsTo('App\Models\PaymentModel', 'user_id', 'user_id')->withTrashed();
    }
}
