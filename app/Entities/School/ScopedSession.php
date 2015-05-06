<?php namespace UnifySchool\Entities\School;


/**
 * UnifySchool\Entities\School\ScopedSession
 *
 * @property integer $id
 * @property integer $school_id
 * @property string $name
 * @property boolean $current_session
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \UnifySchool\School $school
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSession whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSession whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSession whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSession whereCurrentSession($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSession whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @method static \UnifySchool\Entities\School\BaseModel getWithData()
 * @method static \UnifySchool\Entities\School\ScopedSession currentSession()
 */
class ScopedSession extends BaseModel
{

    public function scopeCurrentSession($query)
    {
        $data = $query->whereCurrentSession(true)->first();
        return empty($data) ? '' : $data->name;
    }

    public function scopeCurrentSessionModel($query)
    {
        $data = $query->whereCurrentSession(true)->first();
        return $data;
    }
}
