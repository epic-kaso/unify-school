<?php namespace UnifySchool;

use Illuminate\Database\Eloquent\Model;

/**
 * UnifySchool\SchoolType
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property integer $session_type_id
 * @property string $school_categories
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereSessionTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereSchoolCategories($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolType whereUpdatedAt($value)
 */
class SchoolType extends Model
{

    public function session_type()
    {
        return $this->belongsTo('UnifySchool\SessionType');
    }
    //

}
