<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 8:19 AM
 */

namespace UnifySchool\Repositories\School;


use UnifySchool\Entities\School\ScopedSchoolCategory;
use UnifySchool\Repositories\BaseRepository;

class ScopedSchoolCategoriesRepository extends BaseRepository {

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