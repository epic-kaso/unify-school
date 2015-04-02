<?php namespace UnifySchool\Entities\School;

/**
 * UnifySchool\Entities\School\ScopedCourseCategory
 *
 * @property integer $id
 * @property integer $school_id
 * @property integer $scoped_school_category_id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \UnifySchool\School $school
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourseCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourseCategory whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourseCategory whereScopedSchoolCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourseCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourseCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourseCategory whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @method static \UnifySchool\Entities\School\ScopedCourseCategory dSchoolCategory()
 * @method static \UnifySchool\Entities\School\ScopedCourseCategory dCourses()
 * @method static \UnifySchool\Entities\School\BaseModel getWithData()
 */
class ScopedCourseCategory extends BaseModel {

    public static $relationships =
        [
            'scoped_school_category',
            'scoped_courses'
        ];

	public function scoped_school_category(){
        return $this->belongsTo(ScopedSchoolCategory::class);
    }

    public function scoped_courses(){
        return $this->hasMany(ScopedCourse::class);
    }

}
