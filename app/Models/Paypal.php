<?php

namespace App\Models;

use Payment\Models\PaymentGateway;

class Paypal extends PaymentGateway
{
    protected $fillable = [
        'sandbox',
        'client_id',
        'secret',
        'description'
    ];

}
