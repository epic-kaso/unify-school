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

    public function getAssignedGradingSystem()
    {
        $response = $this->all(['name', 'scoped_grading_system_id'])->map(function ($item) {
            $i = [];
            $i[$item->name] = $item->scoped_grading_system_id;
            return $i;
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
        $response = $this->all(['name', 'scoped_grade_assessment_system_id'])->map(function ($item) {
            $i = [];
            $i[$item->name] = $item->scoped_grade_assessment_system_id;
            return $i;
        });

        $i = new \stdClass();
        foreach ($response as $item) {
            foreach ($item as $key => $value) {
                $i->{$key} = $value;
            }
        }
        return $i;
    }
}