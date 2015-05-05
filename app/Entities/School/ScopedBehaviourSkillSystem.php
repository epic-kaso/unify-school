<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 5/2/2015
 * Time: 4:27 PM
 */

namespace UnifySchool\Entities\School;


use Illuminate\Database\Eloquent\Collection;

/**
 * UnifySchool\Entities\School\ScopedBehaviourSkillSystem
 *
 * @property integer $id 
 * @property integer $school_id 
 * @property string $name 
 * @property \Illuminate\Database\Eloquent\Collection|ScopedBehaviour[] $behaviours 
 * @property \Illuminate\Database\Eloquent\Collection|ScopedSkill[] $skills 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \UnifySchool\School $school 
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedBehaviourSkillSystem whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedBehaviourSkillSystem whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedBehaviourSkillSystem whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedBehaviourSkillSystem whereBehaviours($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedBehaviourSkillSystem whereSkills($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedBehaviourSkillSystem whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedBehaviourSkillSystem whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @method static \UnifySchool\Entities\School\BaseModel getWithData()
 */
class ScopedBehaviourSkillSystem extends BaseModel {

    public static function boot()
    {
        parent::boot();

        static::deleting(function(ScopedBehaviourSkillSystem $model){
            $model->behaviours->each(function($item){
                $item->delete();
            });

            $model->skills->each(function($item){
                $item->delete();
            });
        });
    }


    public static $relationships = [
        'behaviours',
        'behaviours.behaviour_category',
        'skills',
        'skills.skill_category',
    ];

    public function behaviours()
    {
        return $this->hasMany(ScopedBehaviour::class);
    }

    public function skills()
    {
        return $this->hasMany(ScopedSkill::class);
    }
}