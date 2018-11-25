<?php
Route::get('/error404', ['uses' => 'Web\HomeController@error404'])->name('error.404');
Route::get('/', ['uses' => 'FrontEnd\FrontEndController@welcomePage'])->name('home');
Route::get('/search/tours', ['uses' => 'FrontEnd\FrontEndController@searchTours'])->name('home.search');
Route::get('/main/{name}/{id}', ['uses' => 'FrontEnd\FrontEndController@mainCategoryShow'])->name('home.mainCategory.show');
Route::get('category/{name}/{id}', ['uses' => 'FrontEnd\FrontEndController@categoryShow'])->name('home.category.show');
Route::get('/{category}/tour/{name}/{id}', ['uses' => 'FrontEnd\FrontEndController@itemShow'])->name('home.item.show');
Route::post('cart/check/availability/{id}', ['uses' => 'FrontEnd\CartController@checkAvailability'])->name('cart.availability');
Route::post('cart/store', ['uses' => 'FrontEnd\CartController@store'])->name('cart.store');
Route::get('cart/all', ['uses' => 'FrontEnd\CartController@index'])->name('cart.index');
Route::get('cart/checkout', ['uses' => 'FrontEnd\CartController@checkout'])->name('cart.checkout');
Route::post('cart/checkout', ['uses' => 'FrontEnd\CartController@checkoutDone'])->name('cart.checkout');
Route::get('cart/remove/items/{key}', ['uses' => 'FrontEnd\CartController@itemRemove'])->name('cart.item.remove');
Route::get('wish-list/store/{item_id}', 'FrontEnd\WishListController@store')->name('wish-list.store');
Route::get('wish-list/all', 'FrontEnd\WishListController@index')->name('wish-list.index');
Route::get('wish-list/remove/{id}', 'FrontEnd\WishListController@destroy')->name('wish-list.destroy');

//Route::get('/allTours', ['uses' => 'Web\HomeController@allTours'])->name('allTours.show');
Route::get('/topics/{topicsName}', ['uses' => 'Web\HomeController@topicsShow'])->name('topics.show');

//Route::post('/add-to-cart/{id}', ['uses' => 'Web\HomeController@addToCart'])->name('add.to.cart');
//Route::post('/add-transfer-to-cart', ['uses' => 'Web\HomeController@addTransferToCart'])->name('add.transfer.to.cart');
//Route::get('my-cart', ['uses' => 'Web\HomeController@cartShow'])->name('cart');
//route::get('/my-cart/remove/{id}', ['uses' => 'Web\HomeController@removeFromCart'])->name('remove.from.cart');
//Route::get('/my-cart/check-out', ['uses' => 'Web\HomeController@checkOut'])->name('Web.checkout');
//Route::post('/my-cart/fianlCheckOut', ['uses' => 'Web\HomeController@finalCheckOut'])->name('finalCheckOut');
//Route::get('/search-items/result', ['uses' => 'Web\HomeController@searchItems'])->name('Web.searchItems');
//Route::get('/search-transfer-dist', ['uses' => 'Web\HomeController@searchDist'])->name('searchDist');
//Route::get('/booking-done', ['uses' => 'Web\HomeController@bookingDone'])->name('bookingDone');
//Route::get('/getDays/{id}', ['uses' => 'Web\HomeController@getDays'])->name('getDays');
//Route::get('/hotDeals', ['uses' => 'Web\HomeController@hotDealsShow'])->name('hotDeals');
//Route::get('/transfer', ['uses' => 'Web\HomeController@transferShow'])->name('transfersShow');
// customer login
Route::get('/customer/register', 'AuthCustomer\RegisterController@showRegistrationForm')->name('customer.register');
Route::post('/customer/register', 'AuthCustomer\RegisterController@register')->name('customer.register');
Route::post('/customer/login', 'AuthCustomer\LoginController@login')->name('customer.login');
Route::get('/customer/login/social/facebook', 'AuthCustomer\LoginController@facebookLogin')->name('customer.login.facebook');
Route::get('/customer/logout', 'AuthCustomer\LoginController@logout')->name('customer.logout');
Route::group(['middleware' => 'auth:customer'], function () {
    Route::get('/customer/settings', 'FrontEnd\CustomerController@showSetting')->name('customer.setting');
    Route::put('/customer/settings', 'FrontEnd\CustomerController@updateSetting')->name('customer.setting');
    Route::get('/customer/password', 'FrontEnd\CustomerController@showPasswordForm')->name('customer.password');
    Route::put('/customer/password', 'FrontEnd\CustomerController@updatePassword')->name('customer.password');
    Route::get('/customer/bookings', 'FrontEnd\CustomerController@showbookings')->name('customer.booking');
});
Route::get('/customer/password/reset', 'AuthCustomer\ResetPasswordController@passwordReset')->name('customer.password.reset');
Route::post('/customer/password/reset', 'AuthCustomer\ResetPasswordController@passwordResetEmail')->name('customer.password.reset');
Route::get('/customer/password/reset/success/{email}/{token}', 'AuthCustomer\ResetPasswordController@passwordResetEmailSuccess')->name('customer.password.reset.success');
Route::get('/customer/password/reset/email/{email}/{unique_id}', 'AuthCustomer\ResetPasswordController@emailBack')->name('customer.password.email.back');


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
    Route::resource('site-visitor','Admin\VisitorsController',['only'=>['index','destroy','show']]);

    //gallery
    Route::resource('/Item/{itemID}/ItemGallery', 'Admin\ItemGalleryController', ['except' => ['show', 'edit', 'update', 'destroy']]);
    Route::delete('/Item/{itemID}/ItemGallery', 'Admin\ItemGalleryController@destroy')->name('ItemGallery.destroy');
    //topics
    Route::resource('/Topics', 'Admin\TopicsController');
    Route::resource('/Topics/{TopicId}/Gallery', 'Admin\GalleryController', ['except' => ['show', 'edit', 'update', 'destroy']]);
    Route::delete('/Item/{itemID}/Gallery', 'Admin\GalleryController@destroy')->name('Gallery.destroy');
    Route::resource('/Articles', 'Admin\ArticlesController');
    Route::resource('/leftsSide', 'Admin\LeftSideController');
    Route::resource('/vars', 'Admin\VarsController');
    Route::resource('/Transfers', 'Admin\TransferController');
    Route::resource('/Paypal', 'Admin\PaypalController');
    Route::resource('/Reservation', 'Admin\ReservationController');
});

//Auth::routes();

