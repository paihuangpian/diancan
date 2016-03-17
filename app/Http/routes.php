<?php

// 后台管理
Route::group(['prefix' => 'admin'], function(){

    Route::get('/', 'AdminController@index');

    Route::group(['prefix' => 'menus'], function(){
    	Route::get('/', ['as' => 'menus', 'uses' => 'AdminController@getMenus']);
    	Route::get('addMenu', ['as' => 'addMenu', 'uses' => 'AdminController@addMenu']);
    	Route::post('postMenu', ['as' => 'postMenu', 'uses' => 'AdminController@postMenu']);
    });

	Route::get('am', ['as' => 'am', function(){
		$amOrders = \DB::table('orders')->get();
		return $amOrders ? view('admin.am', ['amOrders' => $amOrders]) : view('admin.am');
	}]);
});

Route::group(['middleware' => ['web']], function () {
    //
});

// return \Carbon\Carbon::now();