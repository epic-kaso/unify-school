<?php namespace  UnifySchool\Entities\School;

/**
 * UnifySchool\Entities\School\ScopedBehaviour
 *
 * @property integer $id
 * @property integer $school_id
 * @property integer $behaviour_category_id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \UnifySchool\BehaviourCategory $behaviour_category
 * @property-read \UnifySchool\School $school
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedBehaviour whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedBehaviour whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedBehaviour whereBehaviourCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedBehaviour whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedBehaviour whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedBehaviour whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 */
class ScopedBehaviour extends BaseModel {


    public function behaviour_category(){
        return $this->belongsTo('UnifySchool\BehaviourCategory');
    }
}
