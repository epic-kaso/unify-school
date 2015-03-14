<?php namespace UnifySchool\Entities\School;

class ScopedSchoolCategory extends BaseModel
{

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

}
