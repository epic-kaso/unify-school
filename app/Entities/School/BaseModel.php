<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/14/2015
 * Time: 2:19 PM
 */

namespace UnifySchool\Entities\School;


use Illuminate\Database\Eloquent\Model;
use UnifySchool\Entities\Scopes\School\SchoolScopeTrait;

/**
 * UnifySchool\Entities\School\BaseModel
 *
 * @property-read \UnifySchool\School $school
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 */
class BaseModel extends Model
{

    use SchoolScopeTrait;

    protected $guarded = ['id'];
    public static $relationships = [];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (!isset($model->attributes['school_id'])) {
                $model->attributes['school_id'] = $model->getSchool()->id;
            }
        });

        static::observe(new CacheModelObserver());
    }

    public function getSchool()
    {
        $context = \App::make('UnifySchool\Entities\Context\ContextInterface');
        return $context->get();
    }

    public function school()
    {
        return $this->belongsTo('UnifySchool\School');
    }

    public function scopeUnScoped($query)
    {
        return $query->withAllSchools();
    }

    public function scopeGetWithData($query){
        return $query->with(static::$relationships)->get();
    }

    public static function table(){
        $s = new static;
        return $s->getTable();
    }
}