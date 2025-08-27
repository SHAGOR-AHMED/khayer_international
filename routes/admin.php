<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/

Route::group([ 'middleware' => ['auth', 'user-access:admin']], function(){

	Route::group(['namespace' => '\App\Http\Controllers\Admin'],function(){

        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.home');

        /*---Administration User---*/
        Route::prefix('/user')->name('user.')->group(function(){
			Route::get('/index',            'UserController@index')->name('index');
            Route::get('create',            'UserController@create')->name('add');
			Route::post('store',            'UserController@store')->name('store');
            Route::get('edit/{user_id}',    'UserController@edit')->name('edit');
			Route::post('update',           'UserController@update')->name('update');
            Route::get('status/{user_id}',  'UserController@status')->name('control');
			Route::get('delete/{user_id}',  'UserController@delete')->name('delete');
			Route::post('updatePassword',   'UserController@updatePassword')->name('update-password');
		});

		/*---Agent---*/
		Route::namespace('Agent')->prefix('/agent')->name('agent.')->group(function(){
			Route::get('/index',                'IndexController@index')->name('index');
			Route::get('/create',               'IndexController@create')->name('add');
			Route::post('/store',               'IndexController@store')->name('store');
			Route::get('/edit/{id}',            'IndexController@edit')->name('edit');
			Route::post('/update',              'IndexController@update')->name('update');
			Route::get('/status/{id}',          'IndexController@status')->name('control');
			Route::get('/delete/{id}',          'IndexController@delete')->name('delete');
		});

		/*---Client---*/
		Route::namespace('Client')->prefix('/client')->name('client.')->group(function(){
			Route::get('/index',                'IndexController@index')->name('index');
			Route::get('/create',               'IndexController@create')->name('add');
			Route::post('/store',               'IndexController@store')->name('store');
			Route::get('edit/{user_id}',        'IndexController@edit')->name('edit');
			Route::post('/update',              'IndexController@update')->name('update');
			Route::get('/status/{id}',          'IndexController@status')->name('control');
			Route::get('/delete/{id}',          'IndexController@delete')->name('delete');
		});

		/*---Entry---*/
		Route::namespace('Entry')->prefix('/entry')->name('entry.')->group(function(){
			Route::get('/index',                'IndexController@index')->name('index');
			Route::get('/create',               'IndexController@create')->name('add');
			Route::post('/store',               'IndexController@store')->name('store');
			Route::get('/edit/{id}',            'IndexController@edit')->name('edit');
			Route::post('/update',              'IndexController@update')->name('update');
			Route::post('/return_application',  'IndexController@return_application')->name('return_application');
			Route::post('/nextStage',           'IndexController@nextStage')->name('nextStage');
			Route::get('/status/{id}',          'IndexController@status')->name('control');
			Route::get('/details/{id}',         'IndexController@details')->name('details');
			Route::get('/delete/{id}',          'IndexController@delete')->name('delete');
			Route::get('/log',                  'IndexController@log')->name('log');
		});

		/*---Embassy---*/
		Route::namespace('Embassy')->prefix('/embassy')->name('embassy.')->group(function(){
			Route::get('/index',                'IndexController@index')->name('index');
			Route::post('/update',              'IndexController@update')->name('update');
			Route::get('/details/{id}',         'IndexController@details')->name('details');
			Route::get('/log',                  'IndexController@log')->name('log');
		});

		/*---Embassy---*/
		Route::namespace('Manpower')->prefix('/manpower')->name('manpower.')->group(function(){
			Route::get('/index',                'IndexController@index')->name('index');
			Route::post('/update',              'IndexController@update')->name('update');
			Route::get('/details/{id}',         'IndexController@details')->name('details');
			Route::get('/log',                  'IndexController@log')->name('log');
		});

		/*---Delivery---*/
		Route::namespace('Delivery')->prefix('/delivery')->name('delivery.')->group(function(){
			Route::get('/index',                'IndexController@index')->name('index');
			Route::post('/update',              'IndexController@update')->name('update');
			Route::get('/details/{id}',         'IndexController@details')->name('details');
			Route::get('/log',                  'IndexController@log')->name('log');
		});


		
	});


});