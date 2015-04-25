<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/30/2015
 * Time: 1:02 PM
 */

namespace UnifySchool\Repositories\School;


use UnifySchool\Entities\Grade;
use UnifySchool\Entities\School\ScopedGradingSystem;
use UnifySchool\Repositories\BaseRepository;

class ScopedGradingSystemsRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return ScopedGradingSystem::class;
    }

    public function all($cols = ['*'])
    {
        $gradingSystems = parent::all($cols);

        return
            $gradingSystems
                ->each(
                    function ($gradingSystem) {
                        $collection = collect($gradingSystem->grades);
                        $gradingSystem->grades = $collection->sortBy(function ($item) {
                            return $item['lowerRange'];
                        })->all();
                        return $gradingSystem;
                    }
                )->all();
    }

    public function getGrades($id)
    {
        $gradingSystem = $this->find($id);
        if (is_null($gradingSystem))
            return null;
        return $gradingSystem->grades;
    }

    public function addGrade($id, Grade $grade)
    {
        $gradingSystem = $this->find($id);
        if (is_null($gradingSystem))
            return null;

        array_push($gradingSystem->grades, $grade);

        $gradingSystem->save();
    }

    public function isGradingSystemConfigured()
    {
        return count($this->all()) > 0;
    }
}