<?php
namespace App\MyModels\Admin;

use Illuminate\Database\Eloquent\Model;

class topics_image extends Model {

    protected $fillable = ['topic_id', 'img', 'created_at', 'updated_at'];
    public function topic() {
        return $this->belongsTo(Topic::class);
    }

}