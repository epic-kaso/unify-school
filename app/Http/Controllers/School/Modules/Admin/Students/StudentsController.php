<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/14/2015
 * Time: 11:05 AM
 */

namespace UnifySchool\Http\Controllers\School\Modules\Admin\Students;

use UnifySchool\Entities\School\ScopedClassStudent;
use UnifySchool\Entities\School\ScopedSession;
use UnifySchool\Entities\School\ScopedStudent;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\Modules\Admin\Students\StudentsRequest;

class StudentsController extends Controller
{

    public function index()
    {
        return ScopedStudent::all();
    }

    public function show($id)
    {
        return ScopedStudent::find($id);
    }

    public function store(StudentsRequest $request)
    {
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

        $requiredData = $request->only($requiredKeys);
        $requiredClassStudentData = $request->only($requiredClassStudentKeys);

        $requiredData['school_id'] = $currentSchool->id;
        $requiredData['reg_number'] = $this->generateRegNumber();


        $student = ScopedStudent::create($requiredData);

        $classStudent = $this->createClassStudent($request, $currentSchool, $student, $requiredClassStudentData);
        $classStudent->save();

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
        $classStudent->academic_session = $request->get('academic_session', ScopedSession::currentSession());
        return $classStudent;
    }

    private function generateRegNumber()
    {
        $reg = ScopedSession::currentSession();
        $studentCount = ScopedStudent::count() + 1;
        return "$reg/$studentCount";
    }
}