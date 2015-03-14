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
Route::get('/', 'LandingPageController@getIndex');
Route::get('/wizard/partials/{name}.html','School\RegistrationWizardController@partial');
Route::resource('/wizard','School\RegistrationWizardController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'resources', 'namespace' => 'Resources'], function () {
    Route::resource('school', 'School\SchoolController');
    Route::resource('school-setup', 'Configurations\RegisterSchoolConfigController');
});