<?php namespace UnifySchool\Entities\School;

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
