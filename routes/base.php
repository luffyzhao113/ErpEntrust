<?php
/**
 * Base系统api
 * User: luffyzhao
 * Date: 2018/6/18
 * Time: 20:54
 */

Route::post('auth', 'AuthController@store')->name('login');

Route::group(['middleware' => 'auth'], function (){
    Route::get('auth', 'AuthController@index');
    Route::get('auth/permission', 'AuthController@permission');
    Route::put('auth', 'AuthController@update')->name('auth.update');
    Route::put('auth/user', 'AuthController@user')->name('auth.user');
    Route::put('auth/photo', 'AuthController@photo')->name('auth.photo');
    Route::delete('auth', 'AuthController@destroy')->name('auth.destroy');
    Route::delete('auth/lock', 'AuthController@lock')->name('auth.lock');
    Route::get('auth/logs', 'AuthController@logs');
    Route::get('auth/message/not-read', 'Auth\MessageController@notRead');
    Route::apiResource('auth/message', 'Auth\MessageController');

    Route::get('role/select', 'RoleController@select');
    Route::get('admin/select', 'AdminController@select');
    Route::post('file', 'FileController@store')->name('file.store');

    Route::group(['middleware' => ['entrust:base']], function (){
        Route::apiResource('permission', 'PermissionController');
        Route::apiResource('role', 'RoleController');

        Route::get('role/{role}/permission', 'Role\PermissionController@index')->name('role.permission.index');
        Route::post('role/{role}/permission', 'Role\PermissionController@store')->name('role.permission.store');

        Route::apiResource('admin', 'AdminController');

        Route::get('logs', 'LogsController@index')->name('logs.index');
    });

});


