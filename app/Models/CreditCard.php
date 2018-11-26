<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $fillable = [
        'customer_id', 'name', 'cc_no', 'cc_expire_month', 'cc_expire_year', 'ccv', 'country'
    ];
}
