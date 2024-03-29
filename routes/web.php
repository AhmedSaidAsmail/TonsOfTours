<?php
Route::get('/error404', 'FrontEnd\FrontEndController@notFound')->name('home.error.404');
Route::get('/', ['uses' => 'FrontEnd\FrontEndController@welcomePage'])->name('home');
Route::get('/search/tours', ['uses' => 'FrontEnd\FrontEndController@searchTours'])->name('home.search');
Route::get('/main/{name}/{id}',
    ['uses' => 'FrontEnd\FrontEndController@mainCategoryShow'])->name('home.mainCategory.show');
Route::get('category/{name}/{id}', ['uses' => 'FrontEnd\FrontEndController@categoryShow'])->name('home.category.show');
Route::get('/{category}/tour/{name}/{id}', ['uses' => 'FrontEnd\FrontEndController@itemShow'])->name('home.item.show');
Route::get('/topics/{name}', ['uses' => 'FrontEnd\FrontEndController@topicShow'])->name('home.topic.show');
Route::post('cart/check/availability/{id}', ['uses' => 'FrontEnd\CartController@checkAvailability'])
    ->name('cart.availability');
// Shopping Cart
Route::get('cart/all', ['uses' => 'FrontEnd\CartController@index'])->name('cart.index');
Route::post('cart/store', ['uses' => 'FrontEnd\CartController@store'])->name('cart.store');
Route::get('cart/remove/{collection}/{key}', 'FrontEnd\CartController@itemRemove')->name('cart.item.remove');
// Shopping Cart Checkout
Route::get('cart/checkout', ['uses' => 'FrontEnd\CartController@checkout'])->name('cart.checkout');
Route::post('cart/checkout', ['uses' => 'FrontEnd\CartController@checkoutDone'])->name('cart.checkout');
Route::get('cart/checkout/response/{res_id}/{unique_id}', 'FrontEnd\CartController@checkoutResponse')
    ->name('cart.checkout.response');
// Wish list
Route::get('wish-list/all', 'FrontEnd\WishListController@index')->name('wish-list.index');
Route::get('wish-list/store/{item_id}', 'FrontEnd\WishListController@store')->name('wish-list.store');
Route::get('wish-list/remove/{id}', 'FrontEnd\WishListController@destroy')->name('wish-list.destroy');
// customer login and Register
Route::get('/customer/register', 'AuthCustomer\RegisterController@showRegistrationForm')->name('customer.register');
Route::post('/customer/register', 'AuthCustomer\RegisterController@register')->name('customer.register');
Route::post('/customer/login', 'AuthCustomer\LoginController@login')->name('customer.login');
Route::get('/customer/login/social/facebook/redirect', 'AuthCustomer\LoginController@facebookRedirect')
    ->name('customer.facebook.redirect');
Route::get('_oauth/facebook', 'AuthCustomer\LoginController@facebookLogin')
    ->name('customer.facebook.login');
Route::get('/customer/logout', 'AuthCustomer\LoginController@logout')->name('customer.logout');
// Customers Dashboard
Route::group(['middleware' => 'auth:customer'], function () {
    Route::get('/customer/settings', 'FrontEnd\CustomerController@showSetting')->name('customer.setting');
    Route::put('/customer/settings', 'FrontEnd\CustomerController@updateSetting')->name('customer.setting');
    Route::get('/customer/password', 'FrontEnd\CustomerController@showPasswordForm')->name('customer.password');
    Route::put('/customer/password', 'FrontEnd\CustomerController@updatePassword')->name('customer.password');
    Route::get('/customer/bookings', 'FrontEnd\CustomerController@showbookings')->name('customer.booking');
});
// Customer Reset Password
Route::get('/customer/password/reset',
    'AuthCustomer\ResetPasswordController@passwordReset')->name('customer.password.reset');
Route::post('/customer/password/reset',
    'AuthCustomer\ResetPasswordController@passwordResetEmail')->name('customer.password.reset');
Route::get('/customer/password/reset/success/{email}/{token}',
    'AuthCustomer\ResetPasswordController@passwordResetEmailSuccess')->name('customer.password.reset.success');
Route::get('/customer/password/reset/email/{email}/{unique_id}',
    'AuthCustomer\ResetPasswordController@emailBack')->name('customer.password.email.back');


Route::get('/profile/my-bookings', 'Auth_Customer\ProfileController@bookings')->name('customer.bookings');
//Route::get('/profile/my-bookings/items/{reservation_id}', 'Auth_Customer\ProfileController@bookingsItems')->name('customer.bookings.items');
// end customers login

//Route::get('images/update','Admin\ImagesController@update');


Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::group(['prefix' => 'admin', 'middleware' => 'auth:web'], function () {
    Route::get('', function () {
        return view('Admin.Welcome');
    })->name('welcome');
    route::get('/Error505', function () {
        return view('Admin.Error500');
    })->name('Error505');
    Route::resource('/mainCategory', 'Admin\MainCategoriesController', ['expect' => ['create', 'show']]);
    Route::resource('category', 'Admin\CategoriesController', ['except' => ['create', 'show']]);
    Route::resource('/item', 'Admin\ItemsController');
    Route::delete('images/destroy','Admin\ImagesController@destroy')->name('images.destroy');
    Route::resource('images','Admin\ImagesController',['except'=>'destroy']);
    Route::resource('site-visitor', 'Admin\VisitorsController', ['only' => ['index', 'destroy', 'show']]);

    //gallery
    Route::resource('/Item/{itemID}/ItemGallery', 'Admin\ItemGalleryController',
        ['except' => ['show', 'edit', 'update', 'destroy']]);
    Route::delete('/Item/{itemID}/ItemGallery', 'Admin\ItemGalleryController@destroy')->name('ItemGallery.destroy');
    Route::delete('/Item/{itemID}/Gallery', 'Admin\GalleryController@destroy')->name('Gallery.destroy');


    Route::resource('/topics', 'Admin\TopicsController', ['expect' => ['show']]);
    Route::resource('/vars', 'Admin\VarsController');
    Route::resource('/Paypal', 'Admin\PaypalController');
    Route::resource('/reservation', 'Admin\ReservationController', ['expect' => ['edit', 'destroy']]);
    Route::get('/reservation/items/archive', 'Admin\ReservationController@indexArchive')->name('reservation.archive');
    Route::put('/reservation/items/archive', 'Admin\ReservationController@archive')->name('reservation.archive');
    Route::get('/profile/change-details', 'Admin\ProfileController@showProfileForm')->name('admin.profile.edit');
    Route::put('/profile/change-details', 'Admin\ProfileController@update')->name('admin.profile.update');
    Route::resource('settings/payment/payment-setting', 'Admin\PaymentSettingController', [
        'as' => 'setting.payment',
        'except' => ['create', 'edit', 'show']
    ]);
    Route::resource('settings/payment/paypal', 'Admin\PaymentPaypalController', [
        'as' => 'setting.payment',
        'except' => ['index', 'create', 'edit', 'show']
    ]);
    Route::resource('settings/payment/two-checkout', 'Admin\PaymentTwoCheckoutController', [
        'as' => 'setting.payment',
        'except' => ['index', 'create', 'edit', 'show']
    ]);

});

