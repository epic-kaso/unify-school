<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/2/2015
 * Time: 11:56 PM
 */

namespace UnifySchool\Entities\Scopes\School;


trait SchoolScopeTrait
{

    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootSchoolScopeTrait()
    {
        $context = \App::make('UnifySchoolProject\Entities\Context\ContextInterface');
        static::addGlobalScope(new SchoolGlobalScope($context));
    }
}