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

class StudentsWithRelationships extends Criteria{

    public function apply($model, Repository $repository){
        
        $query = $model->with(['current_class_student']);
		
        return $query;
    }
}