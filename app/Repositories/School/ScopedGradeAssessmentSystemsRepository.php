<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/30/2015
 * Time: 3:57 PM
 */

namespace UnifySchool\Repositories\School;


use UnifySchool\Entities\School\ScopedGradeAssessmentSystem;
use UnifySchool\Repositories\BaseRepository;

class ScopedGradeAssessmentSystemsRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return ScopedGradeAssessmentSystem::class;
    }

    public function isGradeAssessmentSystemConfigured()
    {
        return count($this->all()) > 0;
    }
}