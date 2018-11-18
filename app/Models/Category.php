<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $fillable = [
        'main_category_id',
        'name',
        'arrangement',
        'title',
        'status',
        'recommended',
        'keywords',
        'description',
        'img'];

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'main_category_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
