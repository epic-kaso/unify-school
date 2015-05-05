<?php namespace UnifySchool\Entities\School;
use UnifySchool\SkillCategory;

/**
 * UnifySchool\Entities\School\ScopedSkill
 *
 * @property integer $id
 * @property integer $school_id
 * @property integer $skill_category_id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \UnifySchool\SkillCategory $skill_category
 * @property-read \UnifySchool\School $school
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSkill whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSkill whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSkill whereSkillCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSkill whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSkill whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSkill whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @method static \UnifySchool\Entities\School\BaseModel getWithData()
 * @property integer $scoped_behaviour_skill_system_id 
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSkill whereScopedBehaviourSkillSystemId($value)
 */
class ScopedSkill extends BaseModel
{

    public function skill_category()
    {
        return $this->belongsTo(SkillCategory::class);
    }

}
