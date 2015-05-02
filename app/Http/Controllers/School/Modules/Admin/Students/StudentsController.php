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
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\Modules\Admin\Students\StudentsRequest;
use UnifySchool\Repositories\School\ScopedStudentsRepository;

class StudentsController extends Controller
{

    public function index(ScopedStudentsRepository $studentsRepository)
    {
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
        $requiredData['reg_number'] = $this->generateRegNumber();


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

    }

    public function destroy($id)
    {
        return ScopedStudent::destroy($id);
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

    private function generateRegNumber()
    {
        $reg = ScopedSession::currentSession();

        $count = ScopedStudent::all()->count();
        $studentCount = is_int($count) ? $count + 1 : 1;
        return "$reg/$studentCount";
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