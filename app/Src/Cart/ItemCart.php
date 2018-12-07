<?php

namespace App\Src\Cart;

class ItemCart extends Product
{
    protected $fillable = [
        'model',
        'item_id',
        'title',
        'date',
        'st_num',
        'st_price',
        'st_name',
        'sec_num',
        'sec_price',
        'sec_name',
    ];
    protected $reservationData = [
        'item_id',
        'title',
        'date',
        'st_num',
        'st_price',
        'st_name',
        'sec_num',
        'sec_price',
        'sec_name',
        'total',
        'deposit'
    ];


}