<?php namespace UnifySchool;

/**
 * UnifySchool\State
 *
 * @property integer $id
 * @property integer $country_id
 * @property string $name
 * @property string $short_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \UnifySchool\Country $country
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\State whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\State whereCountryId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\State whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\State whereShortCode($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\State whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\State whereUpdatedAt($value)
 */
class State extends BaseModel
{

    public function country()
    {
        return $this->belongsTo('UnifySchool\Country');
    }

}
