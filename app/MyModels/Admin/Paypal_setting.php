<?php
namespace App\MyModels\Admin;

use Illuminate\Database\Eloquent\Model;

class Paypal_setting extends Model {

    protected $fillable = ['acount_id', 'secret_id', 'pay_percentage'];

}