<?php
namespace App\MyModels\Admin;

use Illuminate\Database\Eloquent\Model;

class res_transfer extends Model {

    protected $fillable = ['reservation_id', 'title', 'price', 'date', 'dist_from', 'dist_to', 'transfer_type', 'transfer_times', 'pax'];
    public function reservation() {
        return $this->belongsTo(App\MyModels\Admin\Reservation::class);
    }

}