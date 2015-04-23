<?php namespace UnifySchool;

/**
 * UnifySchool\Country
 *
 * @property integer $id
 * @property string $name
 * @property string $short_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\UnifySchool\State[] $states
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Country whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Country whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Country whereShortCode($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Country whereUpdatedAt($value)
 * @method static \UnifySchool\Country withStates()
 */
class Country extends BaseModel
{

    public function states()
    {
        return $this->hasMany('UnifySchool\State');
    }

    public function scopeWithStates($query)
    {
        return $query->with('states');
    }
}
