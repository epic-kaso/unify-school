<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 7:26 AM
 */

namespace UnifySchool\Repositories\School;


use UnifySchool\Entities\School\ScopedSchoolCategory;
use UnifySchool\Repositories\BaseRepository;

class ScopedSchoolCategoryRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return ScopedSchoolCategory::class;
    }
}