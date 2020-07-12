<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//
Route::resource('admin/role','RoleController');
Route::resource('admin/menu','MenuController');
Route::resource('admin/rolemenu','RoleMenuController');
Route::resource('admin/user','UserController');
Route::patch('admin/user/locked/{id}', 'UserController@locked')->name('locked');

Route::resource('profile','ProfileController'); 

Route::get('profile/notification','NotificationController@index')->name('index');
Route::post('profile/notification','NotificationController@index')->name('index');
Route::get('profile/notification/show/{id}','NotificationController@show')->name('show');
Route::patch('profile/notification/read/{id}', 'NotificationController@read')->name('read');
Route::get('profile/notification/allread', 'NotificationController@allread')->name('allread');

Route::get('/changePassword','ChangePasswordController@showChangePasswordForm');
Route::post('/changePassword','ChangePasswordController@changePassword')->name('changePassword');

Route::get('searchmenu', ['as'=>'searchmenu','uses'=>'MenuController@searchmenu']);
Route::get('searchuser', ['as'=>'searchuser','uses'=>'SearchController@searchuser']);
Route::get('searchcode', ['as'=>'searchcode','uses'=>'CodeController@searchcode']);
Route::get('search', ['as'=>'search','uses'=>'SearchController@search']);

Route::get('/locale/{lang}','LanguageController@change')->name('lang');

Route::resource('admin/category','CategoryController');