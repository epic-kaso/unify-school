<?php namespace UnifySchool\Entities\School;

/**
 * UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision
 *
 * @property integer $id
 * @property integer $scoped_school_category_arm_id
 * @property integer $school_id
 * @property string $name
 * @property string $display_name
 * @property string $meta
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \UnifySchool\Entities\School\ScopedSchoolCategoryArm $school_category_arm
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision whereScopedSchoolCategoryArmId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision whereMeta($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @property-read \UnifySchool\School $school 
 */
class ScopedSchoolCategoryArmSubdivision extends BaseModel
{
    protected $casts = [
        'meta' => 'object'
    ];

    public function school_category_arm()
    {
        return $this->belongsTo('UnifySchool\Entities\School\ScopedSchoolCategoryArm');
    }

}
