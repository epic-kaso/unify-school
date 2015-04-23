<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 7:20 AM
 */

namespace UnifySchool\Repositories;


use Bosnadev\Repositories\Eloquent\Repository;
use UnifySchool\Entities\Context\SchoolContextTrait;

abstract class BaseRepository extends Repository
{
    use SchoolContextTrait;
}