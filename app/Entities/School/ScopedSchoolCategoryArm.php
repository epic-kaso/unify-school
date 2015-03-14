<?php namespace UnifySchool\Entities\School;

class ScopedSchoolCategoryArm extends BaseModel
{
    protected $casts = [
        'meta' => 'object'
    ];

    public function school_category()
    {
        return $this->belongsTo('UnifySchool\Entities\School\ScopedSchoolCategory');
    }

    public function school_category_arm_subdivisions()
    {
        return $this->hasMany('UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision');
    }
}
