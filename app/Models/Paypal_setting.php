<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paypal_setting extends Model
{

    protected $fillable = ['account_id', 'secret_id', 'pay_percentage'];

}