<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table = 'wish_lists';
    protected $fillable = ['customer_id', 'item_id'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
