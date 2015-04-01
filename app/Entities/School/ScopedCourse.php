<?php namespace UnifySchool\Entities\School;


/**
 * UnifySchool\Entities\School\ScopedCourse
 *
 * @property integer $id
 * @property integer $school_id
 * @property integer $course_category_id
 * @property string $name
 * @property string $code
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \UnifySchool\School $school
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereCourseCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @property integer $scoped_course_category_id 
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourse whereScopedCourseCategoryId($value)
 */
class ScopedCourse extends BaseModel {

	//

}
