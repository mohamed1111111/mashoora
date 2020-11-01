<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//vendor  experiancesroutes
Route::post('vendors/{vendor}/experiances', 'ExperiencesController@store');
Route::get('vendors/{vendor}/experiances', 'ExperiencesController@show');
Route::PATCH('vendors/{vendor}/experiance/{experiance}', 'ExperiencesController@update');
Route::DELETE('vendors/{vendor}/experiance/{experiance}', 'ExperiencesController@destroy');
//country  routes
Route::Post('countries','CountryController@store');
Route::PATCH('countries/{country}/update','CountryController@update');
Route::get('countries/{country}','CountryController@show');
Route::get('countries','CountryController@index');
// Route::resource('country', 'CountryController');

//category routes
Route::Post('categories','CategoryController@store');
Route::PATCH('categories/{category}/update','CategoryController@update');
Route::get('categories/{category}','CategoryController@show');
Route::get('categories','CategoryController@index');


//auth  routes
Route::post('customers/register','API\AuthController@customerRegister'); // customers/register
Route::post('vendors/register','API\AuthController@vendorRegister'); // vendors/register
Route::post('vendors/{vendor}/documents','VendorController@storeDocument');
Route::post('login','API\LoginController@login');

Route::post('forgot/password', 'API\ForgotPasswordController')->name('forgot.password');
Route::get('email/resend','API\VerificationController@resend');
Route::get('email/verify/{id}/{hash}','API\VerificationController@verify')->name('verification.verify');



//sociallogin
Route::get('login/google', 'API\AuthController@getGoogleUser');
Route::get('login/twitter', 'API\AuthController@getTwitterUser');
Route::get('login/snapchat', 'API\AuthController@getSnapchatUser');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
