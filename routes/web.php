<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Auth::routes();


if (str_contains(Request::path(), 'cms@dmin')) {
    require base_path('routes/cms.php');
}


Route::get('/', 'HomeController@index');
Route::get('/search', 'SearchController@index');
Route::get('/{slug}/c{cate_id}', 'ProductController@productCate');
Route::get('/{slug}_p{id}.html', 'ProductController@productshow');
Route::get('/test', 'HomeController@test');
Route::post('/cart/add-to-cart', 'CartController@addToCart');
Route::get('/cart', 'CartController@index');
Route::post('/cart/update', 'CartController@update');
Route::post('/cart/delete', 'CartController@destroy');
Route::get('/shipping', 'ShippingController@form_create');
Route::post('/shipping', 'ShippingController@store');
Route::get('/order-checkout','CartController@checkout');
Route::post('/order-checkout','CartController@checkout_store');
Route::get('/order-done','CartController@done');

Route::post('/upload/upload_image', 'UploadController@upload_image');
Route::post('/upload/upload_photos', 'UploadController@upload_photos');
Route::post('/photo/photo_delete', 'UploadController@photo_delete');



