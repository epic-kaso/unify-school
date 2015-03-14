<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/2/2015
 * Time: 11:55 PM
 */

namespace UnifySchool\Entities\Scopes\School;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;
use UnifySchool\Entities\Context\ContextInterface;

class SchoolGlobalScope implements ScopeInterface
{

    protected $context;

    function __construct(ContextInterface $context)
    {
        $this->context = $context;
    }


    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where($this->context->column(), $this->context->id());
    }

    /**
     * Remove the scope from the given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     *
     * @return void
     */
    public function remove(Builder $builder, Model $model)
    {
        $column = $this->context->column();

        $query = $builder->getQuery();

        foreach ((array)$query->wheres as $key => $where) {
            // If the where clause is a soft delete date constraint, we will remove it from
            // the query and reset the keys on the wheres. This allows this developer to
            // include deleted model in a relationship result set that is lazy loaded.
            if ($this->isScopeConstraint($where, $column)) {
                unset($query->wheres[$key]);
                $query->wheres = array_values($query->wheres);
            }
        }
    }

    /**
     * Determine if the given where clause is a soft delete constraint.
     *
     * @param  array $where
     * @param  string $column
     * @return bool
     */
    protected function isScopeConstraint(array $where, $column)
    {
        return $where['column'] == $column;
    }

}