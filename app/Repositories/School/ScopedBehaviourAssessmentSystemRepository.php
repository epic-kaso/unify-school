<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/25/2015
 * Time: 11:57 AM
 */

namespace UnifySchool\Repositories\School;


use UnifySchool\Entities\School\ScopedBehaviour;
use UnifySchool\Repositories\BaseRepository;

class ScopedBehaviourAssessmentSystemRepository extends BaseRepository{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return ScopedBehaviour::class;
    }

    public function isBehaviourAssessmentSystemConfigured()
    {
        return count($this->all()) > 0;
    }
}