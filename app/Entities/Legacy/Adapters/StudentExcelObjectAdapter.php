<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/19/2015
 * Time: 3:55 PM
 */

namespace UnifySchool\Entities\Legacy\Adapters;


use Illuminate\Support\Str;

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

    function __construct($row)
    {
        $this->adapt($row);
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

}