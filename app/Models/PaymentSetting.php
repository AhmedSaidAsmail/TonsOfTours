<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $fillable = [
        'default_percentage', 'currency', 'currency_symbol'
    ];
}
