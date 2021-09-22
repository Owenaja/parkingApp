<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkingSlot extends Model
{
    protected $fillable = [
        'name', 'location', 'status'
    ];

    public function transactions() {
        return $this->hasMany('App\Transaction');
    }
}
