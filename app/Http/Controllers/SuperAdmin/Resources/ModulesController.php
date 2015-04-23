<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/17/2015
 * Time: 1:14 PM
 */

namespace UnifySchool\Http\Controllers\SuperAdmin\Resources;

use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\ModuleSettingsRequest;
use UnifySchool\Module;

class ModulesController extends Controller
{

    public function index()
    {
        return Module::all();
    }

    public function show($id)
    {
        return Module::find($id);
    }

    public function store(ModuleSettingsRequest $request)
    {
        $module = new Module();

        $module->name = $request->get('name');
        $module->school_type_id = $request->get('school_type_id');
        $module->path = $request->get('path');
        $module->data = $request->get('data');
        $module->menu = $request->get('menu');
        $module->save();

        return $module;
    }

    public function update($id)
    {

    }

    public function destroy($id)
    {
        return Module::destroy($id);
    }

}