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

class ScopedSchoolCategoriesRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return ScopedSchoolCategory::class;
    }
    
    public function getAssignedBehaviourSkillSystem()
    {
        $response = ScopedSchoolCategory::with('school_category_arms_subdivisions')->get()->map(function ($item) {
            $i = [];
            $result = [];

            foreach($item->school_category_arms_subdivisions as $j){
                $i[] = $j->scoped_behaviour_skill_system_id;
            }

            if(count($i) < 1){
                $result[$item->name] = null;
                return $result;
            }

            $test1 = $i[0];

            for($k = 1; $k < count($i);$k++){
                if($i[$k] !== $test1){
                    $result[$item->name] = null;
                    return $result;
                }
            }

            $result[$item->name] = $test1;

            return $result;
        });

        $i = new \stdClass();
        foreach ($response as $item) {
            foreach ($item as $key => $value) {
                $i->{$key} = $value;
            }
        }

        return $i;

    }

    public function getAssignedGradingSystem()
    {
        $response = ScopedSchoolCategory::with('school_category_arms_subdivisions')->get()->map(function ($item) {
            $i = [];
            $result = [];

            foreach($item->school_category_arms_subdivisions as $j){
                $i[] = $j->scoped_grading_system_id;
            }

            if(count($i) < 1){
                $result[$item->name] = null;
                return $result;
            }

            $test1 = $i[0];

            for($k = 1; $k < count($i);$k++){
                if($i[$k] !== $test1){
                    $result[$item->name] = null;
                    return $result;
                }
            }

            $result[$item->name] = $test1;

            return $result;
        });

        $i = new \stdClass();
        foreach ($response as $item) {
            foreach ($item as $key => $value) {
                $i->{$key} = $value;
            }
        }

        return $i;

    }

    public function getAssignedGradeAssessmentSystem()
    {
        $response = ScopedSchoolCategory::with('school_category_arms_subdivisions')->get()->map(function ($item) {
            $i = [];
            $result = [];

            foreach($item->school_category_arms_subdivisions as $j){
                $i[] = $j->scoped_grade_assessment_system_id;
            }

            if(count($i) < 1){
                $result[$item->name] = null;
                return $result;
            }

            $test1 = $i[0];

            for($k = 1; $k < count($i);$k++){
                if($i[$k] !== $test1){
                    $result[$item->name] = null;
                    return $result;
                }
            }

            $result[$item->name] = $test1;

            return $result;
        });

        $i = new \stdClass();
        foreach ($response as $item) {
            foreach ($item as $key => $value) {
                $i->{$key} = $value;
            }
        }
        return $i;
    }

    public function assignGradeAssessmentSystem($grade_assessment_system_id, $key,$value)
    {
        $category = $this->findBy($key, $value);
        if (!is_null($category)) {

            $category->school_category_arms_subdivisions->each(function($item) use($grade_assessment_system_id){
                $item->scoped_grade_assessment_system_id = $grade_assessment_system_id;
                $item->save();
            });

        }
    }

    public function assignGradingSystem($grading_system_id, $key, $value)
    {
        $category = $this->findBy($key, $value);
        if (!is_null($category)) {

            $category->school_category_arms_subdivisions->each(function($item) use($grading_system_id){
                $item->scoped_grading_system_id = $grading_system_id;
                $item->save();
            });
        }
    }
    
    public function assignBehaviourSkillSystem($system_id, $key, $value){
         $category = $this->findBy($key, $value);
        if (!is_null($category)) {

            $category->school_category_arms_subdivisions->each(function($item) use($system_id){
                $item->scoped_behaviour_skill_system_id = $system_id;
                $item->save();
            });
        }
    }
}