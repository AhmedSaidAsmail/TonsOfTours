<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorPage extends Model
{
    protected $fillable = ['visitor_id', 'item_id', 'url', 'title'];

    public function items()
    {
        return $this->hasManyThrough(Item::clas, VisitorPage::class);
    }
}
