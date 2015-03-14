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


//SubDomain Routing
Route::group(['domain' => '{school_slug}.' . config('unify.domain')], function () {
    Route::get('home', function ($school_slug) {
        return view('landing_page.index', ['school' => $school_slug]);
    });
    Route::resource('school', 'School\SchoolController');
    Route::resource('school-setup', 'Configurations\RegisterSchoolConfigController');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'domain' => '{school_slug}.' . config('unify.domain')], function () {
    Route::controllers([
        'auth' => 'AdminAuthController',
        'password' => 'AdminPasswordController',
    ]);
    Route::controller('dashboard', 'AdminDashboardController');
});


//None SubDomain routing

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::controllers([
        'auth' => 'AdminAuthController',
        'password' => 'AdminPasswordController',
    ]);
    Route::controller('dashboard', 'AdminDashboardController');
});

Route::group(['prefix' => 'resources', 'namespace' => 'Resources'], function () {
    Route::resource('school', 'School\SchoolController');
    Route::resource('school-setup', 'Configurations\RegisterSchoolConfigController');
});