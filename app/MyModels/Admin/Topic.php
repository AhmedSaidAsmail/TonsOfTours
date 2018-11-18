<?php
namespace App\MyModels\Admin;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model {

    protected $fillable = ['name', 'title', 'txt', 'keywords', 'description', 'icon', 'top', 'footer', 'sidebar', 'top_link', 'footer_link', 'sidebar_link', 'arrangement'];
    public function Topics_text() {
        return $this->hasOne(Topics_text::class);
    }
    public function topics_image() {
        return $this->hasMany(topics_image::class);
    }
    public function delete() {
        $this->Topics_text()->delete();
        return parent::delete();
    }

}