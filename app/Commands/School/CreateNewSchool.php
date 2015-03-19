<?php namespace UnifySchool\Commands\School;

use Illuminate\Contracts\Bus\SelfHandling;
use UnifySchool\Commands\Command;
use UnifySchool\Entities\School\ScopedSchoolCategory;
use UnifySchool\Entities\School\ScopedSchoolType;
use UnifySchool\Entities\School\ScopedSessionType;
use UnifySchool\Events\NewSchoolRegistered;
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
     * @return School|static
     * @throws \Exception
     */
    public function handle()
    {
        $school = $this->createSchool();
        $this->school = $school;

        $schoolType = $this->createScopedSchoolType($this->school_type, $school);

        $school->school_type_id = $schoolType->id;
        $school->save();

        $this->createScopedSchoolCategories($school, $schoolType);

        if (is_null($school))
            throw new \Exception('Could not create school');

        return $school;
    }

    /**
     * @return School
     */
    private function createSchool()
    {
        $school = new School();
        $school->city = $this->city;
        $school->state_id = $this->state;
        $school->country_id = $this->country;
        $school->name = $this->name;
        $school->save();
        return $school;
    }

    private function createScopedSchoolType($school_type, School $school)
    {
        $cat = new ScopedSchoolType();
        $cat->name = $school_type['name'];
        $cat->display_name = $school_type['display_name'];
        $cat->scoped_session_type_id = $this->createOrGetSessionTypeID($school_type);
        $cat->school_id = $school->id;

        $cat->save();
        return $cat;
    }

    private function createOrGetSessionTypeID(array $school_type)
    {
        $session = new ScopedSessionType();

        if (isset($school_type['session'])) {
            $session->session_type = $school_type['session']['session_type'];
            $session->session_divisions_display_name = $school_type['session']['session_divisions_display_name'];
            $session->session_divisions_name = 'sub_session';
            $session->session_name = 'session';
            $session->session_display_name = 'Session';
            $session->school_id = $this->school->id;
            $session->save();
        } else {
            $session->session_type = $school_type['session_type']['session_type'];
            $session->session_divisions_display_name = $school_type['session_type']['session_divisions_display_name'];
            $session->session_divisions_name = $school_type['session_type']['session_divisions_name'];
            $session->session_name = $school_type['session_type']['session_name'];
            $session->session_display_name = $school_type['session_type']['session_display_name'];;
            $session->school_id = $this->school->id;
            $session->save();
        }

        return $session->id;

    }

    private function createScopedSchoolCategories(School $school, ScopedSchoolType $schoolType)
    {
        foreach ($this->school_type['school_categories'] as $category) {
            $cat = new ScopedSchoolCategory();
            $cat->name = $category['name'];
            $cat->display_name = $category['display_name'];
            $cat->scoped_school_type_id = $schoolType->id;
            $cat->school_id = $school->id;
            $cat->save();
        }
    }

}
