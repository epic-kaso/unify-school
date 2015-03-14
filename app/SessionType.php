<?php namespace UnifySchool;

use Illuminate\Database\Eloquent\Model;

/**
 * UnifySchool\SessionType
 *
 * @property integer $id
 * @property string $session_type
 * @property string $session_name
 * @property string $session_display_name
 * @property string $session_divisions_name
 * @property string $session_divisions_display_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SessionType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SessionType whereSessionType($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SessionType whereSessionName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SessionType whereSessionDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SessionType whereSessionDivisionsName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SessionType whereSessionDivisionsDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SessionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SessionType whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\UnifySchool\SchoolType[] $school_types 
 */
class SessionType extends Model
{

    public function school_types()
    {
        return $this->hasMany('UnifySchool\SchoolType');
    }

}
