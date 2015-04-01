<?php namespace UnifySchool;

use Illuminate\Database\Eloquent\Model;

/**
 * UnifySchool\CourseCategory
 *
 * @property integer $id 
 * @property integer $school_type_id 
 * @property string $name 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\CourseCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\CourseCategory whereSchoolTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\CourseCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\CourseCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\CourseCategory whereUpdatedAt($value)
 */
class CourseCategory extends Model {

	//

}
