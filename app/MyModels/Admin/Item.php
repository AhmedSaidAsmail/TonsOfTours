<?php
namespace App\MyModels\Admin;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

    protected $fillable = ['sort_id', 'name', 'arrangement', 'title', 'status', 'recommended', 'keywords', 'description', 'img', 'intro', 'offer'];
    public function sort() {
        return $this->belongsTo(\App\MyModels\Admin\Sort::class);
    }
    public function detail() {
        return $this->hasOne(\App\MyModels\Admin\Detail::class);
    }
    public function price() {
        return $this->hasOne(\App\MyModels\Admin\Price::class);
    }
    public function exploration() {
        return $this->hasOne(\App\MyModels\Admin\Exploration::class);
    }
    public function inclusion() {
        return $this->hasMany(\App\MyModels\Admin\Inclusion::class);
    }
    public function exclusion() {
        return $this->hasMany(\App\MyModels\Admin\Exclusion::class);
    }
    public function itemsgallrie() {
        return $this->hasMany(\App\MyModels\Admin\Itemsgallrie::class);
    }
    public function additional() {
        return $this->hasMany(\App\MyModels\Admin\Additional::class);
    }
    public function dresse() {
        return $this->hasMany(\App\MyModels\Admin\Dresse::class);
    }
    public function note() {
        return $this->hasMany(\App\MyModels\Admin\Note::class);
    }
    public function privates() {
        return $this->hasMany(Private_price::class);
    }
    public function delete() {
        $this->price()->delete();
        $this->exploration()->delete();
        $this->inclusion()->delete();
        $this->exclusion()->delete();
        $this->itemsgallrie()->delete();
        $this->dresse()->delete();
        $this->additional()->delete();
        $this->note()->delete();
        return parent::delete();
    }

}