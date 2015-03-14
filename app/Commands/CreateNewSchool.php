<?php namespace UnifySchool\Commands;

use Illuminate\Contracts\Bus\SelfHandling;
use UnifySchool\School;

class CreateNewSchool extends Command implements SelfHandling
{
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
     * Create a new command instance.
     *
     * @param $name
     * @param $country
     * @param $state
     * @param $city
     * @param $selected_school_type
     */
    public function __construct($name, $country, $state, $city, $selected_school_type)
    {
        //
        $this->name = $name;
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
        $this->selected_school_type = $selected_school_type;
    }

    /**
     * Execute the command.
     *
     * @return School|static
     * @throws \Exception
     */
    public function handle()
    {
        $school = new School();
        $school->city = $this->city;
        $school->state_id = $this->state;
        $school->country_id = $this->country;
        $school->name = $this->name;
        $school->school_type_id = $this->selected_school_type;
        $school->save();

        if (is_null($school))
            throw new \Exception('Could not create school');

        //raise new school event

        return $school;
    }

}
