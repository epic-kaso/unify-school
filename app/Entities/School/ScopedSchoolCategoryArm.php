<?php namespace UnifySchool\Entities\School;

use Illuminate\Support\Str;

/**
 * UnifySchool\Entities\School\ScopedSchoolCategoryArm
 *
 * @property integer $id
 * @property integer $scoped_school_category_id
 * @property integer $school_id
 * @property string $name
 * @property string $display_name
 * @property string $meta
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \UnifySchool\Entities\School\ScopedSchoolCategory $school_category
 * @property-read \Illuminate\Database\Eloquent\Collection|\UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision[] $school_category_arm_subdivisions
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArm whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArm whereScopedSchoolCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArm whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArm whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArm whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArm whereMeta($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArm whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedSchoolCategoryArm whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @property-read \UnifySchool\School $school
 * @property-read mixed $has_subdivisions
 * @property-read mixed $arms_count
 * @method static \UnifySchool\Entities\School\BaseModel getWithData()
 */
class ScopedSchoolCategoryArm extends BaseModel
{
    protected $casts = [
        'meta' => 'object'
    ];

    protected $appends = ['has_subdivisions', 'arms_count'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            foreach ($model->school_category_arm_subdivisions as $arm) {
                $arm->delete();
            }
        });
    }

    public function school_category()
    {
        return $this->belongsTo('UnifySchool\Entities\School\ScopedSchoolCategory');
    }

    public function school_category_arm_subdivisions()
    {
        return $this->hasMany('UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision');
    }

    public function getHasSubdivisionsAttribute()
    {
        return $this->school_category_arm_subdivisions->count() > 1;
    }

    public function getArmsCountAttribute()
    {
        return $this->school_category_arm_subdivisions->count() == 1 ? 0 : $this->school_category_arm_subdivisions->count();
    }

    public function deleteDefaultSubdivision()
    {
        if ($this->school_category_arm_subdivisions->count() == 1) {
            foreach ($this->school_category_arm_subdivisions as $item) {
                $item->delete();
            }
        }
    }

    public function restoreDefaultSubDivision()
    {
        $this->deleteAllSubdivisions();
        $this->makeDefaultSubDivision();
    }

    private function deleteAllSubdivisions()
    {
        foreach ($this->school_category_arm_subdivisions as $item) {
            $item->delete();
        }
    }

    private function makeDefaultSubDivision()
    {
        $categoryArm = new ScopedSchoolCategoryArmSubdivision();
        $categoryArm->scoped_school_category_arm_id = $this->id;
        $categoryArm->name = Str::slug($this->display_name);
        $categoryArm->display_name = $this->display_name;
        $categoryArm->school_id = $this->school->id;
        $categoryArm->save();

        return $categoryArm;
    }
}
