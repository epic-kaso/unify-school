<?php namespace UnifySchool;

use Illuminate\Database\Eloquent\Model;

/**
 * UnifySchool\SchoolCategory
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $arms
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategory whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategory whereArms($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategory whereUpdatedAt($value)
 * @property integer $school_type_id
 * @property string $meta
 * @property-read \UnifySchool\SchoolType $school_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\UnifySchool\SchoolCategoryArm[] $school_category_arms
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategory whereSchoolTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategory whereMeta($value)
 */
class SchoolCategory extends BaseModel
{
    protected $casts = [
        'meta' => 'object'
    ];

    public function school_type()
    {
        return $this->belongsTo('UnifySchool\SchoolType');
    }

    public function school_category_arms()
    {
        return $this->hasMany('UnifySchool\SchoolCategoryArm');
    }
}
