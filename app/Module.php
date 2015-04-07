<?php namespace UnifySchool;

/**
 * UnifySchool\Module
 *
 * @property integer $id
 * @property integer $school_type_id
 * @property string $name
 * @property string $path
 * @property string $menu
 * @property string $actions
 * @property string $data
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read SchoolType $school_type
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Module whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Module whereSchoolTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Module whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Module wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Module whereMenu($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Module whereActions($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Module whereData($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Module whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Module whereUpdatedAt($value)
 * @property boolean $active 
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Module whereActive($value)
 */
class Module extends BaseModel {

	protected $casts =  [
        'data'    => 'array',
        'menu'    => 'array',
        'actions' => 'array',
    ];


    public function school_type(){
        return $this->belongsTo(SchoolType::class);
    }

}
