<?php
namespace App\MyModels\Admin;

use Illuminate\Database\Eloquent\Model;

class Basicsort extends Model {

    protected $fillable = ['name', 'arrangement', 'title', 'status', 'home', 'keywords', 'description', 'img', 'icon'];
    // protected $guarded=['name'];
    //protected $hidden=[ 'remember_token',];
    public function sorts() {
        return $this->hasMany(\App\MyModels\Admin\Sort::class);
    }
    public function items() {
        return $this->hasManyThrough(\App\MyModels\Admin\Item::class, \App\MyModels\Admin\Sort::class);
    }
    public function delete() {
        $this->sorts()->delete();
        return parent::delete();
    }

}