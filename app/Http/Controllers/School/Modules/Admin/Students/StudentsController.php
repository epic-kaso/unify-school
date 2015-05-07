<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/14/2015
 * Time: 11:05 AM
 */

namespace UnifySchool\Http\Controllers\School\Modules\Admin\Students;

use Carbon\Carbon;
use UnifySchool\Entities\School\ScopedClassStudent;
use UnifySchool\Entities\School\ScopedSession;
use UnifySchool\Entities\School\ScopedStudent;
use UnifySchool\Entities\School\ScopedSchoolCategory;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\Modules\Admin\Students\StudentsRequest;
use UnifySchool\Repositories\School\Criteria\StudentsBySchoolCategory;
use UnifySchool\Repositories\School\Criteria\StudentsWithRelationships;
use UnifySchool\Repositories\School\Criteria\SearchStudentsCriteria;
use UnifySchool\Repositories\School\ScopedStudentsRepository;

class StudentsController extends Controller
{

    public function index(ScopedStudentsRepository $studentsRepository)
    {
        $school_category_id = \Input::get('school_category_id');
        $search_query = \Input::get('search');

        $studentsRepository->pushCriteria(new StudentsWithRelationships());

        if(!empty($school_category_id)){
            $subarms = ScopedSchoolCategory::findOrFail($school_category_id)
                                            ->school_category_arms_subdivisions()
                                            ->get()
                                            ->toArray();

            $criteria = new StudentsBySchoolCategory($school_category_id,array_fetch($subarms,'id'));
            $studentsRepository->pushCriteria($criteria);
        }
        
        if(!empty($search_query)){

            $criteria = new SearchStudentsCriteria($search_query);
            $studentsRepository->pushCriteria($criteria);
        }
        
        return $studentsRepository->paginate(100);//all();
        
    }

    public function show($id)
    {
        return ScopedStudent::find($id);
    }

    public function store(StudentsRequest $request)
    {
        if(!$this->validateRequirements()){
            abort(422,['error' => 'Make Sure You have completed system setup']);
            return;
        }

        $currentSchool = $this->getSchool();

        $requiredKeys = [
            'last_name',
            'first_name',
            'birth_date',
            'sex'
        ];

        $requiredClassStudentKeys = [
            'school_category',
            'school_class'
        ];

        $optionalKeys = [
            'middle_name' => 'middle_name',
            'other_name' => 'other_names',
            'religion' => 'religion',
            'country' => 'country_of_origin',
            'state' => 'state_of_origin',
            'lga' => 'hometown',
            'admission_date' => 'registration_date',
            'blood_group' => 'blood_group',
            'genotype' => 'genotype',
            'disabilities' => 'disabilities',
            'medical_conditions' => 'medical_conditions',
            'contact_phone'  => 'contact_phone',
            'contact_email' => 'contact_email',
            'contact_address' => 'contact_email',
        ];

        $requiredData = $request->only($requiredKeys);
        $requiredClassStudentData = $request->only($requiredClassStudentKeys);

        $requiredData['school_id'] = $currentSchool->id;


        $student = ScopedStudent::create($requiredData);

        $classStudent = $this->createClassStudent($request, $currentSchool, $student, $requiredClassStudentData);
        $classStudent->save();

        foreach($optionalKeys as $key => $value){
            $student->{$value} = $request->get($key,'');
        }
        $this->preparePicture($student,$request);
        $student->save();

        return $student;
    }

    public function update($id)
    {
        $student = ScopedStudent::findOrFail($id);
        $all = \Input::all();
        
        foreach($all as $key => $value){
            if(array_key_exists($key, $student->getAttributes())){
                $student->{$key} = empty($value) ? $student->{$key} : $value;
            }
        }
        
        $student->save();
        
        if(isset($all['current_class_student']) && isset($all['current_class_student']['scoped_school_category_arm_subdivision_id'])){
            
            $sub_class = $student->current_class_student;
            
            $new_sub_class_id = $all['current_class_student']['scoped_school_category_arm_subdivision_id'];
            
            if(empty($sub_class)){
                $model = new ScopedClassStudent();
                $model->school_id = $this->getSchool()->id;
                $model->academic_session = ScopedSession::currentSession();
                $model->scoped_school_category_arm_subdivision_id = $new_sub_class_id;
                $model->scoped_student_id = $student->id;
                $model->save();
            }else{
                $current_sub_class_id =  $sub_class->scoped_school_category_arm_subdivision_id;
                if($current_sub_class_id !== $new_sub_class_id){
                    $sub_class->scoped_school_category_arm_subdivision_id = $new_sub_class_id;
                    $sub_class->save();
                }
            }
        }
        
        $student->load(ScopedStudent::$relationships);
        
        return $student;
    }

    public function destroy($id)
    {
        $action = \Input::get('action');
        
        switch($action){
            case 'destroy_students':
                $ids = \Input::get('ids');
                return ScopedStudent::destroy(explode(',',$ids));
            default:
                return ScopedStudent::destroy($id);
               
        }
        
    }

    /**
     * @param StudentsRequest $request
     * @param $currentSchool
     * @param $student
     * @param $requiredClassStudentKeys
     * @return ScopedClassStudent
     */
    public function createClassStudent(StudentsRequest $request, $currentSchool, $student, $requiredClassStudentKeys)
    {
        $classStudent = new ScopedClassStudent();
        $classStudent->school_id = $currentSchool->id;
        $classStudent->scoped_student_id = $student->id;
        $classStudent->scoped_school_category_arm_subdivision_id = $requiredClassStudentKeys['school_class'];
        $classStudent->academic_session = $request->get('session', ScopedSession::currentSession());
        return $classStudent;
    }

  
    private function preparePicture($student, $request)
    {
        $picture = $request->get('picture');
        if(!empty($picture)){
            $student->picture = ['dataURL' => $picture['dataURL']];
        }

        return $student;
    }

    private function validateRequirements()
    {
        $reg = ScopedSession::currentSession();
        if(empty($reg)){
            return false;
        }

        return true;
    }
}