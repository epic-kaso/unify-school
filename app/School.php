<?php namespace UnifySchool;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * UnifySchool\School
 *
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $hashcode
 * @property string $school_object
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\School whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\School whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\School whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\School whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\School whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\School whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\School whereHashcode($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\School whereSchoolObject($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\School whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\School whereUpdatedAt($value)
 * @property integer $school_type_id
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\School whereSchoolTypeId($value)
 * @method static \UnifySchool\School bySlug($slug)
 * @property integer $state_id
 * @property integer $country_id
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\School whereStateId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\School whereCountryId($value)
 * @property-read \UnifySchool\SchoolType $school_type 
 */
class School extends Model
{

    protected $guarded = ['id', 'slug', 'hashcode'];

    protected $casts = [
        'school_object' => 'object'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function (School $model) {
            if ($model->isDirty('name')) {
                return $model->generateSlug();
            }
        });
    }

    private function generateSlug()
    {
        $this->attributes['slug'] = Str::slug($this->name . ' ' . $this->city . ' ' . $this->state->short_code . ' ' . $this->country->short_code);

        if (!is_null(static::whereSlug($this->attributes['slug'])->first())) {
            return false;
        }
        return true;
    }

    public function scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug)->first();
    }

    public function country()
    {
        return $this->belongsTo('UnifySchool\Country');
    }

    public function state()
    {
        return $this->belongsTo('UnifySchool\State');
    }

    public function school_type()
    {
        return $this->belongsTo('UnifySchool\SchoolType');
    }
}
