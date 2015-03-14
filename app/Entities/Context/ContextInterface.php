<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/2/2015
 * Time: 11:58 PM
 */

namespace UnifySchool\Entities\Context;


use Illuminate\Database\Eloquent\Model;

interface ContextInterface
{

    /**
     * Set the context
     *
     * @param Illuminate\Database\Eloquent\Model
     */
    public function set(Model $context);


    /**
     * Set the context
     *
     * @param Illuminate\Database\Eloquent\Model
     */
    public function get();

    /**
     * Check to see if the context has been set
     *
     * @return boolean
     */
    public function has();

    /**
     * Get the context identifier
     *
     * @return integer
     */
    public function id();

    /**
     * Get the context column
     *
     * @return string
     */
    public function column();

    /**
     * Get the context table name
     *
     * @return string
     */
    public function table();
}