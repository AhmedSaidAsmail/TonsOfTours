<?php

namespace Payment\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    public function getAllAttr()
    {
        return $this->attributes;
    }
}