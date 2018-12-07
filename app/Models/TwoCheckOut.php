<?php

namespace App\Models;

use Payment\Models\PaymentGateway;

class TwoCheckOut extends PaymentGateway
{
    protected $fillable = [
        'partner_id',
        'public_key',
        'private_key',
        'ssl',
        'sandbox'
    ];
}
