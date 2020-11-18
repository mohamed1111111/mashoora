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
Route::post('login','API\LoginController@login');

//auth  routes
Route::post('customers/register','API\AuthController@customerRegister'); // customers/register
Route::post('vendors/register','API\AuthController@vendorRegister'); // vendors/register

Route::post('forgot/password', 'API\ForgotPasswordController')->name('forgot.password');
Route::get('email/resend','API\VerificationController@resend');
Route::get('email/verify/{id}/{hash}','API\VerificationController@verify')->name('verification.verify');

Route::get('vendors', 'VendorController@index');
Route::get('vendors/{vendorId}', 'VendorController@vendor');

//sociallogin
Route::get('login/google', 'API\AuthController@getGoogleUser');
Route::get('login/twitter', 'API\AuthController@getTwitterUser');
Route::get('login/snapchat', 'API\AuthController@getSnapchatUser');


Route::group(['middleware' => ['auth:api']], function() {

          Route::post('vendor/documents','VendorController@storeDocument');

          //booking routes
          Route::get('vendor/enrolmments','BookingController@vendorBookingList');
          Route::get('client/enrolmments','BookingController@clientBookingList');
          Route::get('sessions', 'BookingController@index');
          Route::post('sessions/{vendorId}', 'BookingController@customerBook');
          Route::post('enrollment/{enrollment}/accept', 'BookingController@vendorAccept');
          Route::post('enrollment/{enrollment}/reject', 'BookingController@vendorReject');
          Route::post('enrollment/{enrollment}/cancelled', 'BookingController@clientCancell');
          Route::post('enrollment/{enrollment}/proccesing', 'BookingController@enrollmentProccessing');
          Route::post('enrollment/{enrollment}/complete', 'BookingController@enrollmentCompleted');

          //vendor  experiances routes
          Route::post('vendors/{vendor}/experiences', 'ExperiencesController@store');
          Route::get('vendors/{vendor}/experiences', 'ExperiencesController@show');
          Route::PATCH('vendors/{vendor}/experiences/{experience}', 'ExperiencesController@update');
          Route::DELETE('vendors/{vendor}/experiences/{experience}', 'ExperiencesController@destroy');

          //rating vendor routes
          Route::post('vendors/rating/{enrollment}', 'RateController@customerRate');
          //vendor working hours routes
          Route::post('vendors/working/hours', 'WorkingHoursController@store');
          Route::get('vendors/working/hours/bookings', 'WorkingHoursController@workingHourBookings');
          Route::get('vendors/working/hours', 'WorkingHoursController@show');
          Route::PATCH('vendors/working/hours/{hours}', 'WorkingHoursController@update');
          Route::DELETE('vendors/working/hours/{hours}', 'WorkingHoursController@destroy');
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


});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
