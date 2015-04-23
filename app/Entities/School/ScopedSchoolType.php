<?php namespace UnifySchool\Entities\School;

/**
 * UnifySchool\Entities\School\ScopedSchoolType
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property integer $session_type_id
 * @property integer $school_id
 * @property string $meta
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \UnifySchool\SessionType $session_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\UnifySchool\Entities\School\ScopedSchoolCategory[] $school_categories
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolType whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolType whereSessionTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolType whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolType whereMeta($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolType whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\ScopedSchoolType withDefaults()
 * @property integer $scoped_session_type_id
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolType whereScopedSessionTypeId($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @property-read mixed $classes
 * @property-read \UnifySchool\School $school
 * @method static \UnifySchool\Entities\School\BaseModel getWithData()
 */
class ScopedSchoolType extends BaseModel
{
    protected $appends = ['classes'];

    protected $casts = [
        'meta' => 'object'
    ];

    public function session_type()
    {
        return $this->belongsTo('UnifySchool\Entities\School\ScopedSessionType');
    }


    public function school_categories()
    {
        return $this->hasMany('UnifySchool\Entities\School\ScopedSchoolCategory');
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

    public function getClassesAttribute()
    {
        $response = [];
        foreach ($this->school_categories as $category) {
            $response = array_merge($response, $category->classes);
        }
        return $response;
    }
}
