<?php namespace UnifySchool\Entities\School;


/**
 * UnifySchool\Entities\School\ScopedStudent
 *
 * @property integer $id
 * @property integer $school_id
 * @property string $reg_number
 * @property string $password
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property string $other_names
 * @property string $religion
 * @property string $complexion
 * @property string $height
 * @property boolean $disabled
 * @property string $disabilities
 * @property string $blood_group
 * @property string $genotype
 * @property string $birth_date
 * @property string $place_of_birth
 * @property string $hometown
 * @property string $state_of_origin
 * @property string $country_of_origin
 * @property string $residential_address
 * @property string $residential_city
 * @property string $residential_state
 * @property string $residential_country
 * @property string $registration_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereRegNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereMiddleName($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereOtherNames($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereReligion($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereComplexion($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereHeight($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereDisabled($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereDisabilities($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereBloodGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereGenotype($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereBirthDate($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent wherePlaceOfBirth($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereHometown($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereStateOfOrigin($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereCountryOfOrigin($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereResidentialAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereResidentialCity($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereResidentialState($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereResidentialCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereRegistrationDate($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereUpdatedAt($value)
 * @method static \UnifySchool\Entities\School\BaseModel unScoped()
 * @property string $remember_token
 * @property-read \UnifySchool\School $school
 * @method static \Illuminate\Database\Query\Builder|\UnifySchool\Entities\School\ScopedStudent whereRememberToken($value)
 * @method static \UnifySchool\Entities\School\BaseModel getWithData()
 */
class ScopedStudent extends BaseModel
{

    protected $casts = [
        'picture' => 'array'
    ];

}
