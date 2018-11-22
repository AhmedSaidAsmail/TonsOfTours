<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemsDetail extends Model
{
    protected $fillable = [
        'item_id', 'duration', 'has_deposit', 'deposit_percentage'
    ];
}
