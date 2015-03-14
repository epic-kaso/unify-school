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

    protected $appends = ['website', 'admin_website', 'student_website'];

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

    public function scopeWithData($query)
    {
        return $query->with(
            'country',
            'state',
            'administrator',
            'administrators',
            'school_type',
            'school_type.session_type',
            'school_type.school_categories',
            'school_type.school_categories.school_category_arms',
            'school_type.school_categories.school_category_arms.school_category_arm_subdivisions'
        );
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
        return $this->belongsTo('UnifySchool\Entities\School\ScopedSchoolType', 'school_type_id');
    }

    public function administrators()
    {
        return $this->hasMany('UnifySchool\Entities\School\SchoolAdministrator');
    }

    public function administrator()
    {
        return $this->hasOne('UnifySchool\Entities\School\SchoolAdministrator');
    }

    public function getWebsiteAttribute()
    {
        $domain = \Config::get('unify.domain');

        if ($domain == 'localhost:8000') {
            return "http://{$domain}?school_slug={$this->slug}/home";
        }

        return "http://{$this->slug }.{$domain}";
    }

    public function getAdminWebsiteAttribute()
    {
        $domain = \Config::get('unify.domain');

        if ($domain == 'localhost:8000') {
            return "http://{$domain}/admin?school_slug={$this->slug}";
        }

        return "http://{$this->slug }.{$domain}/admin/dashboard";
    }

    public function getStudentWebsiteAttribute()
    {
        $domain = \Config::get('unify.domain');

        if ($domain == 'localhost:8000') {
            return "http://{$domain}/students?school_slug={$this->slug}";
        }

        return "http://{$this->slug }.{$domain}/students";
    }
}
