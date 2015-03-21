<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/14/2015
 * Time: 11:41 AM
 */

namespace UnifySchool\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use UnifySchool\Country;
use UnifySchool\SchoolType;

class SchoolTypeRepository extends BaseRepository
{

    /**
     * @var SchoolType
     */
    protected $school;
    /**
     * @var Country
     */
    private $country;

    public function __construct(App $app, Collection $collection,SchoolType $school, Country $country)
    {
        parent::__construct($app,$collection);

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

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
       return SchoolType::class;
    }
}