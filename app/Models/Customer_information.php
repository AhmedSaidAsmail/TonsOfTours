<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer_information extends Model
{
    protected $table = "customer_information";
    protected $fillable = ['customer_id', 'phone', 'address', 'city', 'country'];
}
