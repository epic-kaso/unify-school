<?php namespace UnifySchool;

use Illuminate\Database\Eloquent\Model;

/**
 * UnifySchool\SchoolType
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property integer $session_type_id
 * @property string $school_categories
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereSessionTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereSchoolCategories($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereUpdatedAt($value)
 * @property string $meta
 * @property-read \UnifySchool\SessionType $session_type
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereMeta($value)
 * @method static \UnifySchool\SchoolType withDefaults()
 */
class SchoolType extends Model
{

    const SCHOOL_TERTIARY = 'tertiary';
    const SCHOOL_NON_TERTIARY = 'non_tertiary';
    const SCHOOL_CUSTOM = 'custom';

    protected $casts = [
        'meta' => 'object'
    ];

    public function session_type()
    {
        return $this->belongsTo('UnifySchool\SessionType');
    }


    public function school_categories()
    {
        return $this->hasMany('UnifySchool\SchoolCategory');
    }

    public function scopeWithDefaults($query)
    {
        return $query->with(
            'session_type',
            'school_categories',
            'school_categories.school_category_arms',
            'school_categories.school_category_arms.school_category_arm_subdivisions'
        );
    }
}
