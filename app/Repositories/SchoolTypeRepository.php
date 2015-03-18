<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/14/2015
 * Time: 11:41 AM
 */

namespace UnifySchool\Repositories;

use UnifySchool\Country;
use UnifySchool\SchoolType;

class SchoolTypeRepository
{

    /**
     * @var SchoolType
     */
    protected $school;
    /**
     * @var Country
     */
    private $country;

    function __construct(SchoolType $school, Country $country)
    {
        $this->school = $school;
        $this->country = $country;
    }

    public function fetchDefaultSchoolConfig()
    {
        if(\App::environment() == 'production') {
            return \Cache::tags('fetchDefaultSchoolConfig')
                ->remember('schools_default_config', 60 * 24, function () {
                    return $this->school->withDefaults()->get();
                });
        }

        return $this->school->withDefaults()->get();
    }

    public function fetchSupportedCountries()
    {

        if(\App::environment() == 'production') {
            return \Cache::tags('fetchSupportedCountries')
                ->remember('schools_default_config', 60 * 24, function (){
                    return $this->country->withStates()->get();
                });
        }

        return $this->country->withStates()->get();
    }
}