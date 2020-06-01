<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::get('/', 'HomeController@index');
Route::get('user/activation/{token}', 'Auth\AuthController@userActivation');
Route::get('/home', 'HomeController@index');
Route::get('/thanks', 'HomeController@thanks');
// Admin area
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index');
    Route::resource('/ait', 'f_admin\AitController');
    Route::resource('/aitapprove', 'f_admin\AitApproveController');
    Route::resource('/head', 'f_admin\HeadController');
    Route::resource('/bank', 'f_admin\BankController');
    Route::resource('/branch', 'f_admin\BranchController');
    Route::resource('/hearing', 'f_admin\HearingController');
    Route::resource('/office', 'f_admin\OfficeController');
    Route::resource('/report', 'f_admin\ReportController');
    Route::resource('/profile', 'f_admin\ProfileController');
    Route::resource('/paymentcode', 'f_admin\PaymentcodeController');
    Route::get('/thanks', 'f_admin\AitController@thanks');
    
    Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){
        Route::resource('/users', 'F_admin\UsersController');
        Route::get('/users/{id}/settings', 'F_admin\UsersController@settings');
        Route::post('/users/settings', 'F_admin\UsersController@settingsPost');
        Route::resource('/users_permission', 'F_admin\UserPermissionController');
        Route::resource('/module', 'F_admin\ModuleController');
    });
   
});

Route::auth();