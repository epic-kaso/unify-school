<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 7:20 AM
 */

namespace UnifySchool\Repositories\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use UnifySchool\Entities\School\ScopedSessionType;
use UnifySchool\Entities\School\ScopedSubSessionType;
use UnifySchool\Repositories\BaseRepository;

class ScopedSubSessionTypeRepository extends BaseRepository {

    public function model()
    {
        return ScopedSubSessionType::class;
    }

    public function getCurrentSubSession(){
        return $this->findBy('current',true);
    }

    public function setCurrentSubSession($id){

        $this->all()->each(function($item){
            $item->current = false;
            $item->save();
        });

        $item = $this->find($id);
        $item->current = true;
        $item->save();

        return $item;
    }
}