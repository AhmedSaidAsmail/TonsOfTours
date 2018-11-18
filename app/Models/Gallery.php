<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = "itemsgallries";
    protected $fillable = ['item_id', 'img'];

}