<?php namespace UnifySchool\Entities\School;

/**
 * UnifySchool\Entities\School\ScopedClassStudent
 *
 * @property integer $id
 * @property integer $school_id
 * @property integer $scoped_student_id
 * @property integer $scoped_school_category_arm_subdivision_id
 * @property string $academic_session
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedClassStudent whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedClassStudent whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedClassStudent whereScopedStudentId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedClassStudent whereScopedSchoolCategoryArmSubdivisionId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedClassStudent whereAcademicSession($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedClassStudent whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedClassStudent whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 */
class ScopedClassStudent extends BaseModel
{

    //

}
