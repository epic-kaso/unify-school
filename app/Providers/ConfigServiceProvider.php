<?php namespace UnifySchool\Providers;

use Illuminate\Support\ServiceProvider;
use UnifySchool\Entities\School\SchoolAdministrator;

class ConfigServiceProvider extends ServiceProvider
{

    /**
     * Overwrite any vendor / package configuration.
     *
     * This service provider is intended to provide a convenient location for you
     * to overwrite any "vendor" or package configuration that you may want to
     * modify before the application handles the incoming request / command.
     *
     * @return void
     */
    public function register()
    {
        if (str_contains(\Request::getUri(), 'admin')) {
            config([
                'auth.model' => SchoolAdministrator::class
            ]);
        }
    }

}
