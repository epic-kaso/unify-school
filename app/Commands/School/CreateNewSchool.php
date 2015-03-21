<?php namespace UnifySchool\Commands\School;

use Illuminate\Contracts\Bus\SelfHandling;
use UnifySchool\Commands\Command;
use UnifySchool\Entities\School\ScopedSchoolCategory;
use UnifySchool\Entities\School\ScopedSchoolType;
use UnifySchool\Entities\School\ScopedSessionType;
use UnifySchool\Events\NewSchoolRegistered;
use UnifySchool\Repositories\School\ScopedSchoolCategoriesRepository;
use UnifySchool\Repositories\School\ScopedSchoolTypeRepository;
use UnifySchool\Repositories\School\ScopedSessionTypeRepository;
use UnifySchool\Repositories\SchoolRepository;
use UnifySchool\School;

class CreateNewSchool extends Command implements SelfHandling
{
    protected $school;
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $country;
    /**
     * @var
     */
    private $state;
    /**
     * @var
     */
    private $city;
    /**
     * @var
     */
    private $selected_school_type;
    /**
     * @var
     */
    private $school_types;

    private $school_type;

    /**
     * Create a new command instance.
     *
     * @param $name
     * @param $country
     * @param $state
     * @param $city
     * @param $selected_school_type
     * @param $school_types
     * @throws \Exception
     */
    public function __construct($name, $country, $state, $city, $selected_school_type, $school_types)
    {
        //
        $this->name = $name;
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
        $this->selected_school_type = $selected_school_type;
        $this->school_types = $school_types;

        foreach ($school_types as $type) {
            if ($type['id'] == $selected_school_type) {
                $this->school_type = $type;
                break;
            }
        }
        if (is_null($this->school_type)) {
            throw new \Exception('School type can not be null');
        }
    }

    /**
     * Execute the command.
     *
     * @param SchoolRepository $schoolRepository
     * @param ScopedSessionTypeRepository $sessionTypeRepository
     * @param ScopedSchoolTypeRepository $schoolTypeRepository
     * @param ScopedSchoolCategoriesRepository $schoolCategoriesRepository
     * @return School|static
     * @throws \Exception
     */
    public function handle(
        SchoolRepository $schoolRepository,
        ScopedSessionTypeRepository $sessionTypeRepository,
        ScopedSchoolTypeRepository $schoolTypeRepository,
        ScopedSchoolCategoriesRepository $schoolCategoriesRepository
    )
    {
        $school = $this->createSchool($schoolRepository);
        $schoolType = $this->createScopedSchoolType($schoolTypeRepository,$this->school_type, $school,$sessionTypeRepository);
        $this->setSchoolType($school,$schoolType);
        $this->createScopedSchoolCategories($schoolCategoriesRepository, $school, $schoolType);


        if (is_null($school))
            throw new \Exception('Could not create school');

        return $school;
    }

    /**
     * @param SchoolRepository $schoolRepository
     * @return School
     */
    private function createSchool(SchoolRepository $schoolRepository)
    {
        $school = [];
        $school['city'] = $this->city;
        $school['state_id'] = $this->state;
        $school['country_id'] = $this->country;
        $school['name'] = $this->name;

        $schoolModel = $schoolRepository->create($school);
        $this->school = $schoolModel;
        return $schoolModel;
    }

    private function createScopedSchoolType(
        ScopedSchoolTypeRepository $schoolTypeRepository,
        $school_type,
        School $school,
        ScopedSessionTypeRepository $sessionTypeRepository)
    {
        $cat = [];
        $cat['name'] = $school_type['name'];
        $cat['display_name'] = $school_type['display_name'];
        $cat['scoped_session_type_id'] = $this->createSessionType($school_type,$sessionTypeRepository)->id;
        $cat['school_id'] = $school->id;

        $model = $schoolTypeRepository->create($cat);
        return $model;
    }

    private function createSessionType(array $school_type,ScopedSessionTypeRepository $sessionTypeRepository)
    {
        
        $sessionData = [];

        $sessionData['school_id'] = $this->school->id;
        $sessionData['session_divisions_name'] = 'sub_session';
        $session['session_name'] = 'session';

        if (isset($school_type['session'])) {
            $sessionData['session_type'] = $school_type['session']['session_type'];
            $session['session_display_name'] = 'Session';
            $sessionData['session_divisions_display_name'] = $school_type['session']['session_divisions_display_name'];
        } else {
            $sessionData['session_type'] = $school_type['session_type']['session_type'];
            $session['session_display_name'] = $school_type['session_type']['session_display_name'];
            $sessionData['session_divisions_display_name'] = $school_type['session_type']['session_divisions_display_name'];
        }

        $session = $sessionTypeRepository->create($sessionData);
        return  $session;
    }

    private function createScopedSchoolCategories(ScopedSchoolCategoriesRepository $schoolCategoriesRepository,School $school, ScopedSchoolType $schoolType)
    {
        foreach ($this->school_type['school_categories'] as $category) {
            $cat = [];
            $cat['name'] = $category['name'];
            $cat['display_name'] = $category['display_name'];
            $cat['scoped_school_type_id'] = $schoolType->id;
            $cat['school_id'] = $school->id;

            $schoolCategoriesRepository->create($cat);
        }
    }

    private function setSchoolType(School $school,ScopedSchoolType $schoolType)
    {
        $school->setSchoolType($schoolType);
    }

}
