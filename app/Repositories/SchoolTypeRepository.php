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
        return $this->school->withDefaults()->get();
    }

    public function fetchSupportedCountries()
    {
        return $this->country->withStates()->get();
    }
}