<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $fillable = [
        'user_id', 'customer_id', 'date', 'type', 'balance'
    ];
    
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
