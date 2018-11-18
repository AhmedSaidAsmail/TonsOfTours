<?php
namespace App\MyModels\Admin;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model {

    protected $fillable = ['item_id', 'txt', 'started_at', 'ended_at', 'availability'];
    public function item() {
        $this->belongsTo('App\MyModels\Admin\Item');
    }

}