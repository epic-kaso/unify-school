<?php namespace UnifySchool\Entities\School;

class ScopedSchoolType extends BaseModel
{

    protected $casts = [
        'meta' => 'object'
    ];

    public function session_type()
    {
        return $this->belongsTo('UnifySchool\SessionType');
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
}
