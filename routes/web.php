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

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('signup', 'UsersController@create')->name('signup');

Route::resource('users', 'UsersController');
/**
 * 以上代码等同
 *
Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/{user}', 'UsersController@show')->name('users.show');
Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::post('/users', 'UsersController@store')->name('users.store');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');
 */

/*
HTTP 请求 URL 动作  作用
GET /users  UsersController@index   显示所有用户列表的页面
GET /users/{user}   UsersController@show    显示用户个人信息的页面
GET /users/create   UsersController@create  创建用户的页面
POST    /users  UsersController@store   创建用户
GET /users/{user}/edit  UsersController@edit    编辑用户个人资料的页面
PATCH   /users/{user}   UsersController@update  更新用户
DELETE  /users/{user}   UsersController@destroy 删除用户
 */

Route::get('login','SessionsController@create')->name('login');
Route::post('login','SessionsController@store')->name('login');
Route::delete('logout','SessionsController@destory')->name('logout');

Route::get('/users/{user}/edit','UsersController@edit')->name('users.edit');

Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);