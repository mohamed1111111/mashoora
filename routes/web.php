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




// Demo routes
Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');
Route::get('/icons/custom-icons', 'PagesController@customIcons');
Route::get('/icons/flaticon', 'PagesController@flaticon');
Route::get('/icons/fontawesome', 'PagesController@fontawesome');
Route::get('/icons/lineawesome', 'PagesController@lineawesome');
Route::get('/icons/socicons', 'PagesController@socicons');
Route::get('/icons/svg', 'PagesController@svg');

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

Auth::routes();
 // Route::get('/', 'HomeController@index')->name('home');
 Route::group(['middleware' => ['auth']], function() {
     Route::resource('roles','RoleController')->middleware('is_admin');
     Route::resource('users','UserController')->middleware('is_admin');
     Route::get('/', 'PagesController@index')->middleware('is_admin')->name('home');
     Route::get('/admins/create', 'AdminController@create')->name('admins');
     Route::get('/admins', 'AdminController@index')->name('admins');
     Route::post('/admins', 'AdminController@store');
     Route::get('/admins/list', 'AdminController@getAdmins')->name('admins/list');
     Route::get('change/password', 'Auth\ChangePasswordController@index');
     Route::post('change/password', 'Auth\ChangePasswordController@store')->name('change.password');
 });
