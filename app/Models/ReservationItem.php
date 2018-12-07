<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationItem extends Model
{
    protected $fillable = [
        'reservation_id',
        'item_id',
        'date',
        'st_num',
        'st_price',
        'st_name',
        'sec_num',
        'sec_price',
        'sec_name',
        'total',
        'deposit'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
