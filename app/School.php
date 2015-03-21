<?php namespace UnifySchool;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use UnifySchool\Entities\Resources\NonTertiary\SessionGenerator;
use UnifySchool\Entities\School\CacheModelObserver;
use UnifySchool\Entities\School\ScopedSchoolType;
use UnifySchool\Events\TertiaryOrNonTertiarySchoolTypeDetected;

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
 * @property-read \Illuminate\Database\Eloquent\Collection|\UnifySchool\Entities\School\SchoolAdministrator[] $administrators
 * @property-read \UnifySchool\Entities\School\SchoolAdministrator $administrator
 * @property-read mixed $website
 * @property-read mixed $admin_website
 * @property-read mixed $student_website
 * @method static \UnifySchool\School withData()
 * @property boolean $active
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\School whereActive($value)
 * @method static \UnifySchool\School isActive()
 * @method static \UnifySchool\School isNotActive()
 * @property-read \UnifySchool\Entities\School\ScopedSessionType $session_type 
 */
class School extends BaseModel
{
    public static $relationData = [
        'country',
        'state',
        'administrator',
        'administrators',
        'school_type',
        'sessions',
        'session_type',
        'session_type.sub_sessions',
        'school_type.session_type',
        'school_type.school_categories',
        'school_type.school_categories.school_category_arms',
        'school_type.school_categories.school_category_arms.school_category_arm_subdivisions'
    ];
    protected $guarded = ['id', 'slug', 'hashcode'];

    protected $casts = [
        'school_object' => 'object',
        'active' => 'boolean',
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

        static::observe(new CacheModelObserver());
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

    public function scopeIsActive($query)
    {
        return $query->whereActive(true);
    }

    public function scopeIsNotActive($query)
    {
        return $query->whereActive(false);
    }

    public function scopeWithData($query)
    {
        return $query->with(static::$relationData);
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

    public function session_type()
    {
        return $this->hasOne('UnifySchool\Entities\School\ScopedSessionType');
    }

    public function sessions()
    {
        return $this->hasMany('UnifySchool\Entities\School\ScopedSession');
    }

    public function administrator()
    {
        return $this->hasOne('UnifySchool\Entities\School\SchoolAdministrator');
    }

    public function getWebsiteAttribute()
    {
        $domain = \Config::get('unify.domain');

        return "http://{$this->slug }.{$domain}/home";
    }

    public function getAdminWebsiteAttribute()
    {
        $domain = \Config::get('unify.domain');

        return "http://{$this->slug }.{$domain}/admin/dashboard";
    }

    public function getStudentWebsiteAttribute()
    {
        $domain = \Config::get('unify.domain');


        return "http://{$this->slug }.{$domain}/students";
    }

    public function setActivateState($active)
    {
        $this->active = $active;
        $this->save();
    }

    public function setSchoolType(ScopedSchoolType $schoolType)
    {
        $this->school_type_id = $schoolType->id;
        $this->save();

        if($schoolType->name != SchoolType::SCHOOL_CUSTOM){
            \Event::fire(new TertiaryOrNonTertiarySchoolTypeDetected($this));
        }
    }

    public static function table(){
        $s = new static;
        return $s->getTable();
    }
}
