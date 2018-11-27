<?php

namespace App\Models;

use App\User;

class Customer extends User
{
    protected $fillable = ['name', 'email', 'password', 'confirm', 'newsletter'];

    public function information()
    {
        return $this->hasOne(Customer_information::class);
    }

    public function wish_lists()
    {
        return $this->hasMany(WishList::class);
    }

    public function credits()
    {
        return $this->hasMany(CreditCard::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
