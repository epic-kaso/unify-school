<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/28/2015
 * Time: 10:03 AM
 */

namespace UnifySchool\Repositories;


use UnifySchool\Module;

class ModulesRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Module::class;
    }


    public function getBasicModules()
    {
        $response = [];
        $temp = Module::whereIsFundamental(true)->get();

        foreach($temp as $t){
            $response["{$t->id}"] = true;
        }

        return $response;
    }
}