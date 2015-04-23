<?php namespace UnifySchool;

/**
 * UnifySchool\SchoolCategoryArm
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $arms
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategoryArm whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategoryArm whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategoryArm whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategoryArm whereArms($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategoryArm whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategoryArm whereUpdatedAt($value)
 * @property integer $school_category_id
 * @property string $meta
 * @property-read \UnifySchool\SchoolCategory $school_category
 * @property-read \Illuminate\Database\Eloquent\Collection|\UnifySchool\SchoolCategoryArmSubdivision[] $school_category_arm_subdivisions
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategoryArm whereSchoolCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategoryArm whereMeta($value)
 */
class SchoolCategoryArm extends BaseModel
{

    protected $casts = [
        'meta' => 'object'
    ];

    public function school_category()
    {
        return $this->belongsTo('UnifySchool\SchoolCategory');
    }

    public function school_category_arm_subdivisions()
    {
        return $this->hasMany('UnifySchool\SchoolCategoryArmSubdivision');
    }

}
