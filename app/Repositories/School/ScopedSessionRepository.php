<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 9:47 AM
 */

namespace UnifySchool\Repositories\School;


use UnifySchool\Entities\School\ScopedSession;
use UnifySchool\Repositories\BaseRepository;
class ScopedSessionRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return ScopedSession::class;
    }
}