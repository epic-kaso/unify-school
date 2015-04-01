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

    public function getCurrentSession(){
        return $this->findBy('current_session',true);
    }

    public function setCurrentSession($name = null){

    $this->all()->each(function($item){
        $item->current_session = false;
        $item->save();
    });

    $item = $this->makeModel()->firstOrCreate(['name' => $name,'school_id' => $this->getSchool()->id]);
    $item->current_session = true;
    $item->save();

    return $item;
}
}