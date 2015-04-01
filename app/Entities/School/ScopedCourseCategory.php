<?php namespace UnifySchool\Entities\School;


/**
 * UnifySchool\CourseCategory
 *
 * @property integer $id
 * @property integer $school_type_id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\ScopedCourseCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\ScopedCourseCategory whereSchoolTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\ScopedCourseCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\ScopedCourseCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\ScopedCourseCategory whereUpdatedAt($value)
 * @property integer $school_id 
 * @property integer $scoped_school_category_id 
 * @property-read \UnifySchool\School $school 
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourseCategory whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedCourseCategory whereScopedSchoolCategoryId($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 */
class ScopedCourseCategory extends BaseModel {

	//

}
