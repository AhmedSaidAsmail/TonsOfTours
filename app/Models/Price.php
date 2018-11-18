<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['item_id', 'st_price', 'sec_price', 'st_name', 'sec_name'];
    
}