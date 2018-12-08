<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{

    protected $fillable = [
        'name',
        'title',
        'txt',
        'keywords',
        'description',
        'icon',
        'top',
        'footer',
        'top_link',
        'footer_link',
        'arrangement'
    ];


    public function delete()
    {
        return parent::delete();
    }

}