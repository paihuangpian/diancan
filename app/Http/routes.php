<?php

Route::group(['middleware' => ['web']], function () {
    // 后台管理
	Route::group(['prefix' => 'nicaibudaohoutai', 'middleware' => 'autha'], function(){

	    Route::get('/', 'AdminController@index');

	    Route::group(['prefix' => 'menus'], function(){
	    	Route::get('/', ['as' => 'menus', 'uses' => 'AdminController@getMenus']);
	    	Route::get('addMenu', ['as' => 'addMenu', 'uses' => 'AdminController@addMenu']);
	    	Route::post('postMenu', ['as' => 'postMenu', 'uses' => 'AdminController@postMenu']);
	    	Route::get('delMenu', ['as' => 'delMenu', 'uses' => 'AdminController@delMenu']);
	    	Route::get('tmenu', ['as' => 'tmenu', 'uses' => 'AdminController@tMenu']);
	    	Route::post('tmenu', ['as' => 'postTmenu', 'uses' => 'AdminController@postTmenu']);
	    	Route::get('delTmenu', ['as' => 'delTmenu', 'uses' => 'AdminController@delTmenu']);
	    });

	    Route::group(['prefix' => 'order'], function(){

	    	Route::get('am', ['as' => 'am', function(){
				$amOrders = \DB::select('select * from orders where type = ? and created_at = ?', [0, date('Y-m-d')]);
				return $amOrders ? view('admin.am', ['amOrders' => $amOrders]) : view('admin.am');
			}]);

			Route::get('pm', ['as' => 'pm', function(){
				$pmOrders = \DB::select('select * from orders where type = ? and created_at = ?', [1, date('Y-m-d')]);
				return $pmOrders ? view('admin.pm', ['pmOrders' => $pmOrders]) : view('admin.pm');
			}]);

	    	Route::get('addOrder', ['as' => 'addOrder', function(){
	    		$type = $_GET['type'];
	    		$tmenus = \DB::table('tmenus')->get();
	    		return view('admin.order.create', ['type' => $type, 'tmenus' => $tmenus]);
	    	}]);

	    	Route::post('addOrder', ['as' => 'postOrder', 'uses' => 'AdminController@postOrder']);
	    	Route::get('delOrder', ['as' => 'delOrder', 'uses' => 'AdminController@delOrder']);

	    	Route::get('export', ['as' => 'export', 'uses' => 'AdminController@export']);
	    });

	    Route::group(['prefix' => 'users'], function(){
	    	Route::get('/', ['as' => 'users', 'uses' => 'AdminController@users']);
	    	Route::get('delUser', ['as' => 'delUser', 'uses' => 'AdminController@delUser']);
	    	Route::get('userOrders', ['as' => 'userOrders', 'uses' => 'AdminController@userOrders']);
	    });

	    Route::group(['prefix' => 'settlement'], function(){
	    	Route::get('/', ['as' => 'settlement', 'uses' => 'AdminController@overview']);
	    	Route::get('last', ['as' => 'lastMonth', 'uses' => 'AdminController@lastMonth']);
	    	Route::get('current', ['as' => 'currentMonth', 'uses' => 'AdminController@currentMonth']);

	    	Route::get('exportLast', ['as' => 'exportLast', 'uses' => 'AdminController@exportLast']);
	    	Route::get('exportCurrent', ['as' => 'exportCurrent', 'uses' => 'AdminController@exportCurrent']);
	    });
	});

	// 点餐
	Route::auth();
	Route::get('/home', function(){
		return redirect('/');
	});
	Route::get('/', ['middleware' => 'auth', 'uses' => 'HomeController@index']);
	Route::post('/', ['as' => 'homeOrder', 'uses' => 'HomeController@homeOrder']);

	Route::get('api', function(){
		$tmenus = \DB::table('tmenus')->get();
	    return response()->json($tmenus);
	});

	Route::get('apiToken', function(){
		$token = csrf_token();
	    return response()->json(['token' => $token]);
	});

	Route::post('apiOrder', 'HomeController@homeOrderApi');
});

// return \Carbon\Carbon::now();