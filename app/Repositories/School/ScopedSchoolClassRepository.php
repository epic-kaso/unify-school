<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 7:28 AM
 */

namespace UnifySchool\Repositories\School;


use UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision;
use UnifySchool\Repositories\BaseRepository;

class ScopedSchoolClassRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return ScopedSchoolCategoryArmSubdivision::class;
    }

    public function isSchoolClassConfigured(){
        return count($this->all()) > 0;
    }
}