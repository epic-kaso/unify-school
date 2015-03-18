<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/19/2015
 * Time: 12:08 AM
 */

namespace UnifySchool\Entities\School;


class CacheModelObserver {

    public function clearCacheTags($tags){
        if($this->productionEnvironment()){
            \Cache::tags($tags)->flush();
        }
    }

    public function saved($model)
    {
        $this->clearCacheTags($model->getTable());
    }

    public function deleted($model)
    {
        $this->clearCacheTags($model->getTable());
    }

    public function restored($model)
    {
        $this->clearCacheTags($model->getTable());
    }

    private function productionEnvironment()
    {
        return \App::environment() === 'production';
    }
}