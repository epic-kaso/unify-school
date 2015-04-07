<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/6/2015
 * Time: 10:53 PM
 */

namespace UnifySchool\Services\Modules;


use UnifySchool\Module;
use UnifySchool\School;

class Loader {

    public static function loadSchoolModule(School $school)
    {
        $modules = [];
        if(empty($school->modules))
            return;

        foreach($school->modules as $key => $value){
            if(is_bool($value) && $value && is_numeric($key)){
                $modules[] = Module::find($key);
            }
        }

        return $modules;
    }

    public static function prepareAssetsLink(Module $module)
    {
        $assets = [];
        $assets[] = \File::get(base_path('resources/views/'.$module->path.'/'.$module->name.'/js/module.js'));
        return implode('',$assets);
    }
}