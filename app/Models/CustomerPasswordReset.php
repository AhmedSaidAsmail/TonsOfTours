<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPasswordReset extends Model
{
    protected $fillable=['email','unique_id'];
}
