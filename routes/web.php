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

Route::get('/','LoginController@cekSession');
Route::get('token','LoginController@token');
Route::get('home',function () {
	return view('layouts.app');
});

Route::post('signin','LoginController@index');
Route::get('signout','LoginController@logout');
Route::get('cek','LoginController@cekSession');
Route::get('login','LoginController@login');

// ------------------ account -------------------
Route::group(['prefix' => 'account','middleware' => ['CheckLogin']],function () {

	// ------------------ user -------------------
	Route::group(['prefix' => 'user'],function () {
		session()->put('menu','user');
		Route::get('/','account\UserController@index');
		Route::get('/create','account\UserController@create');
		Route::post('/store','account\UserController@store');
		Route::get('/edit/{id}','account\UserController@edit');
		Route::get('/detail/{id}','account\UserController@show');
		Route::post('/update/{id}','account\UserController@update');
		Route::post('/delete','account\UserController@delete');
	});

	Route::group(['prefix' => 'admin'],function () {
		Route::get('/','account\AdminController@index');
		Route::get('/create','account\AdminController@create');
		Route::post('/store','account\AdminController@store');
		Route::get('/edit/{id}','account\AdminController@edit');
		Route::get('/detail/{id}','account\AdminController@show');
		Route::post('/update/{id}','account\AdminController@update');
		Route::post('/delete','account\AdminController@delete');
		Route::get('/profile','account\AdminController@profile');
		Route::post('/uprof/{id}','account\AdminController@uprof');
	});

	Route::resource('/user-group','account\UserGroupController');
	Route::get('/user-group/privileges/{id}','account\UserGroupController@privileges')->name('user-group.privileges');
	Route::post('/user-group/privileges/store','account\UserGroupController@storeprivileges')->name('user-group.privileges.store');

	Route::get('activity','account\LogActivityController@index');
	Route::post('activity/delete','account\LogActivityController@delete');
});

Route::group(['prefix' => 'general','middleware' => ['CheckLogin']],function () {

	// ------------------ Article -------------------
	Route::group(['prefix' => 'article'],function () {
		Route::get('/','general\ArticleController@index');
		Route::get('/create','general\ArticleController@create');
		Route::post('/store','general\ArticleController@store');
		Route::get('/edit/{id}','general\ArticleController@edit');
		Route::post('/update/{id}','general\ArticleController@update');
		Route::post('/delete','general\ArticleController@delete');
		Route::get('/detail/{id}','general\ArticleController@show');
	});

	// ------------------ Article Category -------------------
	Route::group(['prefix' => 'article_category'],function () {
		Route::get('/','general\ArticleCategoryController@index');
		Route::get('/create','general\ArticleCategoryController@create');
		Route::post('/store','general\ArticleCategoryController@store');
		Route::get('/edit/{id}','general\ArticleCategoryController@edit');
		Route::post('/update/{id}','general\ArticleCategoryController@update');
		Route::post('/delete','general\ArticleCategoryController@delete');
	});

	// ------------------ Event -------------------
	Route::group(['prefix' => 'event'],function () {
		Route::get('/','general\EventController@index');
		Route::get('/create','general\EventController@create');
		Route::post('/store','general\EventController@store');
		Route::get('/edit/{id}','general\EventController@edit');
		Route::post('/update/{id}','general\EventController@update');
		Route::post('/delete','general\EventController@delete');
		Route::get('/detail/{id}','general\EventController@show');

		Route::group(['prefix' => '{event_id}/schedule'], function () {
			Route::get('/','general\ScheduleController@index');
			Route::get('/create','general\ScheduleController@create');
			Route::post('/store','general\ScheduleController@store');
			Route::get('/edit/{id}','general\ScheduleController@edit');
			Route::post('/update/{id}','general\ScheduleController@update');
			Route::post('/delete','general\ScheduleController@delete');
			Route::get('/detail/{id}','general\ScheduleController@show');
		});

		Route::group(['prefix' => '{event_id}/gallery'], function () {
			Route::get('/','general\GalleryController@index');
			// Route::get('/create','general\GalleryController@create');
			Route::post('/store','general\GalleryController@store');
			// Route::get('/edit/{id}','general\GalleryController@edit');
			// Route::post('/update/{id}','general\GalleryController@update');
			Route::post('/delete','general\GalleryController@delete');
			Route::get('/detail/{id}','general\GalleryController@show');
		});
	});

	// ------------------ Highlight -------------------
	Route::group(['prefix' => 'highlight'],function () {
		Route::get('/','general\HighlightController@index');
		Route::get('/create','general\HighlightController@create');
		Route::post('/store','general\HighlightController@store');
		Route::post('/delete','general\HighlightController@delete');
		Route::get('/detail/{id}','general\HighlightController@show');
	});

	// ------------------ Walktrough -------------------
	Route::group(['prefix' => 'walkthrough'],function () {
		Route::get('/','general\WalkthroughController@index');
		Route::get('/create','general\WalkthroughController@create');
		Route::post('/store','general\WalkthroughController@store');
		Route::get('/edit/{id}','general\WalkthroughController@edit');
		Route::post('/update/{id}','general\WalkthroughController@update');
		Route::post('/delete','general\WalkthroughController@delete');
		Route::get('/detail/{id}','general\WalkthroughController@show');
	});

  // ------------------ Vote -------------------
  Route::resource('/vote', 'general\VoteController');

	// ------------------ home content -------------------
	Route::group(['prefix' => 'home-content'],function () {
		Route::get('/','general\HomeContentController@index');
		Route::post('/update','general\HomeContentController@update');
	});


    Route::get('/splashscreen', 'general\SplashScreenController@index')->name('SplashScreen.index');
    Route::post('/splashscreen', 'general\SplashScreenController@store')->name('SplashScreen.store');
});
Route::group(['prefix' => 'menu','middleware' => ['CheckLogin']],function () {
    Route::resource('/group-menu', 'menu\MenuGroupController');
    Route::resource('/master-menu', 'menu\MenuController');
});

// ------------------ Company -------------------
Route::group(['prefix' => 'company', 'middleware' => ['CheckLogin']], function () {

	// ------------------ community -------------------
	Route::group(['prefix' => 'community'], function () {
		Route::get('/','company\CommunityController@index');
		Route::get('/create','company\CommunityController@create');
		Route::post('/store','company\CommunityController@store');
		Route::get('/edit/{id}','company\CommunityController@edit');
		Route::post('/update/{id}','company\CommunityController@update');
		Route::post('/delete','company\CommunityController@delete');
		Route::get('/detail/{id}','company\CommunityController@show');

	});

	// ------------------ secrtariat -------------------
	Route::group(['prefix' => 'secretariat'], function () {
		Route::get('/','company\SecretariatController@index');
		Route::get('/create','company\SecretariatController@create');
		Route::get('edit/{id}', 'company\SecretariatController@edit');
		Route::post('/add', 'company\SecretariatController@store');
		Route::post('/update/{id}', 'company\SecretariatController@update');
		Route::post('/delete', 'company\SecretariatController@delete');
	});

	// ------------------ shop -------------------
	Route::group(['prefix' => 'shop'], function () {
		Route::get('/','company\ShopController@index');
		Route::get('/create','company\ShopController@create');
		Route::post('/store','company\ShopController@store');
		Route::get('/edit/{id}','company\ShopController@edit');
		Route::post('/update/{id}','company\ShopController@update');
		Route::post('/delete','company\ShopController@delete');
		Route::get('/detail/{id}','company\ShopController@show');
	});

	// ------------------ store -------------------
	Route::group(['prefix' => 'store'], function () {
		Route::get('/','company\StoreController@index');
		Route::get('/create','company\StoreController@create');
		Route::post('/store','company\StoreController@store');
		Route::get('/edit/{id}','company\StoreController@edit');
		Route::post('/update/{id}','company\StoreController@update');
		Route::post('/delete','company\StoreController@destroy');
		Route::get('/detail/{id}','company\StoreController@show');
	});

});





Route::get('hash','LoginController@hash');
