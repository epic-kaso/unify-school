<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 5/2/2015
 * Time: 12:12 PM
 */

namespace UnifySchool\Repositories\School\Criteria;


use Bosnadev\Repositories\Criteria\Criteria;
use UnifySchool\Entities\Context\SchoolContextTrait;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class SearchStudentsCriteria extends Criteria{

    use SchoolContextTrait;
    
    protected $q;

    public function __construct($query){
        $this->q = $query;
    }

    public function apply($model, Repository $repository){
        
        $q = $this->q;
        $query = $model
        ->where(function($query) use($q){
              $query->where('last_name','like',"%{$q}%")
            		->orWhere('first_name','like',"%{$q}%")
            		->orWhere('reg_number','like',"%{$q}%")
            		->orWhereHas('current_class_student.school_class',function($query) use ($q){
                        $query->where('display_name','like',"%{$q}%");
                    });
        });
        
        return $query;
    }
}