<?php namespace UnifySchool;

use Illuminate\Database\Eloquent\Model;

/**
 * UnifySchool\SchoolAdministrator
 *
 * @property integer $id
 * @property integer $school_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolAdministrator whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolAdministrator whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolAdministrator whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolAdministrator whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolAdministrator wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolAdministrator whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolAdministrator whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolAdministrator whereUpdatedAt($value)
 */
class SchoolAdministrator extends Model
{

    //

}
