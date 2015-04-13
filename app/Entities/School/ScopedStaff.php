<?php namespace UnifySchool\Entities\School;
use Carbon\Carbon;


/**
 * UnifySchool\Entities\School\ScopedStaff
 *
 * @property integer $id
 * @property integer $hashcode
 * @property integer $school_id
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property string $religion
 * @property string $country
 * @property string $state
 * @property string $lga
 * @property string $marital_status
 * @property string $picture
 * @property string $contact_phone
 * @property string $contact_address
 * @property string $contact_email
 * @property string $blood_group
 * @property string $genotype
 * @property string $disabilities
 * @property string $sex
 * @property string $employment_date
 * @property string $qualifications
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property array $assigned_courses
 * @property array $assigned_classes
 * @property-read \UnifySchool\School $school
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereHashcode($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereMiddleName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereReligion($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereLga($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereMaritalStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff wherePicture($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereContactPhone($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereContactAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereContactEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereBloodGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereGenotype($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereDisabilities($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereEmploymentDate($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereQualifications($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereAssignedCourses($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereAssignedClasses($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @method static \UnifySchool\Entities\School\BaseModel getWithData()
 * @property string $birth_date
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStaff whereBirthDate($value)
 */
class ScopedStaff extends BaseModel {

    protected $casts = [
        'qualifications' => 'array',
        'disabilities' => 'array',
        'picture' => 'array',
        'assigned_courses' => 'array',
        'assigned_classes' => 'array',
    ];

    public static function boot(){
        parent::boot();

        static::creating(function(ScopedStaff $model){
           $model->generateHashcode();
        });
    }

    public static $relationships = [

    ];

    public function setBirthDateAttribute($value){
        $this->attributes['birth_date'] = Carbon::parse($value);
    }

    public function setEmploymentDateAttribute($value){
        $this->attributes['employment_date'] = Carbon::parse($value);
    }

    public function loadAssignedCourses(){
        if(!is_null($this->assigned_courses)){
            $input = [];
            foreach($this->assigned_courses as $key => $value){
                $temp = ScopedCourse::find($value);
                if(!is_null($temp)) {
                    $input[] = $temp;
                }
            }
            $this->assigned_courses = $input;
        }
    }

    public function loadAssignedClasses()
    {
        if(!is_null($this->assigned_classes)){
            $input = [];
            foreach($this->assigned_classes as $key => $value){
                $temp = ScopedSchoolCategoryArmSubdivision::find($value);
                if(!is_null($temp)) {
                    $input[] = $temp;
                }
            }
            $this->assigned_classes = $input;
        }
    }
}
