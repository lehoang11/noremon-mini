<?php

Route::group(['prefix' => 'cms@dmin', 'middleware' => ['auth','backend.admin'], 'namespace' => 'Cms'], function() {

    Route::get('dashbroad', 'DashbroadController@index')->name('dashbroad');

    //Route::resource('menu', 'MenuController');
    Route::get('menu/{module}', 'MenuController@index');
    Route::get('menu/{module}/create', 'MenuController@create');
    Route::post('menu/{module}/create', 'MenuController@store');
    Route::get('menu/{module}/{id}/edit', 'MenuController@edit');
    Route::post('menu/{module}/{id}/edit', 'MenuController@update');
    Route::get('menu_get/ajax_menu', 'MenuController@ajax_menu');

    Route::get('role/{module}', 'RoleController@index');
    Route::get('role/{module}/create', 'RoleController@create');
    Route::post('role/{module}/create', 'RoleController@store');
    Route::get('role/{module}/{id}/edit', 'RoleController@edit');
    Route::post('role/{module}/{id}/edit', 'RoleController@update');

    Route::get('admin/{module}', 'AdminController@index');
    Route::get('admin/{module}/create', 'AdminController@create');
    Route::post('admin/{module}/create', 'AdminController@store');
    Route::get('admin/{module}/{user_id}/{role_id}/edit', 'AdminController@edit');
    Route::post('admin/{module}/{user_id}/{role_id}/edit', 'AdminController@update');
    Route::get('admin/{user_id}/{role_id}/delete', 'AdminController@destroy');

    Route::get('category', 'CategoryController@index');
    Route::get('category/create', 'CategoryController@create');
    Route::post('category/create', 'CategoryController@store');
    Route::get('category/{id}/edit', 'CategoryController@edit');
    Route::post('category/{id}/edit', 'CategoryController@update');
    Route::get('category/{id}/delete', 'CategoryController@destroy');
    Route::get('ajax_getcategory', 'CategoryController@ajax_category');

    Route::get('product', 'ProductController@index');
    Route::get('product/create', 'ProductController@create');
    Route::post('product/create', 'ProductController@store');
    Route::get('product/{id}/edit', 'ProductController@edit');
    Route::post('product/{id}/edit', 'ProductController@update');
    Route::get('product/{id}/delete', 'ProductController@destroy');
    Route::get('product-photo-delete', 'ProductController@photo_product_delete');


});

?>
