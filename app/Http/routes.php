<?php

// 后台管理
Route::get('admin', 'AdminController@index');

Route::group(['middleware' => ['web']], function () {
    //
});
