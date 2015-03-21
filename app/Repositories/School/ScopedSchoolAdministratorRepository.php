<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 7:30 AM
 */

namespace UnifySchool\Repositories\School;


use UnifySchool\Entities\School\SchoolAdministrator;
use UnifySchool\Repositories\BaseRepository;

class ScopedSchoolAdministratorRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return SchoolAdministrator::class;
    }
}