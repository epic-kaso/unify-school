<?php namespace UnifySchool\Entities\School;


/**
 * UnifySchool\Entities\School\ScopedSessionType
 *
 * @property integer $id
 * @property integer $school_id
 * @property string $session_type
 * @property string $session_name
 * @property string $session_display_name
 * @property string $session_divisions_name
 * @property string $session_divisions_display_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSessionType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSessionType whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSessionType whereSessionType($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSessionType whereSessionName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSessionType whereSessionDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSessionType whereSessionDivisionsName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSessionType whereSessionDivisionsDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSessionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSessionType whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @property-read \Illuminate\Database\Eloquent\Collection|ScopedSubSessionType[] $sub_sessions
 * @property-read \UnifySchool\School $school
 * @method static \UnifySchool\Entities\School\BaseModel getWithData()
 */
class ScopedSessionType extends BaseModel
{

    public static function boot(){
        parent::boot();

        static::deleted(function($model){
           $model->sub_sessions()->delete();
        });
    }


    public function sub_sessions(){
        return $this->hasMany(ScopedSubSessionType::class);
    }
}
