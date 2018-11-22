<?php

use App\Models\MainCategory;
use App\Models\Category;
use App\Http\Controllers\Admin\VarsController;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Src\Sync\Sync;
use App\Models\Item;
use App\Src\SocialMedia\FacebookLogin\FacebookSdk;
use App\Src\WishList\WishList;

if (!function_exists('activeMainCategories')) {
    function activeMainCategories($limit = 4)
    {
        return MainCategory::where('home', '=', '1')
            ->limit($limit)
            ->orderBy('arrangement', 'desc')
            ->get();
    }
}
if (!function_exists('mainCategoriesAll')) {
    function mainCategoriesAll()
    {
        return MainCategory::all();
    }
}
if (!function_exists('categoriesAll')) {
    function categoriesAll()
    {
        return Category::all();
    }
}
if (!function_exists('topTours')) {
    function topTours()
    {
        return Item::where('recommended', 1)
            ->where('status', 1)
            ->orderBy('arrangement')
            ->limit(6)
            ->get();
    }
}
if (!function_exists('translate')) {
    function translate($word)
    {
        return VarsController::translate($word);
    }
}
if (!function_exists('getValue')) {
    function getValue($attr, Item $item = null, $hasOne = null)
    {
        $return = null;
        if (!is_null($item)) {
            $return = $item;
            if (!is_null($hasOne)) {
                $return = $return->$hasOne;
            }
            return $return->$attr;
        }

    }
}
if (!function_exists('itemValueResolve')) {
    function itemValueResolve($attr, Item $item = null, $hasOne = null)
    {
        if (!is_null($item)) {
            return !is_null($hasOne) && !is_null($item->{$attr}) ? $item->{$attr}->{$hasOne} : $item->{$attr};
        }
        return null;

    }
}
if (!function_exists('syncHasMany')) {
    function syncHasMany(HasMany $hasMany, array $data, $key)
    {
        return new Sync($hasMany, $data, $key);
    }
}
if (!function_exists('facebookLink')) {
    function facebookLink()
    {
        return FacebookSdk::linkGeneration();
    }
}
if (!function_exists('wishListsCount')) {
    function wishListsCount()
    {
        $wishList = new WishList();
        return count($wishList->all());
    }
}