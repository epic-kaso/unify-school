<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 7:05 AM
 */

namespace UnifySchool\Repositories\School;


use Carbon\Carbon;
use UnifySchool\Entities\School\ScopedStudent;
use UnifySchool\Repositories\BaseRepository;

class ScopedStudentsRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return ScopedStudent::class;
    }

    public function all($columns = array('*'))
    {
        return \Cache::rememberForever('scoped_students_'.$this->getSchool()->id, function() use($columns) {
            return parent::all($columns);
        });
    }
}