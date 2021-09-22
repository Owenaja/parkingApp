<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $fillable = [
        'type', 'user_id', 'customer_id', 'slot_id', 'lisencese_number', 'duration', 'time_in', 'real_time_in', 'time_out', 'real_time_out', 'status', 'total_price'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function slot()
    {
        return $this->belongsTo('App\ParkingSlot');
    }
}
