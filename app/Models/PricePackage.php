<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricePackage extends Model
{
    protected $table = 'price_packages';
    protected $fillable = ['item_id', 'min', 'max', 'st_price', 'sec_price'];
}
