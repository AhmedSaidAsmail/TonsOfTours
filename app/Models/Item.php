<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model implements ProductInterface
{
    protected $fillable = [
        'category_id',
        'name',
        'arrangement',
        'title',
        'status',
        'recommended',
        'keywords',
        'description',
        'img',
        'intro',
        'offer'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function details()
    {
        return $this->hasOne(ItemsDetail::class);
    }

    public function price()
    {
        return $this->hasOne(Price::class);
    }

    public function packages()
    {
        return $this->hasMany(PricePackage::class);
    }

    public function exploration()
    {
        return $this->hasOne(Exploration::class);
    }

    public function includes()
    {
        return $this->hasMany(Inclusion::class);
    }

    public function excludes()
    {
        return $this->hasMany(Exclusion::class);
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }

    public function delete()
    {
        $this->price()->delete();
        $this->details()->delete();
        $this->packages()->delete();
        $this->exploration()->delete();
        $this->includes()->delete();
        $this->excludes()->delete();
        return parent::delete();
    }
}
