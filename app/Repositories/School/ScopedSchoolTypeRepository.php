<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 8:16 AM
 */

namespace UnifySchool\Repositories\School;


use UnifySchool\Entities\School\ScopedSchoolType;
use UnifySchool\Repositories\BaseRepository;

class ScopedSchoolTypeRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return ScopedSchoolType::class;
    }
}