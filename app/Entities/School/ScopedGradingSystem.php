<?php namespace UnifySchool\Entities\School;


/**
 * UnifySchool\Entities\School\ScopedGradingSystem
 *
 * @property integer $id
 * @property integer $school_id
 * @property string $name
 * @property string $slug
 * @property array $grades
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \UnifySchool\School $school
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedGradingSystem whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedGradingSystem whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedGradingSystem whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedGradingSystem whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedGradingSystem whereGrades($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedGradingSystem whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedGradingSystem whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @method static \UnifySchool\Entities\School\BaseModel getWithData()
 */
class ScopedGradingSystem extends BaseModel
{

    protected $casts = [
        'grades' => 'array'
    ];
}
