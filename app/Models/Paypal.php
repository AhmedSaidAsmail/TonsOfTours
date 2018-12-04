<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
    protected $fillable = [
        'sandbox', 'client_id', 'secret', 'description'
    ];
}
