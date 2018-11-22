<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'ip', 'country', 'state', 'city', 'last_visit'
    ];
    public $timestamps = false;

    public function pages()
    {
        return $this->hasMany(VisitorPage::class);
    }
}
