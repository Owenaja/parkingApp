<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'balance'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function transactions() {
        return $this->hasMany('App\Transaction');
    }

    public function wallets() {
        return $this->hasMany('App\WalletTransaction');
    }

}
