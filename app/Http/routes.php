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

Route::get('/', ['middleware' => 'domain_access', 'uses' => 'LandingPageController@getIndex']);

Route::get('/wizard/partials/{name}.html', 'School\RegistrationWizardController@partial');
Route::resource('/wizard', 'School\RegistrationWizardController');
/*
 * -------------------------------------------------------------------------
 * SUB-DOMAIN ROUTES
 * -------------------------------------------------------------------------
 */

//Basic Routes
Route::group(['middleware' => 'domain_access'], function () {
    Route::get('home', 'LandingPageController@getIndex');
}
);

//School Basic Resources API Route
Route::group(
    [
        'middleware' => 'domain_access',
        'prefix' => 'resources'
    ],
    function () {
        Route::resource('school', 'School\Resources\School\SchoolController');
        Route::resource('school-setup', 'School\Resources\Configurations\RegisterSchoolConfigController');
    }
);

//School Admin Pages Route
Route::group(
    [
        'middleware' => 'domain_access',
        'prefix' => 'admin',
        'namespace' => 'School\Admin'
    ],
    function () {
        Route::controllers([
            'auth' => 'AdminAuthController',
            'password' => 'AdminPasswordController',
        ]);
        Route::controller('dashboard', 'AdminDashboardController');
        Route::resource('resources/menu', 'Dashboard\NavigationMenuController');
    }
);

//School Admin Resources Route
Route::group(
    [
        'middleware' => 'domain_access',
        'prefix' => 'admin/resources',
        'namespace' => 'School\Resources'
    ],
    function () {
        Route::resource('school', 'School\SchoolController');
        Route::resource('school-profile', 'Configurations\SchoolProfileController');
        Route::resource('staff-settings', 'Configurations\StaffSettingsController');
        Route::resource('grading-systems', 'Configurations\GradingSystemsController');
        Route::resource('courses-settings', 'Configurations\CourseSettingsController');
        Route::resource('category-class-settings', 'Configurations\CategoryAndClassesSettingsController');
        Route::resource('sessions-terms-settings', 'Configurations\SessionTermSettingsController');
        Route::resource('behaviour-assessment-systems', 'Configurations\BehaviourAssessmentSystemController');
        Route::resource('skill-assessment-systems', 'Configurations\SkillAssessmentSystemController');
        Route::resource('grade-assessment-systems', 'Configurations\GradeAssessmentSystemsController');
        Route::resource('import-students', 'School\StudentImportController');

    }
);


//School Admin Modules
Route::group(
    [
        'middleware' => 'domain_access',
        'prefix' => 'admin/modules',
        'namespace' => 'School\Modules'
    ],
    function () {
        Route::resource('students', 'Admin\Students\StudentsController');
    }
);


//School Student Pages routes
Route::group(
    [
        'middleware' => 'domain_access',
        'prefix' => 'student',
        'namespace' => 'School\Student'
    ],
    function () {
        Route::controllers([
            'auth' => 'StudentAuthController',
            'password' => 'StudentPasswordController',
        ]);
        Route::controller('dashboard', 'StudentDashboardController');
        Route::resource('resources/menu', 'Dashboard\NavigationMenuController');
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
        Route::resource('resources/menu', 'Resources\NavigationMenuController');
        Route::resource('resources/school', 'Resources\SchoolController');
        Route::resource('resources/modules', 'Resources\ModulesController');
    }
);
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');