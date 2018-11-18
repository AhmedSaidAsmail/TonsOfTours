<?php
namespace App\MyModels\Admin;

use Illuminate\Database\Eloquent\Model;

class Sort extends Model {

    protected $fillable = ['basicsort_id', 'name', 'arrangement', 'title', 'icon', 'slogan', 'slogan2', 'status', 'recommended', 'keywords', 'description', 'img'];
    public function basicsort() {
        return $this->belongsTo(\App\MyModels\Admin\Basicsort::class);
    }
    public function items() {
        return $this->hasMany(\App\MyModels\Admin\Item::class);
    }
    public function delete() {
        $this->items()->delete();
        return parent::delete();
    }

}