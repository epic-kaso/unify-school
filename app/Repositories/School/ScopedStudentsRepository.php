<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 7:05 AM
 */

namespace UnifySchool\Repositories\School;


use UnifySchool\Entities\School\ScopedStudent;
use UnifySchool\Repositories\BaseRepository;

class ScopedStudentsRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return ScopedStudent::class;
    }
}