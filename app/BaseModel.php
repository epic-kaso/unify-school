<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 12:36 PM
 */

namespace UnifySchool;


use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{

    public static function table()
    {
        $s = new static;
        return $s->getTable();
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function (School $model) {
            $model->clearCache();
        });
    }

    protected function clearCache()
    {
        \Cache::forget('global_school_context');
    }
}