<?php namespace UnifySchool;

use Illuminate\Database\Eloquent\Model;

/**
 * UnifySchool\SchoolCategory
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $arms
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategory whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategory whereArms($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategory whereUpdatedAt($value)
 */
class SchoolCategory extends Model
{

    public function school_type()
    {
        return $this->belongsTo('UnifySchool\SchoolType');
    }

}
