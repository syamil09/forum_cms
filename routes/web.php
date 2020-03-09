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
// Route::get('dataUser',function () {
// 	return view('app.account.user.index');
// });

// Route::get('/','LoginController@cekSession');
Route::get('/',function() {
	return view('app.dashboard');
});
Route::get('token','LoginController@token');
Route::get('home',function () {
	return view('layouts.app');
});

Route::post('signin','LoginController@index');
Route::get('signout','LoginController@logout');
Route::get('cek','LoginController@cekSession');
Route::get('login','LoginController@login');

// ------------------ account -------------------
Route::group(['prefix' => 'account','middleware' => []],function () {

	// ------------------ user -------------------
	Route::group(['prefix' => 'user'],function () {
		session()->put('menu','user');
		Route::get('/','account\UserController@index');
		Route::get('/create','account\UserController@create');
		Route::post('/store','account\UserController@store');
		Route::get('/edit/{id}','account\UserController@edit');
		Route::post('/update/{id}','account\UserController@update');
		Route::post('/delete','account\UserController@delete');
	});
	// ------------------ privileges -------------------
	Route::group(['prefix' => 'privileges'],function () {
		Route::get('/','account\UserPrivilegesController@index');
		Route::get('/create','account\UserPrivilegesController@create');
		Route::post('/store','account\UserPrivilegesController@store');
		Route::get('/edit/{id}','account\UserPrivilegesController@edit');
		Route::post('/update/{id}','account\UserPrivilegesController@update');
		Route::post('/delete','account\UserPrivilegesController@delete');
		Route::get('/show/{id}','account\UserPrivilegesController@show');
		Route::post('/storePrivileges','account\UserPrivilegesController@storePrivileges');

	});
	// ------------------ menu -------------------
	Route::group(['prefix' => 'menu'],function () {
		Route::resource('/','account\MenuController');
	});

	Route::get('activity','account\LogActivityController@index');
});

Route::group(['prefix' => 'general','middleware' => []],function () {

	// ------------------ city -------------------
	Route::group(['prefix' => 'city'],function () {
		Route::get('/','general\CityController@index');
		Route::get('/create','general\CityController@create');
		Route::post('/store','general\CityController@store');
		Route::get('/edit/{id}','general\CityController@edit');
		Route::post('/update/{id}','general\CityController@update');
		Route::post('/delete','general\CityController@delete');
	});

	// ------------------ doa -------------------
	Route::group(['prefix' => 'doa'],function () {
		Route::get('/','general\DoaController@index');
		Route::get('/create','general\DoaController@create');
		Route::post('/store','general\DoaController@store');
		Route::get('/edit/{id}','general\DoaController@edit');
		Route::post('/update/{id}','general\DoaController@update');
		Route::post('/delete','general\DoaController@delete');
		Route::get('/detail/{id}','general\DoaController@show');
	});

	// ------------------ doa -------------------
	Route::group(['prefix' => 'news'],function () {
		Route::get('/','general\NewsController@index');
		Route::get('/create','general\NewsController@create');
		Route::post('/store','general\NewsController@store');
		Route::get('/edit/{id}','general\NewsController@edit');
		Route::post('/update/{id}','general\NewsController@update');
		Route::post('/delete','general\NewsController@delete');
		Route::get('/detail/{id}','general\NewsController@show');
	});

	// ------------------ home content -------------------
	Route::group(['prefix' => 'home-content'],function () {
		Route::get('/','general\HomeContentController@index');
		Route::post('/update','general\HomeContentController@update');
	});

	// ------------------ about us -------------------
	Route::group(['prefix' => 'about'],function () {
		Route::get('/','general\AboutController@index');
		Route::post('/update','general\AboutController@update');
	});

	// ------------------ contact -------------------
	Route::group(['prefix' => 'contact'],function () {
		Route::get('/','general\ContactController@index');
		Route::post('/update','general\ContactController@update');
	});

});





Route::get('hash','LoginController@hash');
