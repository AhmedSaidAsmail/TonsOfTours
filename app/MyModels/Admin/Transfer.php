<?php
namespace App\MyModels\Admin;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model {

    protected $fillable = ['dist_from', 'dist_to', 'type_limousine', 'type_van', 'type_coaster', 'type_bus'];

}