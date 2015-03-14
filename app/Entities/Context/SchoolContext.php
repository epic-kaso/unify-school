<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/3/2015
 * Time: 12:00 AM
 */

namespace UnifySchool\Entities\Context;


use Illuminate\Database\Eloquent\Model;

class SchoolContext implements ContextInterface
{

    /**
     * The current context
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $context;

    /**
     * Set the context
     *
     * @param Illuminate\Database\Eloquent\Model
     */
    public function set(Model $context)
    {
        $this->context = $context;
    }

    /**
     * Set the context
     *
     * @param Illuminate\Database\Eloquent\Model
     */
    public function get()
    {
        return $this->context;
    }

    /**
     * Check to see if the context has been set
     *
     * @return boolean
     */
    public function has()
    {
        if ($this->context) return true;

        return false;
    }

    /**
     * Get the context identifier
     *
     * @return integer
     */
    public function id()
    {
        return $this->context->id;
    }

    /**
     * Get the context column
     *
     * @return string
     */
    public function column()
    {
        return 'school_id';
    }

    /**
     * Get the context table name
     *
     * @return string
     */
    public function table()
    {
        return 'schools';
    }
}