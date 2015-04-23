<?php namespace UnifySchool\Entities\School;


/**
 * UnifySchool\Entities\School\ScopedGradeAssessmentSystem
 *
 * @property-read \UnifySchool\School $school
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @property integer $id
 * @property integer $school_id
 * @property string $name
 * @property string $divisions
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedGradeAssessmentSystem whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedGradeAssessmentSystem whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedGradeAssessmentSystem whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedGradeAssessmentSystem whereDivisions($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedGradeAssessmentSystem whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedGradeAssessmentSystem whereUpdatedAt($value)
 * @property integer $total_score
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedGradeAssessmentSystem whereTotalScore($value)
 * @method static \UnifySchool\Entities\School\BaseModel getWithData()
 */
class ScopedGradeAssessmentSystem extends BaseModel
{

    protected $casts = [
        'divisions' => 'array'
    ];

}
