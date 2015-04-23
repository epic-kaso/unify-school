<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/13/2015
 * Time: 11:38 AM
 */

namespace UnifySchool\Repositories\School;


use UnifySchool\Entities\School\ScopedStaff;
use UnifySchool\Repositories\BaseRepository;

class ScopedStaffRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return ScopedStaff::class;
    }

    public function loadAll()
    {
        $staffs = ScopedStaff::getWithData();
        return $staffs->each(function ($item) {
            $item->loadAssignedCourses();
            $item->loadAssignedClasses();
        })->all();
    }
}