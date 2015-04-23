<?php namespace UnifySchool\Entities\School;


/**
 * UnifySchool\Entities\School\ScopedCourse
 *
 * @property integer $id
 * @property integer $school_id
 * @property integer $scoped_course_category_id
 * @property string $name
 * @property string $code
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \UnifySchool\School $school
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereScopedCourseCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\ScopedCourse dCourseCategory()
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @method static \UnifySchool\Entities\School\BaseModel getWithData()
 */
class ScopedCourse extends BaseModel
{

    public static $relationships = ['scoped_course_category'];

    public function scoped_course_category()
    {
        return $this->belongsTo(ScopedCourseCategory::class);
    }

}
