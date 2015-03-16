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
 */
class BaseModel extends Model
{

    use SchoolScopeTrait;

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (!isset($model->attributes['school_id'])) {
                $model->attributes['school_id'] = $model->getSchool()->id;
            }
        });
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
}