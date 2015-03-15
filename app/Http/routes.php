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
Route::get('/home', 'LandingPageController@getIndex');

Route::get('/admin', 'School\Admin\AdminDashboardController@getIndex');

Route::get('/wizard/partials/{name}.html', 'School\RegistrationWizardController@partial');
Route::resource('/wizard', 'School\RegistrationWizardController');


//SubDomain Routing
Route::group(
    [
        'domain' => '{school_slug}.' . config('unify.domain')
    ],
    function () {
        Route::get('home', 'LandingPageController@getIndex');
    }
);

Route::group(
    [
        'domain' => '{school_slug}.' . config('unify.domain'),
        'prefix' => 'resources',
        'namespace' => 'School\Resources'
    ],
    function () {
        Route::resource('school', 'School\SchoolController');
        Route::resource('school-setup', 'Configurations\RegisterSchoolConfigController');
    }
);

Route::group(
    [
        'domain' => '{school_slug}.' . config('unify.domain'),
        'prefix' => 'admin',
        'namespace' => 'School\Admin'
    ],
    function () {
        Route::controllers([
            'auth' => 'AdminAuthController',
            'password' => 'AdminPasswordController',
        ]);
        Route::controller('dashboard', 'AdminDashboardController');
    }
);


//None SubDomain routing

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'School\Admin'
    ],
    function () {
        Route::controllers([
            'auth' => 'AdminAuthController',
            'password' => 'AdminPasswordController',
        ]);
        Route::controller('dashboard', 'AdminDashboardController');
    }
);

Route::group(
    [
        'prefix' => 'resources',
        'namespace' => 'School\Resources'
    ],
    function () {
        Route::resource('school', 'School\SchoolController');
        Route::resource('school-setup', 'Configurations\RegisterSchoolConfigController');
    }
);