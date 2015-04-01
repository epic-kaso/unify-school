<?php namespace UnifySchool\Entities\School;

use Illuminate\Database\Eloquent\Model;

/**
 * UnifySchool\Entities\School\ScopedSubSessionType
 *
 * @property integer $id
 * @property integer $school_id
 * @property integer $scoped_session_type_id
 * @property string $name
 * @property string $display_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read ScopedSessionType $session_type
 * @property-read \UnifySchool\School $school
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSubSessionType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSubSessionType whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSubSessionType whereScopedSessionTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSubSessionType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSubSessionType whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSubSessionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSubSessionType whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @property boolean $current
 * @property string $start_date
 * @property string $end_date
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSubSessionType whereCurrent($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSubSessionType whereStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSubSessionType whereEndDate($value)
 */
class ScopedSubSessionType extends BaseModel {

    public function session_type(){
        return $this->belongsTo(ScopedSessionType::class);
    }
}
