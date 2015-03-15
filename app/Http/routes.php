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

Route::get('/wizard/partials/{name}.html', 'School\RegistrationWizardController@partial');
Route::resource('/wizard', 'School\RegistrationWizardController');


/*
 * -------------------------------------------------------------------------
 * SUB-DOMAIN ROUTES
 * -------------------------------------------------------------------------
 */

//Basic Routes
Route::group(
    [
        'domain' => '{school_slug}.' . config('unify.domain')
    ],
    function () {
        Route::get('home', 'LandingPageController@getIndex');
    }
);

//School Resources API Route
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

//School Admin Pages Route
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

//School Student Pages routes
Route::group(
    [
        'domain' => '{school_slug}.' . config('unify.domain'),
        'prefix' => 'student',
        'namespace' => 'School\Student'
    ],
    function () {
        Route::controllers([
            'auth' => 'StudentAuthController',
            'password' => 'StudentPasswordController',
        ]);
        Route::controller('dashboard', 'StudentDashboardController');
    }
);


/*
 * -------------------------------------------------------------------------
 * NON-SUB-DOMAIN ROUTES
 * -------------------------------------------------------------------------
 */

//School Admin Routes
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

//School Students Routes
Route::group(
    [
        'prefix' => 'student',
        'namespace' => 'School\Student'
    ],
    function () {
        Route::controllers([
            'auth' => 'StudentAuthController',
            'password' => 'StudentPasswordController',
        ]);
        Route::controller('dashboard', 'StudentDashboardController');
    }
);

//School Resources Routes API

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


/*
 * -------------------------------------------------------------------------
 * SUPER ADMIN ROUTES
 * -------------------------------------------------------------------------
 */

Route::group(
    [
        'prefix' => 'unify',
        'namespace' => 'SuperAdmin'
    ],
    function () {
        Route::controllers([
            'auth' => 'Auth\AuthController',
            'password' => 'Auth\PasswordController',
        ]);
        Route::controller('dashboard', 'Dashboard\DashboardController');
    }
);