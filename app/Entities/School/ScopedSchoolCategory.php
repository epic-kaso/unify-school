<?php namespace UnifySchool\Entities\School;

/**
 * UnifySchool\Entities\School\ScopedSchoolCategory
 *
 * @property integer $id
 * @property integer $scoped_school_type_id
 * @property integer $school_id
 * @property string $name
 * @property string $display_name
 * @property string $meta
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \UnifySchool\Entities\School\ScopedSchoolType $school_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\UnifySchool\Entities\School\ScopedSchoolCategoryArm[] $school_category_arms
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategory whereScopedSchoolTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategory whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategory whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategory whereMeta($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategory whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @property-read mixed $classes
 * @property-read \UnifySchool\School $school
 * @property integer $scoped_grading_system_id 
 * @property integer $scoped_grade_assessment_system_id 
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategory whereScopedGradingSystemId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategory whereScopedGradeAssessmentSystemId($value)
 */
class ScopedSchoolCategory extends BaseModel
{

    protected $appends = ['classes'];

    protected $casts = [
        'meta' => 'object'
    ];

    public function school_type()
    {
        return $this->belongsTo('UnifySchool\Entities\School\ScopedSchoolType');
    }

    public function school_category_arms()
    {
        return $this->hasMany('UnifySchool\Entities\School\ScopedSchoolCategoryArm');
    }

    public function grading_system(){
        return $this->belongsTo('UnifySchool\Entities\School\ScopedGradingSystem');
    }

    public function grade_assessment_system(){
        return $this->belongsTo('UnifySchool\Entities\School\ScopedGradeAssessmentSystem');
    }

    public function getClassesAttribute(){
        $response = [];
        foreach($this->school_category_arms as $arm){
            $response = array_merge($response,$arm->school_category_arm_subdivisions->toArray());
        }

        return $response;
    }

}
