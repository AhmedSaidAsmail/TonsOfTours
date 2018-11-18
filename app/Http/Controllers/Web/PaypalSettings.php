<?php
namespace App\Http\Controllers\Web;

use App\MyModels\Admin\Paypal_setting;

class PaypalSettings {

    public static function percentage() {
        $paypal_setting = Paypal_setting::first();
        return isset($paypal_setting->pay_percentage) ? $paypal_setting->pay_percentage : 0;
    }
    public static function getUser() {
        $paypal_setting = Paypal_setting::first();
        return isset($paypal_setting->acount_id) ? $paypal_setting->acount_id : 0;
    }
    public static function getSecret() {
        $paypal_setting = Paypal_setting::first();
        return isset($paypal_setting->secret_id) ? $paypal_setting->secret_id : 0;
    }

}