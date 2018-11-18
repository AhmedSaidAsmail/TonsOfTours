<?php
namespace App\MyModels\Admin;

use Illuminate\Database\Eloquent\Model;

class Dresse extends Model {

    protected $fillable = ['item_id', 'txt'];
    public function item() {
        $this->belongsTo('App\MyModels\Admin\Item');
    }

}