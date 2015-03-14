<?php namespace UnifySchool;

use Illuminate\Database\Eloquent\Model;

/**
 * UnifySchool\SchoolCategoryArm
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $arms
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategoryArm whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategoryArm whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategoryArm whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategoryArm whereArms($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategoryArm whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\SchoolCategoryArm whereUpdatedAt($value)
 */
class SchoolCategoryArm extends Model
{

    public function school_category()
    {
        return $this->belongsTo('UnifySchool\SchoolCategory');
    }

}
