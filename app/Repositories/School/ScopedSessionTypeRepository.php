<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 7:20 AM
 */

namespace UnifySchool\Repositories\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use UnifySchool\Entities\School\ScopedSessionType;
use UnifySchool\Entities\School\ScopedSubSessionType;
use UnifySchool\Repositories\BaseRepository;

class ScopedSessionTypeRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */

    protected $numberMapping = [
        'zero' => 0,
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9,
        'ten' => 10,
    ];

    protected $positionMapping = [
        'zeroth' => 0,
        'first' => 1,
        'second' => 2,
        'third' => 3,
        'fourth' => 4,
        'fifth' => 5,
        'sixth' => 6,
        'seventh' => 7,
        'eighth' => 8,
        'ninth' => 9,
        'tenth' => 10,
    ];

    public function create(array $data)
    {
        $model = parent::create($data);
        $this->createSubSessionsForSession($model);
        return $model;
    }


    public function model()
    {
        return ScopedSessionType::class;
    }

    private function createSubSessionsForSession(ScopedSessionType $model)
    {
        $subSessionsCount = $this->mapNumberWordToDigit($model->session_type);

        if(is_numeric($subSessionsCount)){
            $this->createSubSession($model,$subSessionsCount);
        }
    }

    private function mapNumberWordToDigit($numberInWord){
        return $this->numberMapping[strtolower($numberInWord)];
    }

    private function createSubSession($model, $subSessionsCount)
    {
        $subDivisionsName = $model->session_divisions_display_name;

        for($i = 1;$i <= $subSessionsCount;$i++){
            $display_name = "{$this->mapNumberToWordPosition($i)} {$subDivisionsName}";
            ScopedSubSessionType::create([
                'scoped_session_type_id' => $model->id,
                'school_id' => $model->school_id,
                'display_name' => $display_name,
                'name' => Str::slug($display_name)
            ]);
        }
    }

    private function mapNumberToWordPosition($i)
    {
        $mapping = array_flip($this->positionMapping);
        return $mapping[$i];
    }
}