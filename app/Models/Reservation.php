<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    protected $fillable = ['unique_id', 'customer_id', 'paymentId', 'orderNumber', 'payment_method', 'approval', 'date', 'total', 'deposit','currency'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(ReservationItem::class);
    }


}