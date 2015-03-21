<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 7:29 AM
 */

namespace UnifySchool\Repositories\School;


use UnifySchool\Entities\School\ScopedClassStudent;
use UnifySchool\Repositories\BaseRepository;

class ScopedClassStudentsRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return ScopedClassStudent::class;
    }
}