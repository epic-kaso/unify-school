<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 8:11 AM
 */

namespace UnifySchool\Repositories;


use UnifySchool\Entities\School\ScopedSchoolType;
use UnifySchool\School;

class SchoolRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return School::class;
    }

    public function create(array $data)
    {
        $school = parent::create($data);
        return $school;
    }



    public function setSchoolType(School $school,ScopedSchoolType $schoolType)
    {
        $school->setSchoolType($schoolType);
    }


}