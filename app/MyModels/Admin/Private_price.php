<?php
namespace App\MyModels\Admin;

use Illuminate\Database\Eloquent\Model;

class Private_price extends Model {

    protected $fillable = ['item_id', 'sort', 'pax_1', 'pax_2', 'pax_3', 'pax_4', 'pax_10', 'pax_18'];
    public function item() {
        return $this->belongsTo(Item::class);
    }

}