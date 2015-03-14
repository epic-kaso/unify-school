<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/14/2015
 * Time: 11:41 AM
 */

namespace UnifySchool\Repositories;

use UnifySchool\SchoolType;

class SchoolTypeRepository
{

    /**
     * @var SchoolType
     */
    protected $school;

    function __construct(SchoolType $school)
    {
        $this->school = $school;
    }

    public function fetchDefaultSchoolConfig()
    {
        return $this->school->withDefaults()->get();
    }
}