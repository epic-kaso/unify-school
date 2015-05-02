<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 5/2/2015
 * Time: 12:12 PM
 */

namespace UnifySchool\Repositories\School\Criteria;


use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class StudentsBySchoolCategory extends Criteria{

    protected $school_category_id;
    protected $school_subarms_id;

    public function __construct($school_category_id,$school_subarms_id){
        $this->school_category_id = $school_category_id;
        $this->school_subarms_id = $school_subarms_id;
    }

    public function apply($model, Repository $repository){
        $school_subarms_id = $this->school_subarms_id;
        $query = $model->whereHas('class_students',function($query) use($school_subarms_id){
            $query->whereIn('scoped_school_category_arm_subdivision_id',$school_subarms_id);
        });
        
        return $query;
    }
}