<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwoCheckOut extends Model
{
    protected $fillable = [
        'partner_id', 'public_key', 'private_key', 'ssl', 'sandbox','currency'
    ];
}
