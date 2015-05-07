<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/19/2015
 * Time: 3:55 PM
 */

namespace UnifySchool\Entities\Legacy\Adapters;


use Carbon\Carbon;
use Illuminate\Support\Str;
use UnifySchool\Entities\School\ScopedClassStudent;
use UnifySchool\Entities\School\ScopedSchoolCategoryArmSubdivision;
use UnifySchool\Entities\School\ScopedSession;
use UnifySchool\Entities\School\ScopedStudent;
use UnifySchool\School;

class StudentExcelObjectAdapter
{

    protected $keys = [
        'title',
        'firstname',
        'middlename',
        'lastname',
        'sex',
        'dob',
        'religion',
        'country',
        'state',
        'lga',
        'session',
        'term',
        'school',
        'type',
        'class',
        'date of admission',
        'bloodgroup',
        'genotype',
        'disabled',
        'disabilities',
        'phone',
        'email id',
        'confirm id',
        'contact address',
        'unique number',
        'confirm number',
        'status'
    ];


    public $title;
    public $firstname;
    public $middlename;
    public $lastname;
    public $sex;
    public $dob;
    public $religion;
    public $country;
    public $state;
    public $lga;
    public $session;
    public $term;
    public $school;
    public $type;
    public $class;
    public $date_of_admission;
    public $bloodgroup;
    public $genotype;
    public $disabled;
    public $disabilities;
    public $phone;
    public $email_id;
    public $confirm_id;
    public $contact_address;
    public $unique_number;
    public $confirm_number;
    public $status;
    
    private $hasAdapted;

    public function __construct($row)
    {
        $this->hasAdapted = false;
        $this->adapt($row);
        $this->hasAdapted = true;
    }

    public function getStudentModel(School $school,
                                    ScopedSession $currentSession,
                                    ScopedSession $regNumberSession,
                                    ScopedSchoolCategoryArmSubdivision $schoolClass = null)
    {
        if(!$this->hasAdapted){
            throw new \Exception("Student needs to adapt first");
        }
        $studentHasClass = true;
        $this->validate();
        
        try{
            $studentClass = $this->tryDetectClass($schoolClass);
        }catch(NoClassDetectedException $e){
            $studentHasClass = false;
        }
        
        $studentSession = $this->tryDetectSession($school,$regNumberSession);
        
        
        $model = [];
        $model['school_id'] = $school->id;
        $model['last_name'] = $this->lastname;
        $model['first_name'] = $this->firstname;
        $model['middle_name'] = $this->middlename;
        $model['birth_date'] = Carbon::parse($this->dob);
        $model['sex'] = $this->sex;
        $model['religion'] = $this->religion;
        $model['country_of_origin'] = $this->country;
        $model['state_of_origin'] = $this->state;
        $model['registration_date'] = Carbon::parse($this->date_of_admission);
        $model['blood_group']  = $this->bloodgroup;
        $model['genotype'] = $this->genotype;
        $model['disabilities'] = $this->disabilities;
        $model['contact_phone'] = $this->phone;
        $model['contact_address'] = $this->contact_address;
        
        $student = ScopedStudent::firstOrNew($model);
        $student->reg_number = $student->generateRegNumber($studentSession->name);
        $student->save();
        
        if($studentHasClass){
            $this->getClassStudentModel($school,$student,$currentSession,$studentClass);
            $student->load('current_class_student');
        }
        
        return [$student,$studentHasClass];
    }
    
    protected function adapt($rowobject)
    {
        foreach ($this->keys as $key) {
            $slug = Str::slug($key, '_');
            //if(property_exists($rowobject,$slug)){
            $this->{$slug} = $rowobject->{$slug};
            //}
        }
    }
    
    private function validate(){
        if(empty($this->lastname ) ||
           empty($this->firstname )){
                throw new ImportException('Last Name and First name are required');
         }
    }
    
    private function getClassStudentModel(
                                    School $school,
                                    ScopedStudent $student,
                                    ScopedSession $currentSession,
                                    ScopedSchoolCategoryArmSubdivision $schoolClass)
    {
        $model = new ScopedClassStudent();
        $model->school_id = $school->id;
        $model->academic_session = $currentSession->name;
        $model->scoped_school_category_arm_subdivision_id = $schoolClass->id;
        $model->scoped_student_id = $student->id;
        
        $model->save();
        
        return $model;
    }
    
    private function tryDetectClass(ScopedSchoolCategoryArmSubdivision $default = null)
    {
        $studentClass = ScopedSchoolCategoryArmSubdivision
                            ::whereNameOrDisplayName($this->class,$this->class)
                            ->first();
                            
        if(empty($studentClass) && empty($default)){
            throw new NoClassDetectedException("Student's class couldn't be detected.");
        }                    
        return empty($studentClass) ? $default: $studentClass;                    
    }


    private function tryDetectSession(School $school, ScopedSession $default){
        if(!empty($this->session)){
            $studentSession = ScopedSession::firstOrCreate(
                [ 
                    'name' => $this->session,
                    'school_id' => $school->id 
                ]
            );
            return $studentSession;
        }
        
        return $default;
    }
}