<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table = 'main_categories';
    protected $fillable = ['name', 'arrangement', 'title', 'status', 'home', 'keywords', 'description', 'img', 'icon'];

    public function categories()
    {
        return $this->hasMany(Category::class, 'main_category_id');
    }

    public function items()
    {
        return $this->hasManyThrough(Item::class, Category::class, 'main_category_id', 'category_id');
    }
}
