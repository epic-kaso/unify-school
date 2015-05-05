<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 5/5/2015
 * Time: 12:47 AM
 */

namespace UnifySchool\Http\Controllers\School\Resources\Configurations;


use UnifySchool\BehaviourCategory;
use UnifySchool\Entities\School\ScopedBehaviour;
use UnifySchool\Entities\School\ScopedBehaviourSkillSystem;
use UnifySchool\Events\Academics\BehaviourAssessmentSystemAdded;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\BehaviourSkillSystemRequest;
use UnifySchool\School;
use UnifySchool\SkillCategory;
use UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision;
use UnifySchool\Repositories\School\ScopedSchoolCategoriesRepository;

class BehaviourSkillSystemController  extends Controller
{

    /**
     * @var School
     */
    protected $current_school;
    
    const Action_Assign_Behaviour_Skill_System_To_Class = 'assignBehaviourSkillSystemToClass';
    const Action_Assign_Behaviour_Skill_System = 'assignBehaviourSkillSystem';

    function __construct()
    {
        $this->current_school = $this->getSchool();
    }

    public function index(ScopedSchoolCategoriesRepository $schoolCategoriesRepository)
    {
        $action = \Input::get('action','default');
        
        switch($action){
            case self::Action_Assign_Behaviour_Skill_System:
                return \Response::json($schoolCategoriesRepository->getAssignedBehaviourSkillSystem());
            default:
                return ScopedBehaviourSkillSystem::getWithData();
        }
    }

    public function store(BehaviourSkillSystemRequest $request,ScopedSchoolCategoriesRepository $schoolCategoriesRepository)
    {
        
        $action = $request->get('action','default');
        
        switch($action){
            case self::Action_Assign_Behaviour_Skill_System:
                return $this->assignBehaviourSkillSystem($request,$schoolCategoriesRepository);   
            default:
                $item = new ScopedBehaviourSkillSystem();
                $item->name = $request->get('name');
                $item->school_id = $this->current_school->id;
                $item->save();
                return $item;
        }
    }

    public function show($id)
    {
        return ScopedBehaviourSkillSystem::findOrFail($id);
    }

    public function update($id, BehaviourSkillSystemRequest $request)
    {
        $action = $request->get('action','default');
        
        switch($action){
            case self::Action_Assign_Behaviour_Skill_System_To_Class:
                return $this->assignBehaviourSkillSystemToClass($id, $request);  
            default:
                 $item = ScopedBehaviourSkillSystem::findOrFail($id);
                 return \Response::json(['all' => ScopedBehaviourSkillSystem::getWithData()]);
        }
        
       
    }

    public function destroy($id)
    {
        ScopedBehaviourSkillSystem::destroy($id);
        return \Response::json(['all' => ScopedBehaviourSkillSystem::getWithData()]);
    }
    
    
    private function assignBehaviourSkillSystemToClass($id, $request)
    {
        $class_arm = ScopedSchoolCategoryArmSubdivision::findOrFail($id);
        $class_arm->scoped_behaviour_skill_system_id = $request->get('scoped_behaviour_skill_system_id');
        $class_arm->save();

        return \Response::json(['success' => true]);
    }
    
    
    private function assignBehaviourSkillSystem(BehaviourSkillSystemRequest $request, ScopedSchoolCategoriesRepository $schoolCategoriesRepository)
    {
        $data = $request->input();
        foreach ($data as $key => $value) {
            $schoolCategoriesRepository->assignBehaviourSkillSystem($value, 'name', $key);
        }
        return \Response::json(['success' => true]);
    }

}